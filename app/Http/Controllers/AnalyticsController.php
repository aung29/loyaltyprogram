<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Shop;
use App\Models\M_Transaction;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    //


    public function index(){



        if(session()->has('role')){
            $shopid =  session('shop');
            }
        $date = new DateTime("now", new DateTimeZone('Asia/Yangon') );
        $today = $date->format('Y-m-d');


        $shop  = new M_Shop();
        $shops  = $shop->getDataFromShop();

        $card =new M_Card();
         $genderCount = $card->getAnalyticsData($shopid);
            $totalCount =$card->cardCount($shopid);
           $members = $card->membershipCount($shopid);
            $purchased    = $card->mostpurchasedData($shopid);


           $trans = new M_Transaction();
              $chart    =  $trans->dailySaleChart($today);


        return view('admin.analytics',['shops' => $shops,'today' => $today,'gender' => $genderCount, 'total' => $totalCount ,'members'=> $members,'totalamount' => $purchased,'dailyChart' =>$chart]);
    }
}
