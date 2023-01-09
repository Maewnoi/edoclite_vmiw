<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\reserve_number;
use App\Models\document;
use App\Models\Groupmem;
use App\Models\sub_doc;
use App\Models\auto_reserve_numbers;

class reserve_number_receive_inside_allController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            $reserve_inside_numberS = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type','1')
            ->where('reserve_template','A')
            ->orderby('reserve_number','DESC')
            ->get();
            $check_auto_reserve_number = auto_reserve_numbers::where('arn_user_id',Auth::user()->id)
            ->where('arn_template','receive_inside')
            ->first();
            return view('member.reserve_number_receive_inside_all.index',compact('reserve_inside_numberS','check_auto_reserve_number'));
        }elseif(Auth::user()->level=='3'){
            //สารบรรณกลาง
            $reserve_inside_numberS = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_type','1')
            ->where('reserve_template','A')
            ->orderby('reserve_number','DESC')
            ->get();
            return view('member.reserve_number_receive_inside_all.index',compact('reserve_inside_numberS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function add(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'reserve_number'=>'required|max:255'
            ],
            [
                'reserve_number.required'=>"กรุณาเลขที่ต้องการจองด้วยครับ",
                'reserve_number.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );
        //เช็คการค่าซํ้าใน document
        $document_Check_reserve_number = sub_doc::where('sub_recnum', $request->reserve_number)
        ->where('sub_recid',Auth::user()->group)
        ->first();
        if($document_Check_reserve_number){
            return redirect()->back()->with('error','ไม่กี่วินาทีตรวจพบเลข '.$request->reserve_number.' มีการใช้งานในระบบแล้ว');
        }
        //เช็คการค่าซํ้าใน reserve_number
        $reserve_number_Check_reserve_number = reserve_number::where('reserve_number', $request->reserve_number)
        ->where('reserve_group',Auth::user()->group)
        ->where('reserve_site',Auth::user()->site_id)
        ->where('reserve_type', '1')
        ->where('reserve_template', 'A')
        ->first();
        if($reserve_number_Check_reserve_number){
            return redirect()->back()->with('error','ไม่กี่วินาทีตรวจพบเลข '.$request->reserve_number.' มีการจองในระบบแล้ว');
        }

        $insert_reserve_number_receive = reserve_number::insert([
            'reserve_group'=>Auth::user()->group,
            'reserve_number'=>$request->reserve_number,
            'reserve_date'=>date('Y-m-d H:i:s'),
            'reserve_status'=>'0',
            'reserve_type'=>'1',
            'reserve_template' =>'A',
            'reserve_owner'=>Auth::user()->id,
            'reserve_site'=>Auth::user()->site_id,
            'reserve_created_at'=>date('Y-m-d H:i:s')
        ]);
        
        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ จองเลขรับ ⚠️\n>เลขรับ :  ".$request->reserve_number."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }

        if($insert_reserve_number_receive){
            return redirect()->back()->with('success',"จองเลข ".$request->reserve_number." เรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหา กรุณาแจ้งผู้พัฒนา !');
        }

    }

    public function cancel(Request $request){
        //query
        $update = reserve_number::where('reserve_id', $request->reserve_id)->update([
            'reserve_status'=>'2',
            'reserve_used'=>NULL,
            'reserve_updated_at'=>date('Y-m-d H:i:s')
        ]);

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ ยกเลิกเลขรับ ⚠️\n>เลขรับ :  ".$request->reserve_number."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }
        
        if($update){
            return redirect()->back()->with('success',"ยกเลิกเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหา กรุณาแจ้งผู้พัฒนา !');
        }
    }
}
