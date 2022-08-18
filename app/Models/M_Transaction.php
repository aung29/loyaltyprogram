<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Transaction extends Model
{
    use HasFactory;
    public $table = 'm_transaction';


    public function storeData($request,$cardid,$amount,$time){

        if(session()->has('adminId')){
            $createid =  session('adminId');
        }

        $transaction = new M_Transaction();
        $transaction->card_id= $cardid;
        $transaction->invoice = $request->input('cinvoice');
        $transaction->amount = $amount;
        $transaction->transaction_date = $time;
        $transaction->created_by_id = $createid;
        $transaction->save();
         // $transaction->amount = $request
        
    }

    public function showData($shopid){
           

        $transList= DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->orderBy('m_transaction.id','DESC')
        
        ->paginate(10);
     
    

       return $transList;
        
    }
    
    public function showDataByCardId($id){

        $specificData = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->join('m_ad_shop','m_ad_shop.id','=','m-card.shop_id')
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name','m_membership_program.note','m_ad_shop.shop_name')
        ->where('m_transaction.card_id',$id)
        ->where('m-card.active',1)
        ->where('m_membership_program.active',1)
        ->paginate(10);

        return $specificData;
    }


    public function getSpecificCount($id){

        $specificData = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id')
        ->join('m_ad_shop','m_ad_shop.id','=','m-card.shop_id')
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name','m_membership_program.note')
        ->where('m_transaction.card_id',$id)
        ->where('m-card.active',1)
        ->where('m_membership_program.active',1)
        ->get();

        return $specificData;
    }

    public function getCount($shopid){

        
       

        $count = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
     
        ->get();

        return $count;
    }

    public function searchCardByCardid($request){

        if(session()->has('adminId')){
            $shopid =  session('shop');
        }

        $transList= DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.card_id','Like','%'.$request.'%')
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
      
        ->orderBy('m_transaction.id','DESC')
        ->get();
     
    

       return $transList;
        
    }

    public function reportData($id){

        if(session()->has('adminId')){
            $shopid =  session('shop');
        }

        $transList= DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.id',$id)
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->orderBy('m_transaction.id','DESC')
        ->get();

       return $transList;   
    }


    public function searchCustomerByCardId($id){
        if(session()->has('adminId')){
            $shopid =  session('shop');
        }

        $transList= DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.id',$id)
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->orderBy('m_transaction.id','DESC')
        ->get();

       return $transList;
        
    }
    
    public function searchByReference($id){

        if(session()->has('adminId')){
            $shopid =  session('shop');
        }

      $transList  = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m_transaction.id','m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_transaction.transaction_date','m_membership_program.program_name')
        ->where('m-card.membership_id',$id)
        ->where('m-card.active',1)
        ->where('m_membership_program.active',1)
        ->where('m-card.shop_id',$shopid)
       
        ->orderBy('m_transaction.id','DESC')
        ->get();
          
        return $transList;
    }


    public function dailySaleChart($today){

    

     
        $result = DB::select(     
            DB::raw("SELECT SUM(trans.amount) as total,shop.shop_name FROM `m_transaction`as trans
            INNER JOIN `m-card` AS mc 
            ON trans.card_id = mc.id
            INNER JOIN `m_ad_shop` as shop
            ON mc.shop_id = shop.id
            WHERE mc.active = 1 and DATE(trans.transaction_date) = '$today'
            GROUP BY shop.id
            ORDER BY shop.id"));
        
      

        return $result;
        
    }
    public function m_card()
    {

        return $this->belongsTo('App\Models\M_Card');
    }

}
