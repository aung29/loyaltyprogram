<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Reset_Amount extends Model
{
    use HasFactory;


    public $table = 'm_reset_amount';



    public function storeData($card){


      $reset =  new M_Reset_Amount();
      $reset->card_id = $card->id;
      $reset->reset_amount = $card->total_amount;
      $reset->reset_time = 0;
      $reset->save();
        
    }

    public function getDataById($id){

     
     $result = DB::select(
        DB::raw("SELECT * FROM `m_reset_amount` WHERE m_reset_amount.card_id = $id")
      );
     
      
        return $result;
    }

    public function resetData($id,$amount,$count){


      // M_Card::where('m_card.id', '=', $id)
      // ->where('m_card.active',1)
      // ->update(['m_card.total_amount' => 0]);


       DB::table('m_reset_amount')
      ->select(['*'], DB::raw('m_reset_amount'))
      ->where('m_reset_amount.card_id',$id)
      ->update(['m_reset_amount.reset_amount' => $amount]);



      M_Reset_Amount::where('m_reset_amount.card_id','=', $id)
      ->update(['m_reset_amount.reset_time' =>  $count]);
     
    }
    public function m_card()
    {

        return $this->belongsTo('App\Models\M_Card');
    }
}
