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

            // $memberS=User::join('sites', 'sites.site_id', '=', 'users.site_id')
            // ->get();

            // $i = 0;
            // foreach($memberS as $row){

            //     $process = new Process(array('/usr/bin/bash', '/var/www/html/signkey/genpripub.sh', $row->site_path_folder, $row->id));
            //     $process->run();
            //     if (!$process->isSuccessful()) {
            //         throw new ProcessFailedException($process);
            //     }
              
            //     $i++;
            // }
            // dd($i);
       
           

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
