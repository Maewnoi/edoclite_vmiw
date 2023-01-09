<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\member_dashboardController;
use App\Models\sites;
use App\Models\User;
use App\Models\Groupmem;
use App\Models\cottons;

class dashboardController extends Controller
{
    //
    public function index(){
        $level = Auth::user()->level;
        if($level=='0'){
            return view('dashboard');
            // return view('dashboard',compact('users'));
        }else if($level=='1'||$level=='2'||$level=='3'||$level=='4'||$level=='5'||$level=='6'||$level=='7'||$level=='8'){
            return redirect('member_dashboard');
        }else{
            return route('logout');
        }
    }
}
