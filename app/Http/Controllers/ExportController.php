<?php

namespace App\Http\Controllers;

use App\Exports\CardExport;
use App\Exports\DetailExport;
use App\Exports\MembershipExport;
use App\Exports\SaleExport;
use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    

    public function exportData(){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $transaction = new M_Transaction();
        $saleResult  =   $transaction->showData($shopid);
        $saleCount =  $transaction->getCount($shopid);



        $card = new M_Card();
        $cardCount = $card->cardCount($shopid);
        $cardResult= $card->listData($shopid);
  
        $member = new M_Membership_Program();
        $reference = $member->reference();

        return view('admin.export',['sale'=> $saleResult,'card' => $cardResult ,'ref' => $reference,'saleCount'=> $saleCount,'cardCount'=>$cardCount]);
    }


    public function cardExport(){

        $result = Excel::download(new CardExport(),'customer.xlsx');

     
        return $result;
    }


    public function saleExport(){

        $result = Excel::download(new SaleExport(),'saleReport.xlsx');

       
        return $result;
    }

    public function detailExport(Request $request){

        
        $result = Excel::download(new DetailExport($request->id),'customerDetail.xlsx');


        return $result;
      
    }


    public function memberExport(){

        $result = Excel::download(new MembershipExport(),'memberReport.xlsx');

       
        return $result;
    }
}
