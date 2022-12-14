<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Groupmem;
use App\Models\sites;
use App\Models\cottons;
use App\Models\replace;

class replaceController extends Controller
{
    public function index(){
        if(Auth::user()->level == '5'){
            //หัวหน้าฝ่าย
            $UserS_0 = User::where('users.level', '7')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.group', Auth::user()->group)
            ->where('users.cotton', Auth::user()->cotton)
            ->get()->toArray();

            $UserS_1 = User::where('users.level', '5')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.group', Auth::user()->group)
            ->where('users.cotton', Auth::user()->cotton)
            ->where('users.id', '!=', Auth::user()->id)
            ->get()->toArray();

            $memberS = array_merge($UserS_0 ,$UserS_1);

        }else if(Auth::user()->level == '4'){
            //หัวหน้ากอง
            $UserS_0 = User::where('users.level', '5')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.group', Auth::user()->group)
            ->get()->toArray();

            $UserS_1 = User::where('users.level', '4')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.id', '!=', Auth::user()->id)
            ->get()->toArray();

            $memberS = array_merge($UserS_0 ,$UserS_1);

        }else if(Auth::user()->level == '2'){
            //รองปลัด /ปลัด
            $UserS_0 = User::where('users.level', '2')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.id', '!=', Auth::user()->id)
            ->get()->toArray();
            
            $memberS = array_merge($UserS_0);

        }else if(Auth::user()->level == '1'){
            //รองนายก /นายก
            $UserS_0 = User::where('users.level', '1')
            ->where('users.site_id', Auth::user()->site_id)
            ->where('users.id', '!=', Auth::user()->id)
            ->get()->toArray();

            $UserS_1 = User::where('users.level', '2')
            ->where('users.site_id', Auth::user()->site_id)
            ->get()->toArray();

            $memberS = array_merge($UserS_0 ,$UserS_1);
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
        // dd($memberS);

        return view('member.replace.index',compact('memberS'));
    }


    public function update(Request $request){
        if($request->act == 'true'){
            $insert_replace = replace::insert([
                'replace_user_id'=>Auth::user()->id,
                'replace_user_id_acting'=>$request->id,
                'replace_created_at'=>date('Y-m-d H:i:s')
            ]);
            if($insert_replace){
                return 1;
            }else{
                return 3;
            }
        }else if($request->act == 'false'){
            $delete_replace = replace::where('replace_user_id_acting', $request->id)
            ->where('replace_user_id', Auth::user()->id)
            ->delete();
            if($delete_replace){
                return 1;
            }else{
                return 3;
            }
        }else{
            return 0;
        }
    }
}