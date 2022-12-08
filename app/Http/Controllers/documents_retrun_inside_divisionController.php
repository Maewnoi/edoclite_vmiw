<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_divisionController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='4'){
            // $documents_retrun_inside_division = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            // ->where('docrt_owner',Auth::user()->id)
            // ->where('docrt_sites_id',Auth::user()->site_id)
            // ->get();
            return view('member.documents_retrun_inside_division.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    
    public function detail($id){
        if(Auth::user()->level=='4'){
            $document_retrun_inside_detail = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->first();
            return view('member.documents_retrun_inside_division.detail',compact('document_retrun_inside_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
}
