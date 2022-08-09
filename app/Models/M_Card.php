<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Card extends Model
{
    use HasFactory;

    public $table = 'm-card';


    public function saveData($request){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        Log::critical("hello",['arrive']);
        $membership = new M_Membership_Program();
        $mid = $membership->getFirstMember();
       
        $card = new M_Card();

        $card->card_id = $request->input('card');
        $card->customer_name =$request->input('name');
        $card->phone =  $request->input('phone');
        $card->dob = $request->input('dob');
        $card->address = $request->input('address');
        $card->gender =$request->input('gender');
        $card->total_amount =  0;
        $card->membership_id = $mid->id;
        $card->shop_id = $shopid;
        $card->active = 1;
        $card->save();

    }

    public function  showCustomerDetail($id){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $cudata = DB::table('m-card')
        ->select(['*'], DB::raw('m-card.id as pid'))
        ->join('m_membership_program', 'm_membership_program.id', '=', 'm-card.membership_id')
        ->where('m_membership_program.active',1)
        ->where('m-card.id',$id)
        ->where('m-card.shop_id',$shopid)
        ->get();

        return $cudata;
    }
    public function getDataById($id){


        $cardid =  M_Card::findOrfail($id);

        return  $cardid;
    }

    public function updateAmount($id,$amount){

          M_Card::where('m-card.id', '=', $id)
        ->where('m-card.active',1)
        ->update(['m-card.total_amount' => $amount]);
        
    }

    public function updateMembership($id,$memberid){
        M_Card::where('m-card.id', '=', $id)
        ->where('m-card.active',1)
        ->update(['m-card.membership_id' => $memberid]);
    }   

    public function getDataByCardName($name){

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $cardname =DB::select(
        DB::raw("SELECT
             mc.id,mc.card_id,mc.customer_name,mc.total_amount,member.program_name,member.discount 
        FROM
            `m-card` as mc
        INNER JOIN 
        `m_membership_program` as member
        ON 
         mc.membership_id = member.id
        WHERE mc.card_id = $name AND mc.active = 1 AND mc.shop_id = $shopid; 
        ")
        );
      
      
        return $cardname;
    }


    public function confirmDatabyCardName($name){

        

        $cardname =DB::select(
        DB::raw("SELECT
             mc.id,mc.card_id,mc.customer_name,mc.total_amount,member.program_name,member.discount 
        FROM
            `m-card` as mc
        INNER JOIN 
        `m_membership_program` as member
        ON 
         mc.membership_id = member.id
        WHERE mc.card_id = $name AND mc.active = 1 ; 
        ")
        );
      
      
        return $cardname;
    }

    public function listData($shopid){

        
        $culist = DB::table('m-card')
        ->select('*')
        ->where('m-card.active', 1)
        ->where('m-card.shop_id',$shopid)
        ->paginate(10);
        

        return $culist;
    }


    public function cardCount($shopid){

     
       $count = DB::table('m-card')
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->get();

        return $count;
    }

    public function checkCard($name){


        $hasCard = M_Card::where('m-card.card_id', '=', $name)
        ->where('m-card.active',1)
        ->first();
        return $hasCard;
    }


    public function searchCardByCardId($request,$shopid){


        $result = DB::table('m-card')
        ->where('m-card.card_id','Like','%'.$request.'%')
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->get();

        return $result;
    }


    public function changeCardByCardId($request,$shopid){


      
        $result = DB::table('m-card')
        ->where('m-card.id',$request)
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->get();

       

        return $result;
    }


    public function changeCardByMemberId($request,$shopid){

        $result = DB::table('m-card')
        ->where('m-card.membership_id',$request)
        ->where('m-card.active',1)
        ->where('m-card.shop_id',$shopid)
        ->get();

       

        return $result;

    }


    public function groupDataByMember(){


        
       $result  = DB::select(     
      DB::raw("SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name
     FROM `m-card` as mc
     INNER JOIN m_membership_program  as member
     ON  mc.membership_id = member.id
     WHERE mc.active = 1 
     GROUP BY member.program_name
     ORDER BY member.id
    ")
    );

    return $result;
    }

    public function totalAmount()
        {

        
          $result = DB::select(     
         DB::raw(" SELECT SUM(mc.total_amount) as total
          FROM `m-card` as mc
         INNER JOIN m_membership_program  as member
         ON  mc.membership_id = member.id
         WHERE mc.active = 1 "));

         return $result;
       
  
        }


    public function dashboardData(){

        $results = [];
        for ($i=1; $i <5 ; $i++) { 
            $result = DB::select(     
                DB::raw("SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name, shop.shop_name
                FROM `m-card` as mc
                INNER JOIN m_membership_program  as member
                ON  mc.membership_id = member.id
                INNER JOIN m_ad_shop as shop
                ON mc.shop_id = shop.id
                WHERE mc.active = 1 AND mc.shop_id = $i
                GROUP BY member.program_name
                ORDER BY member.id"
                ));

                array_push($results,$result);
        }

      

        return $results;
    


      
       
    }

    public function getAnalyticsData($shopid){

        


            $result = DB::select(     
                DB::raw("SELECT COUNT(mc.id) as qty,mc.gender
                        FROM `m-card` as mc
                        JOIN m_membership_program AS member 
                        ON  mc.membership_id = member.id
                        WHERE mc.active = 1 AND mc.shop_id = $shopid 
                        GROUP BY mc.gender
                        ORDER BY mc.gender ='male' DESC
                        "));
        
        return $result;
    }

    public function membershipCount($shopid){

       
        $result = DB::select(     
            DB::raw("SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name as pgname
            FROM `m-card` as mc
            INNER JOIN m_membership_program  as member
            ON  mc.membership_id = member.id
            INNER JOIN m_ad_shop as shop
            ON mc.shop_id = shop.id
            WHERE mc.active = 1 AND mc.shop_id = $shopid 
            GROUP BY member.program_name
            ORDER BY member.id"
            ));

            return $result;
        
    }

  

    public function membershipProgram()
    {

        return $this->belongsTo('App\Models\M_Membership_Program');
    }

    
    public function mostpurchasedData($shopid){



      
        $result = DB::select(     
            DB::raw("SELECT mc.total_amount,mc.card_id,mc.dob,mc.customer_name,mc.phone,mc.address
            FROM `m-card` as mc
          
            WHERE mc.active = 1 AND mc.shop_id = $shopid AND mc.total_amount > 0
            ORDER BY mc.total_amount DESC
            LIMIT 10"
            ));

            return $result;
      
    }

    public function transaction()
    {

        return $this->hasMany('App\Models\M_Transaction');
    }

    public function shop()
    {

        return $this->belongsTo('App\Models\M_Shop');
    }

}
