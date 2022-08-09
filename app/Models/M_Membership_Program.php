<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Membership_Program extends Model
{
    use HasFactory;
    public $table = 'm_membership_program';

 

    /**  
    * Explain of function : To insert data from request to model
    * parament : all requestes from  membership form
    * return : save data
    */
    public function saveData($request) {

        Log::channel('adminlog')->info("M_Membership_Program", [
            'Start saveData'
        ]);

        if(session()->has('name')){
            $shopid =  session('shop');
            $name = session('name');
        }
       
        $membership = new M_Membership_Program();
        $membership->program_name = $request->input('pgname');
        $membership->discount = $request->input('damount');
        $membership->kyat_from = $request->input('kyatf');
        $membership->kyat_to = $request->input('kyatt');
        $membership->start_date = $request->input('stdate');
        $membership->end_date = $request->input('eddate');
        $membership->note = $request->has('note') ? $request->input('note') : 'empty';
        $membership->active = 1;
        $membership->shop_id = $shopid;
        $membership->created_by = $name;
        $membership->save();

        Log::channel('adminlog')->info("M_Membership_Program", [
            'End saveData'
        ]);

    }


    /**  
    * Explain of function : lisit data from membership modal
    * parament : none
    * return : all data
    */
    public function listData(){

        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'Start listData'
        ]);

        
        if(session()->has('shop')){
            $shopid =  session('shop');
            
        }

           $pglist = DB::table('m_membership_program')
            ->select('*', DB::raw('m_membership_program.id AS pid'))
            ->where('m_membership_program.shop_id',$shopid)
            
            ->paginate(10);
            


        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'End listData'
        ]);
        return $pglist;
    }


    public function getDataById($id){

        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'Start getDatabyId'
        ]);
        $mid =  M_Membership_Program::findOrfail($id);

        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'End getDataById'
        ]);
        return $mid;
    }


    public function updateData($id,$request){



        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'Start updateData'
        ]);

        if(session()->has('name')){
            $shopid =  session('shop');
            $name = session('name');
        }
        $membership =  M_Membership_Program::find($id);

        $membership->program_name = $request->input('pgname');
        $membership->discount = $request->input('damount');
        $membership->kyat_from = $request->input('kyatf');
        $membership->kyat_to = $request->input('kyatt');
        $membership->start_date = $request->input('stdate');
        $membership->end_date = $request->input('eddate');
        $membership->note = $request->has('note') ? $request->input('note') : 'empty';
        $membership->active = 1;
        $membership->shop_id = $shopid;
        $membership->created_by = $name;
        $membership->save();

        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'End updateData'
        ]);

        // return $membership;
    }

    public function deleteDataById($id){


        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'Start deleteDataById'
        ]);

        if(session()->has('shop')){
            $shopid =  session('shop');
            
        }
        DB::table('m_membership_program')
        ->where('id',$id)
        ->where('m_membership_program.shop_id',$shopid)
        ->delete();

        Log::channel('adminlog')->info("M_Membership_Program Model", [
            'End deleteDataById'
        ]);
    }


    public function getFirstMember(){


        if(session()->has('shop')){
            $shopid =  session('shop');
            
        }
       $id = DB::table('m_membership_program')
        ->where('m_membership_program.active',1)
        ->where('m_membership_program.shop_id',$shopid)
        ->first();

        return $id;
    }

    public function searchByName($request){

        if(session()->has('shop')){
            $shopid =  session('shop');
            
        }

        $reference = DB::table('m_membership_program')
        ->select('*')
        ->where('m_membership_program.program_name','Like','%'.$request.'%')
        ->where('m_membership_program.shop_id',$shopid)
      
        ->get();

        return $reference;
    }

    public function reference(){


        if(session()->has('shop')){
            $shopid =  session('shop');
            
        }
        $reference = DB::table('m_membership_program')
        ->select('*')
        ->where('m_membership_program.shop_id',$shopid)
        ->where('m_membership_program.active', 1)
        ->get();

        return $reference;
    }

    public function updateMembership($id,$active){

        Log::critical("active",['id' => $active]);
        M_Membership_Program::where('m_membership_program.id', '=', $id)
          ->update(['m_membership_program.active' => $active]);
      
  }


    public function card()
    {

        return $this->hasMany('App\Models\M_Card');
    }
}
