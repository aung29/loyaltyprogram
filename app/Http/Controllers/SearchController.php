<?php

namespace App\Http\Controllers;

use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Transaction;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    


    public function searchCard(Request $request){


         $trans = new M_Transaction();
            $cards =$trans->searchCardByCardid($request->input('name'));
           
            return response()
            ->json(
                $cards
            );
    }

    public function searchCustomer(Request $request){

        $trans = new M_Transaction();
        $cards =$trans->searchCustomerByCardId($request->input('cusname'));
       
        return response()
        ->json(
            $cards
        );
    }


    public function searchByReference(Request $request){
        

        $trans = new M_Transaction();
        $cards =$trans->searchByReference($request->input('id'));
       
        return response()
        ->json(
            $cards
        );
        
    }


    public function searchCustomerCard(Request $request){


        if(session()->has('role')){
            $shopid =  session('shop');
        }
          $cards   =  new M_Card();
          $result = $cards->searchCardByCardId($request->input('name'),$shopid);


          return response()
          ->json(
              $result
          );
    }

    public function changeCustomer(Request $request){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $cards = new M_Card();
        $result = $cards->changeCardByCardId($request->input('cusname'),$shopid);

      
        return response()
        ->json(
            $result
        );
    }


    public function changeReference(Request $request){


        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $cards = new M_Card();
        $result = $cards->changeCardByMemberId($request->input('id'),$shopid);

      
        return response()
        ->json(
            $result
        );
    }


    public function searchMember(Request $request){


            $members = new M_Membership_Program();
            $result = $members->searchByName($request->input('name'));

            return response()
            ->json(
                $result
            );
    }

    public function searchDailyData(Request $request){




           $trans = new M_Transaction();
              $chart    =  $trans->dailySaleChart($request->input('date'));

            
              return response()
              ->json(
                  $chart
              );

    }

    public function searchAnalytics(Request $request){

        
        $card =new M_Card();
        $anaData = $card->getAnalyticsData($request->input('data'));
      
        $members = $card->membershipCount($request->input('data'));
        $purchased    = $card->mostpurchasedData($request->input('data'));

        $result = [
            'reg' => $anaData,
            'member' => $members,
            'purchased' => $purchased
        
        ];
    
      
        return response()
        ->json(
            $result
        );

    }


    

    public function toggleMembership(Request $request){


        Log::critical("request",['request'=>$request]);
         $member= new M_Membership_Program();
         $member->updateMembership($request->input('id'),$request->input('active'));

         return "Active";
    }
}
