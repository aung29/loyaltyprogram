<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Reset_Amount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResetController extends Controller
{


    public function resetAmount(Request $request)
    {


        DB::transaction(function () use ($request) {

            $cards = new M_Card();
            $card = $cards->resetById($request->input('id'));
                  
            $members = new M_Membership_Program();
            $member     = $members->getFirstMember();
            $reset   = new M_Reset_Amount();
            $data =  $reset->getDataById($card['id']);
            $lastAmount = $data[0]->reset_amount;
            $lastCount = $data[0]->reset_time;
            $currentCount = $lastCount + 1;
           
            $currentAmount = $card['total_amount'];
            if( $currentAmount  >= $member->kyat_to ){
              $carrierAmount =  $currentAmount - $member->kyat_to;
          
            }else{
                $carrierAmount = $currentAmount;
            }
            $newAmount = $lastAmount + $currentAmount;

            $reset->resetData($card['id'], $newAmount, $currentCount);


            $cards->resetAmount($request->input('id'),$carrierAmount);
        });

        return 'good';
       
        
    }
}
