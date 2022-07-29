<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Transaction;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    

    public function exportData(){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $transaction = new M_Transaction();
        $saleResult  =   $transaction->showData();
        $saleCount =  $transaction->getCount();



        $card = new M_Card();
        $cardCount = $card->cardCount($shopid);
        $cardResult= $card->listData($shopid);
  
        $member = new M_Membership_Program();
        $reference = $member->reference();

        return view('admin.export',['sale'=> $saleResult,'card' => $cardResult ,'ref' => $reference,'saleCount'=> $saleCount,'cardCount'=>$cardCount]);
    }
}
