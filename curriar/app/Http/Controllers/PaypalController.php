<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Order;
use App\BusinessSetting;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PaypalController extends Controller
{

    public function getCheckout($shipment)
    {
        // Creating an environment
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_setting('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        
        $amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                             "intent" => "CAPTURE",
                             "purchase_units" => [[
                                 "reference_id" => $shipment->id,
                                 "amount" => [
                                     "value" => number_format($amount, 2, '.', ''),
                                     "currency_code" => \App\Currency::findOrFail(get_setting('system_default_currency'))->code
                                 ]
                             ]],
                             "application_context" => [
                                  "cancel_url" => url('paypal/payment/cancel'),
                                  "return_url" => url('paypal/payment/done')
                             ]
                         ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            // dd($shipment->payment_integration_id);
            // exit;
            $shipment->payment_integration_id = $response->result->id;
            $shipment->save();
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return Redirect::to($response->result->links[1]->href);
        }catch (HttpException $ex) {

        }
    }


    public function getCancel(Request $request)
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        // $request->session()->forget('order_id');
        // $request->session()->forget('payment_data');
        flash(translate('Payment cancelled'))->success();
    	return redirect()->route('home');
    }

    public function getDone(Request $request)
    {
        //dd($request->all());
        // Creating an environment
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_setting('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // $response->result->id gives the orderId of the order created above
        $ordersCaptureRequest = new OrdersCaptureRequest($request->token);
        $ordersCaptureRequest->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($ordersCaptureRequest);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // if($request->session()->has('payment_type')){
                // if($request->session()->get('payment_type') == 'cart_payment'){
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done($request->token, json_encode($response));
            //     }
            //     elseif ($request->session()->get('payment_type') == 'wallet_payment') {
            //         $walletController = new WalletController;
            //         return $walletController->wallet_payment_done($request->session()->get('payment_data'), json_encode($response));
            //     }
            //     elseif ($request->session()->get('payment_type') == 'customer_package_payment') {$customer_package_controller = new CustomerPackageController;
            //         return $customer_package_controller->purchase_payment_done($request->session()->get('payment_data'), json_encode($response));
            //     }
            //     elseif ($request->session()->get('payment_type') == 'seller_package_payment') {$seller_package_controller = new SellerPackageController;
            //         return $seller_package_controller->purchase_payment_done($request->session()->get('payment_data'), json_encode($response));
            //     }
            // }
        }catch (HttpException $ex) {

        }
    }
}
