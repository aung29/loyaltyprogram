<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Transaction;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(session()->has('role')){
            $shopid =  session('shop');
        }
        $transaction = new M_Transaction();
         $result  =   $transaction->showData();
      $count =  $transaction->getCount();

      $card = new M_Card();
      $cardCount = $card->cardCount($shopid);
      $member = new M_Membership_Program();
      $reference = $member->reference();

        return view('admin.sale',['result' => $result,'count' =>$count,'cardCount' =>$cardCount,'ref'=>$reference]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        DB::transaction(function () use ($request) {
            
      
        $card = new M_Card();
      
        $cardid = $card->confirmDatabyCardName($request->input('ccard'));
        if($cardid == null) abort(404);
        $price = $request->input('cprice');
      
      
      //current myanamr date tieme
       $date = new DateTime("now", new DateTimeZone('Asia/Yangon') );
        $current = $date->format('Y-m-d H:i:s');
        
       
        $reference = new M_Membership_Program();
        $member   = $reference->reference();
        // if($member == null) abort(404);
        
        
        $transaction  = new M_Transaction();
        //to upate amount
        $total = $cardid[0]->total_amount;
        $updateAmount = $total + $price;

       
        // to change when amount is higer than program kyat to
        
        $transaction->storeData($request,$cardid[0]->id,$price,$current);
        $card->updateAmount($cardid[0]->id,$updateAmount);

        $memberid = 0;
        foreach ($member as  $value) {
            Log::critical("value",['value' => $value]);
         if($updateAmount >= $value->kyat_from && $updateAmount <= $value->kyat_to ){
                 $memberid = $value->id;
             }  
        }

        if($memberid != 0 ){
            $card->updateMembership($cardid[0]->id,$memberid);
        }
      
    });

        return redirect('sale');
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
