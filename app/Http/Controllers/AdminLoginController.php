<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    

    public function loginPage()
    {
        Log::channel('adminlog')->info('AdminController', [
            'start loginPage'
        ]);

        Log::channel('adminlog')->info('AdminController', [
            'end loginPage'
        ]);
        if(session()->has('role')){
            if(session('role') == 'SA') {
                return redirect('/dashboard');
            }else if(session('role') == 'OP'){
            
                return redirect('/sale');
            }else if(session('role') == 'S'){
                return redirect('/sale');
            }
        }
        return view('auth.login');

    }


    public function loginForm(AdminLoginValidation $request)
    {
        Log::channel('adminlog')->info('AdminController', [
            'start loginForm'
        ]);

        Log::channel('adminlog')->info('AdminController', [
            'end loginForm'
        ]);
        if(session()->has('role')){
            if(session('role') == 'SA') {
                return redirect('/dashboard');
            }else if(session('role') == 'OP'){
            
                return redirect('/sale');
            }else if(session('role') == 'S'){
                return redirect('/sale');
            }
        }
     
       

        
    }


    public function logout()
    {
        Log::channel('adminlog')->info('AdminController', [
            'start logout'
        ]);

        session()->forget('adminId');
        session()->forget('name');
        session()->forget('shop');
        session()->forget('role');

        Log::channel('adminlog')->info('AdminController', [
            'end logout'
        ]);
        return redirect('/');
    }
}
