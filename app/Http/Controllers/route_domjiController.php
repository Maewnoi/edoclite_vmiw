<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;

class route_domjiController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='0'){
            return view('admin.domji.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function submit(Request $request){
        if(Auth::user()->level=='0'){
            $galleryId = 1;
            $path = public_path().'/image/' . $galleryId;
            File::makeDirectory($path, $mode = 0777, true, true);
            dd($path);
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    

}
