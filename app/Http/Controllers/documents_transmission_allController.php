<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\Groupmem;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\sites;

class documents_transmission_allController extends Controller
{
    //
    public function index(){
        
        if(Auth::user()->level=='3'){
            //สารบรรณกลาง
            // $documents = document::where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'B')
            // ->orderby('doc_date','DESC')
            // ->get();
            return view('member.documents_transmission_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='3'){
            //สารบรรณกลาง
            $document_detail = document::where('doc_id', $id)->where('doc_site_id',Auth::user()->site_id)->first();
            return view('member.documents_transmission_all.detail',compact('document_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

}
