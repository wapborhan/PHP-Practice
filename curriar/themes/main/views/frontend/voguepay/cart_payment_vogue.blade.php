<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        location.href = '{{ env('APP_URL') }}'
    }

    successFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/success/'+transaction_id
    }
    failedFunction=function(transaction_id) {
        location.href = '{{ env('APP_URL') }}'+'/vogue-pay/failure/'+transaction_id
    }
</script>
@if (\App\BusinessSetting::where('type', 'voguepay_sandbox')->first()->value == 1)
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="demo">
@else
    <input type="hidden" id="merchant_id" name="v_merchant_id" value="{{ env('VOGUE_MERCHANT_ID') }}">
@endif

<script>

        window.onload = function(){
            pay3();
        }

        function pay3() {
         Voguepay.init({
             v_merchant_id: document.getElementById("merchant_id").value,
             total: '{{round($shipment->tax + $shipment->shipping_cost + $shipment->insurance * 100)}}',
             cur: '{{\App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code}}',
             merchant_ref: 'ref123',
             memo: 'Payment for shirt',
             developer_code: '5a61be72ab323',
             store_id: 1,
             loadText:'Custom load text',

             customer: {
                name: '{{ $shipment->client->name }}',
                address: '{{ $shipment->client_address }}',
                city: '{{ $shipment->to_country->name }}',
                state: '{{ $shipment->to_state->name }}',
                zipcode: '1234',
                email: '{{ $shipment->client->email }}',
                phone: '{{ $shipment->client->follow_up_mobile }}'
            },
             closed:closedFunction,
             success:successFunction,
             failed:failedFunction
         });
        }
</script>
