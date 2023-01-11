<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;
use App\Models\User;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class route_domjiController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='0'){

            //กำหนดไว้
            $fd = '222 MB';
            $fd_explode = explode(" ", $fd);
            $int = (int)$fd_explode[0];

            if ($fd_explode[1] == 'KB') {
                $value = ($int * 1024);
            } elseif ($fd_explode[1] == 'MB') {
                $value = ($int * 1048576);
            } elseif ($fd_explode[1] == 'GB') {
                $value = ($int * 1073741824);
            } elseif ($fd_explode[1] == 'TB') {
                $value = ($int * 1099511627776);
            } else {
                $value = $int;
            }

            //ใช้งานแล้ว
            $ss = functionController::folder_Size("image/".functionController::funtion_sites_site_path_folder(Auth::user()->site_id));

            if($value <= $ss){
                dd('คุณใช้พื้นที่เต็มแล้ว กำหนดไว้ :'.functionController::format_Size($value).' ใช้งานแล้ว :'.functionController::format_Size($ss));
            }else{
                dd('ยังไม่เต็ม กำหนดไว้ :'.functionController::format_Size($value).' ใช้งานแล้ว :'.functionController::format_Size($ss));
            }
            // dd($value);
    
       
           

            return view('admin.domji.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }



    public function submit(Request $request){
        if(Auth::user()->level=='0'){
                 
            // $process = new Process(array('/usr/bin/bash', '/var/www/html/signkey/genpripub.sh', '688f227b9cad4edeed15f067e04d3764', '14800228'));

            // $process = new Process(array('/usr/bin/bash', '/var/www/html/signkey/signfile.sh', '688f227b9cad4edeed15f067e04d3764', '14800228', 'image/688f227b9cad4edeed15f067e04d3764/2022/upload/11_2022-07-25.pdf'));
            // $process->run();
            // if (!$process->isSuccessful()) {
            //     throw new ProcessFailedException($process);
            // }
            // dd($process->getOutput());

        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    

}
