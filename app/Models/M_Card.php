<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Card extends Model
{
    use HasFactory;

    public $table = 'm_card';


    public function saveData($request)
    {

        // if(session()->has('role')){
        //    
        // }

        if (session()->has('role')) {
            $shopid =  session('shop');
            if (session('role') == 'SA') {
                $membership = new M_Membership_Program();
                $mid = $membership->getFirstMember();

                $card = new M_Card();
                $card->card_id = $request->input('card');
                $card->customer_name = $request->input('name');
                $card->phone =  $request->input('phone');
                $card->dob = $request->input('dob');
                $card->address = $request->input('address');
                $card->gender = $request->input('gender');
                $card->total_amount =  0;
                $card->membership_id = $mid->id;
                $card->shop_id = 2;
                $card->active = 1;
                $card->save();

                return $card;
            } else {

                $membership = new M_Membership_Program();
                $mid = $membership->getFirstMember();

                $card = new M_Card();
                $card->card_id = $request->input('card');
                $card->customer_name = $request->input('name');
                $card->phone =  $request->input('phone');
                $card->dob = $request->input('dob');
                $card->address = $request->input('address');
                $card->gender = $request->input('gender');
                $card->total_amount =  0;
                $card->membership_id = $mid->id;
                $card->shop_id = $shopid;
                $card->active = 1;
                $card->save();

                return $card;
            }
        }
    }

    public function  showCustomerDetail($id)
    {

        if (session()->has('role')) {
            $shopid =  session('shop');
        }

        $cudata = DB::table('m_card')
            ->select(['*'], DB::raw('m_card.id as pid'))
            ->join('m_membership_program', 'm_membership_program.id', '=', 'm_card.membership_id')
            ->where('m_membership_program.active', 1)
            ->where('m_card.id', $id)
            ->where('m_card.shop_id', $shopid)
            ->get();

        return $cudata;
    }

    public function resetById($id)
    {


        $cardid = M_Card::findOrFail($id);

        return $cardid;
    }
    public function getDataById($id)
    {


        $cardid = DB::table('m_card')
            ->select(['m_card.card_id','m_card.customer_name','m_card.address','m_card.phone','m_card.total_amount','m_reset_amount.reset_time','m_reset_amount.reset_amount','m_card.id'], DB::raw('m_card.id as pid'))
            ->join('m_reset_amount', 'm_reset_amount.card_id', '=', 'm_card.id')
            ->where('m_card.id', $id)
            ->get();

        
        return  $cardid;
    }

    public function updateAmount($id, $amount)
    {

        M_Card::where('m_card.id', '=', $id)
            ->where('m_card.active', 1)
            ->update(['m_card.total_amount' => $amount]);
    }

    public function updateMembership($id, $memberid)
    {
        M_Card::where('m_card.id', '=', $id)
            ->where('m_card.active', 1)
            ->update(['m_card.membership_id' => $memberid]);
    }

    public function resetAmount($id,$carrierMoney)
    {

        M_Card::where('m_card.id', '=', $id)
            ->where('m_card.active', 1)
            ->update(['m_card.total_amount' => $carrierMoney]);
    }

    public function getDataByCardName($name)
    {

        if (session()->has('role')) {
            $shopid =  session('shop');
        }

        $cardname = DB::select(
            DB::raw("SELECT
             mc.id,mc.card_id,mc.customer_name,mc.total_amount,member.program_name,member.discount 
        FROM
            `m_card` as mc
        INNER JOIN 
        `m_membership_program` as member
        ON 
         mc.membership_id = member.id
        WHERE mc.card_id = $name AND mc.active = 1 AND mc.shop_id = $shopid; 
        ")
        );


        return $cardname;
    }


    public function confirmDatabyCardName($name)
    {



        $cardname = DB::select(
            DB::raw("SELECT
             mc.id,mc.card_id,mc.customer_name,mc.total_amount,member.program_name,member.discount 
        FROM
            `m_card` as mc
        INNER JOIN 
        `m_membership_program` as member
        ON 
         mc.membership_id = member.id
        WHERE mc.card_id = $name AND mc.active = 1 ; 
        ")
        );


        return $cardname;
    }

    public function listData($shopid)
    {


        if (session()->has('role')) {
            if (session('role') == 'SA') {
                $culist = DB::table('m_card')
                    ->select('*')
                    ->where('m_card.active', 1)
                    ->orderBy('m_card.card_id')
                    ->paginate(10);
            } else {
                $culist = DB::table('m_card')
                ->select('*')
                ->where('m_card.active', 1)
                ->orderBy('m_card.card_id')
                ->where('m_card.shop_id',$shopid)
                ->paginate(10);
            }
        }



        return $culist;
    }


    public function vipCount($shopid){

    }
    public function cardCount($shopid)
    {


        if (session()->has('role')) {
            if (session('role') == 'SA') {
                $count = DB::table('m_card')
                    ->where('m_card.active', 1)
                    ->get();
                
            } else {
                $count = DB::table('m_card')
                    ->where('m_card.active', 1)
                    ->where('m_card.shop_id', $shopid)
                    ->get();
               
            }
            return $count;
        }

    }

    public function checkCard($name)
    {


        $hasCard = M_Card::where('m_card.card_id', '=', $name)
            ->where('m_card.active', 1)
            ->first();
        return $hasCard;
    }


    public function searchCardByCardId($request, $shopid)
    {

        if (session()->has('role')) {
            if (session('role') == 'SA') {

                $result = DB::table('m_card')
                ->where('m_card.card_id', 'Like', '%' . $request . '%')
                ->where('m_card.active', 1)
                ->orderBy('m_card.card_id')
                ->get();
    
            }else{
                $result = DB::table('m_card')
                ->where('m_card.card_id', 'Like', '%' . $request . '%')
                ->where('m_card.active', 1)
                ->where('m_card.shop_id', $shopid)
                ->orderBy('m_card.card_id')
                ->get();
    
            
            }
        }

        return $result;


    
    }


    public function changeCardByCardId($request, $shopid)
    {


        if (session()->has('role')) {
            if (session('role') == 'SA') {
                $result = DB::table('m_card')
                ->where('m_card.id', $request)
                ->where('m_card.active', 1)
               
                ->get();
    
    
            }else{
                $result = DB::table('m_card')
                ->where('m_card.id', $request)
                ->where('m_card.active', 1)
                ->where('m_card.shop_id', $shopid)
                ->get();
    
            }

        }


        return $result;
    }


    public function changeCardByMemberId($request, $shopid)
    {


        if (session()->has('role')) {
            if (session('role') == 'SA') {
                $result = DB::table('m_card')
                ->where('m_card.membership_id', $request)
                ->where('m_card.active', 1)
                ->get();
            }else{
                $result = DB::table('m_card')
                ->where('m_card.membership_id', $request)
                ->where('m_card.active', 1)
                ->where('m_card.shop_id', $shopid)
                ->get();
            }
        }

       



        return $result;
    }



    public function groupDataByMember()
    {



        $result  = DB::select(
            DB::raw("SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name
     FROM `m_card` as mc
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
          FROM `m_card` as mc
         INNER JOIN m_membership_program  as member
         ON  mc.membership_id = member.id
         WHERE mc.active = 1 ")
        );


        Log::critical("message", ['result' => $result]);
        return $result;
    }


    public function dashboardData()
    {

        $results = [];
        for ($i = 1; $i < 8; $i++) {
            $result = DB::select(
                DB::raw(
                    "SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name, shop.shop_name
                FROM `m_card` as mc
                INNER JOIN m_membership_program  as member
                ON  mc.membership_id = member.id
                INNER JOIN m_ad_shop as shop
                ON mc.shop_id = shop.id
                WHERE mc.active = 1 AND mc.shop_id = $i
                GROUP BY member.program_name
                ORDER BY member.id"
                )
            );

            array_push($results, $result);
        }



        return $results;
    }

    public function getAnalyticsData($shopid)
    {

        // if (session()->has('role')) {
        //     if (session('role') == 'SA') {
        //         $result = DB::select(
        //             DB::raw("SELECT COUNT(mc.id) as qty,mc.gender
        //                         FROM `m_card` as mc
        //                         JOIN m_membership_program AS member 
        //                         ON  mc.membership_id = member.id
        //                         WHERE mc.active = 1 AND mc.shop_id = 2 
        //                         GROUP BY mc.gender
        //                         ORDER BY mc.gender ='male' DESC
        //                         ")
        //         );
        //     }else{
        //         $result = DB::select(
        //             DB::raw("SELECT COUNT(mc.id) as qty,mc.gender
        //                         FROM `m_card` as mc
        //                         JOIN m_membership_program AS member 
        //                         ON  mc.membership_id = member.id
        //                         WHERE mc.active = 1 AND mc.shop_id = $shopid 
        //                         GROUP BY mc.gender
        //                         ORDER BY mc.gender ='male' DESC
        //                         ")
        //         );
        //     }
        $result = DB::select(
            DB::raw("SELECT COUNT(mc.id) as qty,mc.gender
                        FROM `m_card` as mc
                        JOIN m_membership_program AS member 
                        ON  mc.membership_id = member.id
                        WHERE mc.active = 1 AND mc.shop_id = $shopid
                        GROUP BY mc.gender
                        ORDER BY mc.gender ='male' DESC
                        ")
        );
        
            return $result;
        // }
                
    }


    public function searchAnalyticsData($shopid){


        $result = DB::select(
            DB::raw("SELECT COUNT(mc.id) as qty,mc.gender
                        FROM `m_card` as mc
                        JOIN m_membership_program AS member 
                        ON  mc.membership_id = member.id
                        WHERE mc.active = 1 AND mc.shop_id = $shopid 
                        GROUP BY mc.gender
                        ORDER BY mc.gender ='male' DESC
                        ")
        );
        
        return $result;
    }


    public function updateCardInfo($request) {
        
      


        DB::table('m_card')
        ->select(['*'], DB::raw('m_card'))
        ->where('m_card.card_id',$request->input('cardid'))
        ->update(['m_card.customer_name' => $request->input('name'),'m_card.phone' => $request->input('phone'),'m_card.address' => $request->input('address')]);
        
  

        
        // return $request->input('name');
        // $result = DB::select(
        //     DB::raw("UPDATE `m_card` SET `customer_name`= $request->input('name'),`phone`= $request->input('phone'),`address`=$request->input('address') WHERE card_id = $request->input('cardid')")
        // );
        // dd($result);
        // $card->card_id = $request->input('card');
        // $card->customer_name = $request->input('name');
        // $card->phone =  $request->input('phone');
        // $card->dob = $request->input('dob');
        // $card->address = $request->input('address');
        // $card->gender = $request->input('gender');
        // $card->total_amount =  0;
        // $card->membership_id = $mid->id;
        // $card->shop_id = 2;
        // $card->active = 1;
        // $card->save();
        
        
    }
    public function membershipCount($shopid)
    {

        if (session()->has('role')) {
            if (session('role') == 'SA' || session('role') == 'OP') {
                $result = DB::select(
                    DB::raw(
                        "SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name as pgname
                    FROM `m_card` as mc
                    INNER JOIN m_membership_program  as member
                    ON  mc.membership_id = member.id
                    INNER JOIN m_ad_shop as shop
                    ON mc.shop_id = shop.id
                    WHERE mc.active = 1 AND mc.shop_id = 2
                    GROUP BY member.program_name
                    ORDER BY member.id"
                    )
                );
            }else{
                $result = DB::select(
                    DB::raw(
                        "SELECT SUM(mc.total_amount) as total,COUNT(mc.card_id) as counts,member.program_name as pgname
                    FROM `m_card` as mc
                    INNER JOIN m_membership_program  as member
                    ON  mc.membership_id = member.id
                    INNER JOIN m_ad_shop as shop
                    ON mc.shop_id = shop.id
                    WHERE mc.active = 1 AND mc.shop_id = $shopid 
                    GROUP BY member.program_name
                    ORDER BY member.id"
                    )
                );
            }
        }
     
        
        return $result;
    }



    public function membershipProgram()
    {

        return $this->belongsTo('App\Models\M_Membership_Program');
    }


    public function mostpurchasedData($shopid)
    {




        $result = DB::select(
            DB::raw(
                "SELECT mc.total_amount,mc.card_id,mc.dob,mc.customer_name,mc.phone,mc.address
            FROM `m_card` as mc
          
            WHERE mc.active = 1 AND mc.shop_id = $shopid AND mc.total_amount > 0
            ORDER BY mc.total_amount DESC
            LIMIT 10"
            )
        );

        return $result;
    }

    public function transaction()
    {

        return $this->hasMany('App\Models\M_Transaction');
    }

    public function reset()
    {

        return $this->hasMany('App\Models\M_Reset_Amount');
    }

    public function shop()
    {

        return $this->belongsTo('App\Models\M_Shop');
    }
}
