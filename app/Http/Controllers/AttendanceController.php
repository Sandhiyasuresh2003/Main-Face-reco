<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{
    public function show_attendance(){
        if(Auth::check()){
            $user = Auth::user();
            return view('attendance',compact('user'));
        }
    }
}
