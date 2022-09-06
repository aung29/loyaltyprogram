<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //


    public function index(){


        $date = new DateTime("now", new DateTimeZone('Asia/Yangon') );
        $today = $date->format('Y-m-d');
       
        
         $card = new M_Card();
         $cardResult = $card->groupDataByMember();
        $total   = $card->totalAmount();    
         $dashboard  = $card->dashboardData();

         $member = new M_Membership_Program();
       $reference = $member->reference();
        


        // Log::critical("message",['card' => $total]);
        return view('admin.dashboard',['date' => $today,'cardResult' => $cardResult,'ref' => $reference,'total' => $total,'dash' => $dashboard]);

    }
}
