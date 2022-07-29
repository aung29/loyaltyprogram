<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Transaction;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;

class SaleController extends Controller
{
    
  
    public function  confirmData(Request $request){

       
        $card = new M_Card();
        $cardid = $card->confirmDatabyCardName($request->input('card'));
    
        if(count($cardid) > 0 ){
          $price = $request->input('price');
         
      
          //current myanamr date tieme
           $date = new DateTime("now", new DateTimeZone('Asia/Yangon') );
            $current = $date->format('Y-m-d H:i:s');
            
           
            $reference = new M_Membership_Program();
            $member   = $reference->reference();
            foreach ($member as  $value) {
             
              
                if($cardid[0]->program_name == $value->program_name){
                    if($value->start_date < $current && $value->end_date > $current ){
                      $membership =  $price - ($price * ($value->discount)/ 100);
                    }else{
                      $membership = $price;
                    }

                       
              }
            }
            
            $transactionData = (object) [
                'card'  =>$cardid,
                'price' => $membership,
                'time' => $current
            ];

            return response()
        ->json(
           $transactionData
        );
        }else{
          return "This card is no register yet!!";
        }
      
       
      
      
    }
}
