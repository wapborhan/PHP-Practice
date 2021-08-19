<?php

namespace App\Http\Controllers;

use App\Captain;
use App\Branch;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Helpers\TransactionHelper;
use App\Transaction;
use Illuminate\Http\Request;
use DB;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('client','branch','captain','mission','shipment')->orderByDesc('id')->paginate(20);
        
        $transaction_owner[Transaction::CAPTAIN]['text'] = translate("Captain");
        $transaction_owner[Transaction::CAPTAIN]['key'] = "captain";
        $transaction_owner[Transaction::CAPTAIN]['id'] = "captain_id";
        $transaction_owner[Transaction::CLIENT]['text'] = translate("Client");
        $transaction_owner[Transaction::CLIENT]['key'] = "client";
        $transaction_owner[Transaction::CLIENT]['id'] = "client_id";
        $transaction_owner[Transaction::BRANCH]['text'] = translate("Branch");
        $transaction_owner[Transaction::BRANCH]['key'] = "branch";
        $transaction_owner[Transaction::BRANCH]['id'] = "branch_id";

        $transaction_type[Transaction::MESSION_TYPE] = "mission";
        $transaction_type[Transaction::SHIPMENT_TYPE] = "shipment";
        $transaction_type[Transaction::MANUAL_TYPE] = "manual";

        $page_name = translate('All Transactions');
        // return $transactions;
        return view('backend.transactions.index', compact('transactions', 'page_name', 'transaction_owner','transaction_type'));
    }

    public function getClientTransaction($client_id)
    {
        $transactions = Transaction::where('client_id',$client_id)->orderBy('created_at','desc')->get();
        $client = Client::find($client_id);
        // $transactions_by_month = Transaction::select([
        //     DB::raw("DATE_FORMAT(created_at, '%m') month"),
        //     DB::raw("SUM(value) sum_value")
        // ])->whereRaw("DATE_FORMAT(created_at, '%y') = DATE_FORMAT(NOW(), '%y')")->where('client_id',$client_id)->groupBy('month')->get();
        $chart_categories = array();
        $chart_values = array();
        // foreach($transactions_by_month as $trans)
        // {
        //     array_push($chart_categories,$trans->month);
        //     array_push($chart_values,$trans->sum_value);
        // }
        return view('backend.transactions.show-client-transactions')
        ->with('transactions',$transactions)
        ->with('client',$client)
        ->with('chart_categories',$chart_categories)
        ->with('chart_values',$chart_values);
    }

    public function getCaptainTransaction($captain_id)
    {
        $transactions = Transaction::where('captain_id',$captain_id)->orderBy('created_at','desc')->get();
        $captain = Captain::find($captain_id);
       
        $chart_categories = array();
        $chart_values = array();
        
        return view('backend.transactions.show-captain-transactions')
        ->with('transactions',$transactions)
        ->with('captain',$captain)
        ->with('chart_categories',$chart_categories)
        ->with('chart_values',$chart_values);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::where('is_archived', 0)->get();
        $clients = Client::where('is_archived', 0)->get();
        $captains = Captain::where('is_archived', 0)->get();

        $types[Transaction::CAPTAIN] = ["name"=> translate("Captain"),"key"=> "captain"];
        $types[Transaction::CLIENT] = ["name"=> translate("Client"),"key"=> "client"];
        $types[Transaction::BRANCH] = ["name"=> translate("Branch"),"key"=> "branch"];
        
        return view('backend.transactions.create', compact('branchs', 'clients','captains','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|integer|min:1|max:3',
            'branch' => 'nullable|exists:branchs,id',
            'client' => 'nullable|exists:clients,id',
            'captain' => 'nullable|exists:captains,id',
            'amount' => 'required|integer|min:1,max:999999999',
            'wallet_type' => 'required|min:1,max:7',
            'description' => 'nullable|max:5000',
        ]);
        if(!$request->branch && !$request->client && !$request->captain){
            flash(translate("Please select branch , client or captain"))->error();
            return back();
        }
        $types[Transaction::CAPTAIN] = "captain";
        $types[Transaction::CLIENT] = "client";
        $types[Transaction::BRANCH] = "branch";

        if($request->wallet_type == "add"){
            $amount_sign = Transaction::CREDIT;
        }elseif($request->wallet_type == "deduct"){
            $amount_sign = Transaction::DEBIT;
        }else{
            flash(translate("Invalid Wallet Type"))->error();
            return back();
        }

        $transaction = new TransactionHelper();
        if($types[$request->type] == "captain"){
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::CAPTAIN,$request->captain,$amount_sign,3,$request->description);
        }elseif($types[$request->type] == "client"){
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::CLIENT,$request->client,$amount_sign,3,$request->description);
        }elseif($types[$request->type] == "branch"){
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::BRANCH,$request->branch,$amount_sign,3,$request->description);
        }else{
            flash(translate("Invalid Data"))->error();
            return back();
        }
        flash(translate("Transaction created successfully"))->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
