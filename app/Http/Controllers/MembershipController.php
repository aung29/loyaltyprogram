<?php

namespace App\Http\Controllers;

use App\Models\M_Membership_Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $allList = new M_Membership_Program();
          $result  = $allList->listData();
          
        return view('admin.membership',['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        /**  
    * Explain of function : To insert data from request to membership table
    * parament : all requestes from  membership form
    * return : save data
    */

    public function store(Request $request)
    {
        //  

        Log::channel('adminlog')->info("MembershipController", [
            'Start Store'
        ]);

            $request->validate([
                'pgname' => 'required',
                'damount' => 'required',
                'kyatf' => 'required',
                'kyatt' => 'required',
                'stdate' => 'required',
            ]);

            
            
            $membership = new M_Membership_Program();
            $membership->saveData($request);
           

          
        Log::channel('adminlog')->info("MembershipController", [
            'End Store'
        ]);


    
        return redirect('membership');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::channel('adminlog')->info("MembershipController", [
            'Start edit'
        ]);
        
        $membership = new M_Membership_Program();
        $result   = $membership->getDataById($id);

        Log::channel('adminlog')->info("MembershipController", [
            'End edit'
        ]);

        return view("admin.membershipeditform",['result' => $result]);
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
        
        Log::channel('adminlog')->info("MembershipController", [
            'Start update'
        ]);
        $request->validate([
            'pgname' => 'required',
            'damount' => 'required',
            'kyatf' => 'required',
            'kyatt' => 'required',
            'stdate' => 'required',
        ]);

        
        
        $membership = new M_Membership_Program();
        $membership->updateData($id,$request);
    


        Log::channel('adminlog')->info("MembershipController", [
            'End  update'
        ]);
        
        return redirect('membership');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membership = new M_Membership_Program();
        $membership->deleteDataById($id);

        return redirect('membership');
    }
}
