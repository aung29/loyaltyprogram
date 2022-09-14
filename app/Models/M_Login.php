<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class M_Login extends Model
{
    use HasFactory;


    public $table = 'm_ad_login';


    public function storeData($request){


        if(session()->has('name')){
            $name = session('name');
        }
          $login = new M_Login();
          $login->username = $request->input('name');
          $login->password = $request->input('password');
          $login->role = $request->input('admin');
          $login->shop_id = $request->input('shop');
          $login->active = 1;
          $login->created_by = $name;
          $login->save();

    }

    public function showData(){


        if(session()->has('name')){
            $name = session('name');
            $shop = session('shop');
            $role = session(('role'));
        }

        if($role == 'SA'){
        $collection = DB::table('m_ad_login')
        ->select('*')
       
        ->get();

        return $collection;
        }else{
           
            $count = M_Login::count();
    
            
             $collection = DB::table('m_ad_login')->where('m_ad_login.shop_id',$shop)->get();
            
            return $collection;
        }
       
     
        
       
    }

    public function getDataById($id){


        $id =  M_Login::findOrfail($id);

        return $id;
    }


    public function updateDataById($request,$id){


          $login = M_Login::find($id);
          $login->username = $request->input('name');
          $login->password = $request->input('password');
          $login->active = 1;
          $login->save();

    }


    public function deleteDataById($id){


        DB::table('m_ad_login')
        ->where('id',$id)
        ->delete();
    }


    public function checkUsernamae($name)
    {
        Log::channel('adminlog')->info('M_Login Model', [
            'start checkUsername'
        ]);
        $hasName = M_Login::where('m_ad_login.username', '=', $name)
        ->where('m_ad_login.active',1)
        ->get();

        Log::channel('adminlog')->info('M_Login Model', [
            'end checkUsername'
        ]);
        return $hasName;
    }


    public function checkPassword($name, $password)
    {
        Log::channel('adminlog')->info('M_AD_Login Model', [
            'start checkPassword'
        ]);

        $hasAccount = M_Login::select(['id', 'username', 'password','role','shop_id'])
            ->where('username', $name)
            ->where('password', $password)
            ->where('active', 1)
            ->first();

        Log::channel('adminlog')->info('M_AD_Login Model', [
            'end checkPassword'
        ]);

        return $hasAccount;
    }


    public function updateLoginTime($id)
    {
        Log::channel('adminlog')->info('M_AD_Login Model', [
            'start updateLoginTime'
        ]);

         M_Login::where('id', '=', $id)
            ->update(['login_dt' => now()]);

        Log::channel('adminlog')->info('M_AD_Login Model', [
            'end updateLoginTime'
        ]);
        return true;
    }


    

}
