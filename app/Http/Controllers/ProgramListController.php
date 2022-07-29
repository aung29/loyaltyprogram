<?php

namespace App\Http\Controllers;

use App\Models\M_Membership_Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramListController extends Controller
{
    
    public function allProgram(){
        Log::channel('adminlog')->info("ProgramList Controller", [
            'Start allProgram'
        ]);
         

        Log::channel('adminlog')->info("ProgramList Controller", [
            'End allProgram'
        ]);
    }

}
