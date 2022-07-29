<?php

namespace App\Http\Controllers;

use App\Models\M_Login;
use App\Models\M_Shop;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $login = new M_Login();
        $result = $login->showData();
        $shops = new M_Shop();
        $shop = $shops->getDataFromShop();
        return view('admin.setting',['result' => $result,'shops' => $shop]);
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
    public function store(Request $request)
    {
        

         $settingAccount = new M_Login();
         $settingAccount->storeData($request);

         return redirect('setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $login  = new M_Login();
       $result = $login->getDataById($id);

       return view('admin.updateaccount',['result' => $result]);
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
        
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'cfmpassword' => 'required',
            
        ]);
            
        $login  = new M_Login();
        $login->updateDataById($request,$id);
            
        return redirect('setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $login = new M_Login();
        $login->deleteDataById($id);

        return redirect('setting');
    }
}
