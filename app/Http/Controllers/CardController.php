<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardValidation;
use App\Models\M_Card;
use App\Models\M_Membership_Program;
use App\Models\M_Reset_Amount;
use App\Models\M_Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $card = new M_Card();
        $count = $card->cardCount($shopid);
        $result= $card->listData($shopid);
        


         $member = new M_Membership_Program();
         $reference = $member->reference();
        return view('admin.customer',['result' => $result,'count' =>$count,'ref' => $reference]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardValidation $request)
    {
        Log::channel('adminlog')->info("CardController", [
            'Start Store'
        ]);
      

        DB::transaction(function () use ($request) {
        $card = new M_Card();
        
        
        $cards = $card->saveData($request);
           
           $reset  = new M_Reset_Amount();
           $reset->storeData($cards);
        });

        Log::channel('adminlog')->info("MembershipController", [
            'End Store'
        ]);

        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(session()->has('role')){
            $shopid =  session('shop');
        }

        $card = new M_Card();
        $result = $card->getDataById($id);
    
    
        $trans = new M_Transaction();
          $result2 =  $trans->showDataByCardId($id,$shopid);
        $count  = $trans->getSpecificCount($id,$shopid);

        $member = new M_Membership_Program();
        $reference = $member->reference();
       
        return view('admin.customerdetail',['result' => $result,'count' => $count,'result2' => $result2,'ref' => $reference]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
