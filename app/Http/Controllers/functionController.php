<?php

namespace App\Http\Controllers;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\Groupmem;
use App\Models\sites;
use App\Models\User;
use App\Models\document;
use App\Models\cottons;
use App\Models\replace;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\sub3_doc;
use App\Models\sub3_detail;
use App\Models\token;
use App\Models\auto_reserve_numbers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Cookie;

class functionController extends Controller
{ 
    public static function funtion_check_site_ca($site_id){
        $check_site_ca = sites::where('site_id', $site_id)
        ->first();
        if($check_site_ca){
            if($check_site_ca->site_ca == '0'){
                $text = 'ปิด';
            }else if($check_site_ca->site_ca == '1'){
                $text = 'เปิดใช้งาน';
            }else{
                $text = 'ไม่ถูกนิยาม';
            }
        }else{
            $text = 'ERROR';
        }
        
        return $text;
    }

    public static function funtion_generate_CA_for_PDF($full_path){
        //เช็คสิทธิ์
        $check_site_ca = sites::where('site_id', Auth::user()->site_id)
        ->first();
        if($check_site_ca){
            if($check_site_ca->site_ca == '1'){
                $process = new Process(array('/usr/bin/bash', '/var/www/html/signkey/signfile.sh', $check_site_ca->site_path_folder, Auth::user()->id, $full_path));
                $process->run();
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                return $process->getOutput();
            }else if($check_site_ca->site_ca == '0'){
                return 'null';
            }else{
                dd('ERROR:funtion_generate_CA_for_PDF_check_site_ca');
            }
        }else{
            dd('ERROR:funtion_generate_CA_for_PDF_sites_not');
        }
    }

    public static function get_arn_template($value){
        //ตรวจสอบประเภทเลข
        if($value == 'receive'){
            $txt_arn_template = 'เลขรับภายนอก';
        }else if($value == 'receive_inside'){
            $txt_arn_template = 'เลขรับภายใน';
        }else if($value == 'delivery'){
            $txt_arn_template = 'เลขส่งภายนอก';
        }else if($value == 'delivery_inside'){
            $txt_arn_template = 'เลขส่งภายใน';
        }else if($value == 'announce'){
            $txt_arn_template = 'เลขประกาศภายใน';
        }else if($value == 'order'){
            $txt_arn_template = 'เลขคำสั่งภายใน';
        }else if($value == 'certificate'){
            $txt_arn_template = 'เลขรับรองภายใน';
        }else{
            $txt_arn_template = 'ไม่ถูกนิยาม';
        }
        return $txt_arn_template;
    }

    public static function funtion_auto_reserve_number_quantity(Request $request){
        $check_auto_reserve_numbers = auto_reserve_numbers::where('arn_user_id', $request->id)
        ->where('arn_template',$request->template)
        ->first();
        if($check_auto_reserve_numbers){
            $update_auto_reserve_numbers = auto_reserve_numbers::where('arn_user_id', $request->id)
            ->where('arn_template',$request->template)
            ->update([
                'arn_quantity'=>$request->quantity,
                'arn_updated_at'=>date('Y-m-d H:i:s')
            ]);
            if($update_auto_reserve_numbers){
                return array('status' => '200', 'text' => 'เปลี่ยนจำนวนเลขจองเรียบร้อย');
            }else{
                return array('status' => '404', 'text' => 'พบปัญหา [update_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
            }
        }else{
            return array('status' => '404', 'text' => 'พบปัญหา [check_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
        }
    }

    public static function funtion_auto_reserve_number(Request $request){
        if($request->act == '0'){
            $check_auto_reserve_numbers = auto_reserve_numbers::where('arn_user_id', $request->id)
            ->where('arn_template',$request->template)
            ->first();
            if($check_auto_reserve_numbers){
                $del_auto_reserve_numbers = auto_reserve_numbers::where('arn_user_id', $request->id)
                ->where('arn_template',$request->template)
                ->delete();
                if($del_auto_reserve_numbers){
                    return array('status' => '200', 'text' => 'ปิดการจองเลขอัตโนมัติเรียบร้อย');
                }else{
                    return array('status' => '404', 'text' => 'พบปัญหา [del_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
                }
            }else{
                return array('status' => '404', 'text' => 'พบปัญหา [check_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
            }
        }else if($request->act == '1'){
            $check_auto_reserve_numbers = auto_reserve_numbers::where('arn_user_id', $request->id)
            ->where('arn_template',$request->template)
            ->first();
            if(!$check_auto_reserve_numbers){
                $insert_auto_reserve_numbers = auto_reserve_numbers::insert([
                    'arn_site_id'=>Auth::user()->site_id,
                    'arn_level'=>Auth::user()->level,
                    'arn_user_id'=>$request->id,
                    'arn_quantity'=>$request->quantity,
                    'arn_template'=>$request->template,
                    'arn_created_at'=>date('Y-m-d H:i:s')
                ]);
                if($insert_auto_reserve_numbers){
                    return array('status' => '200', 'text' => 'เปิดการจองเลขอัตโนมัติเรียบร้อย');
                }else{
                    return array('status' => '404', 'text' => 'พบปัญหา [insert_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
                }
            }else{
                return array('status' => '404', 'text' => 'พบปัญหา [check_auto_reserve_numbers][แจ้งผู้พัฒนาระบบ]');
            }
        }else{
            return array('status' => '404', 'text' => 'พบปัญหา [act][แจ้งผู้พัฒนาระบบ]');
        }
    }

    public static function get_site_color(){
        $site_check_color = sites::where('site_id', Auth::user()->site_id)->first();
        if($site_check_color->site_color != null){
            return $site_check_color->site_color;
        }else{
            return 'blue';
        }
    }

    public static function get_site_color_not_auth(){
        $site_check_color = sites::where('site_name', functionController::get_cookie('site_ck'))->first();
        if($site_check_color->site_color != null){
            return $site_check_color->site_color;
        }else{
            return 'blue';
        }
    }

    public static function get_site_img_not_auth(){
        $sites_check_img = sites::where('site_name', functionController::get_cookie('site_ck'))->first();
        if($sites_check_img->site_img != null){
            return $sites_check_img->site_img;
        }else{
            return 'https://sv1.picz.in.th/images/2022/08/02/XR72zv.png';
        }
    }

    public static function get_site_img(){
        $sites_check_img = sites::where('site_id', Auth::user()->site_id)->first();
        if($sites_check_img->site_img != null){
            return $sites_check_img->site_img;
        }else{
            return 'https://sv1.picz.in.th/images/2022/08/02/XR72zv.png';
        }
    }
    public static function get_cookie($name){
        $value = Cookie::get($name);
        return $value;
    }
    
    public static function set_cookie($name,$value){
        // $response = new Response('Hello World');
        // $response->withCookie(cookie()->forever('name-of-cookie', 'value-of-cookie'));
        $response = Cookie::queue($name, $value, 43200);
        return $response;
    }

    public static function format_Size($set_bytes){
        $set_kb = 1024;
        $set_mb = $set_kb * 1024;
        $set_gb = $set_mb * 1024;
        $set_tb = $set_gb * 1024;
        if (($set_bytes >= 0) && ($set_bytes < $set_kb)){
            return $set_bytes . ' B';
        }elseif (($set_bytes >= $set_kb) && ($set_bytes < $set_mb)){
            return ceil($set_bytes / $set_kb) . ' KB';
        }elseif (($set_bytes >= $set_mb) && ($set_bytes < $set_gb)){
            return ceil($set_bytes / $set_mb) . ' MB';
        }elseif (($set_bytes >= $set_gb) && ($set_bytes < $set_tb)){
            return ceil($set_bytes / $set_gb) . ' GB';
        }elseif ($set_bytes >= $set_tb){
            return ceil($set_bytes / $set_tb) . ' TB';
        } else {
            return $set_bytes . ' Bytes';
        }
    }

    public static function folder_Size($set_dir){
        $set_total_size = 0;
        $set_count = 0;
        $set_dir_array = scandir($set_dir);
        foreach($set_dir_array as $key=>$set_filename){
            if($set_filename!=".." && $set_filename!="."){
                if(is_dir($set_dir."/".$set_filename)){
                    $new_foldersize = functionController::folder_Size($set_dir."/".$set_filename);
                    $set_total_size = $set_total_size+ $new_foldersize;
                }else if(is_file($set_dir."/".$set_filename)){
                    $set_total_size = $set_total_size + filesize($set_dir."/".$set_filename);
                    $set_count++;
                }
            }
        }
        return $set_total_size;
    }
    
    //ฟังชันเรียกประเภทเอกสารตอบกลับภายใน
    public static function funtion_docrt_type($speed) {
        if($speed == '0'){
            $txt_docrt_speed = '<span class="badge bg-primary">บันทึกข้อความ</span>';
        }elseif($speed == '1'){
            $txt_docrt_speed = '<span class="badge bg-primary">ตราครุฑ</span>';
        }elseif($speed == '2'){
            $txt_docrt_speed = '<span class="badge bg-primary">แนบไฟล์</span>';
        }
        return $txt_docrt_speed;
    }

    //ฟังชันเรียกชื่อสิทธิ์ด้วย id
    public static function funtion_docrtdt_speed($speed) {
        if($speed == '0'){
            $txt_docrt_speed = '<span class="badge bg-primary">ปกติ</span>';
        }elseif($speed == '1'){
            $txt_docrt_speed = '<span class="badge bg-success">ด่วน</span>';
        }elseif($speed == '2'){
            $txt_docrt_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
        }elseif($speed == '3'){
            $txt_docrt_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
        }
        return $txt_docrt_speed;
    }

    //ฟังชันเรียกสถานะ docrt_status tb: Documents_retruns ด้วย status
    public static function funtion_docrt_status($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้าฝ่าย</span>';
        }else if($status == '1'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้ากอง</span>';
        }else if($status == '2'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณานิติการ</span>';
        }else if($status == '3'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาปลัดและรองปลัด</span>';
        }else if($status == '4'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาปลัดและรองปลัด</span>';
        }else if($status == '5'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณานายกและรองนายก</span>';
        }else if($status == '6'){
            $txt_status = '<span class="badge bg-success">ลงนามเรียบร้อย</span>';
        }else if($status == 'C'){
            $txt_status = '<span class="badge bg-success">ไม่ได้รับการอนุมัติจากนิติกร</span>';
        }else{
            $txt_status = "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }

    public static function funtion_navigation_search(Request $request){
        $level = Auth::user()->level;

        $origin = $request->origin;
        $docnum = $request->docnum;
        $title = $request->title;
        $template = $request->template;
        $recnum = $request->recnum;
        $date = $request->date;
        $date_2 = $request->date_2;
        $secret = $request->secret;
        $speed = $request->speed;
        
        if( $origin == '' &&
            $docnum == '' &&
            $title == '' &&
            $template == '' &&
            $recnum == '' &&
            $date == '' &&
            $date_2 == '' &&
            $secret == '' &&
            $speed == '' ){
            $document = [];
        }else{
            $document = document::where('doc_site_id',Auth::user()->site_id)
            ->when($origin != null, function ($builder) use ($origin){
                $builder->where('doc_origin', 'like', '%' . $origin . '%');
            })
            ->when($docnum != null, function ($builder) use ($docnum){
                $builder->where('doc_docnum', 'like', '%' . $docnum . '%');
            })
            ->when($title != null, function ($builder) use ($title){
                $builder->where('doc_title', 'like', '%' . $title . '%');
            })
            ->when($template == 'documents', function ($builder) use ($template){
                $builder->where('doc_template', 'A');
            })
            ->when($template == 'documents_inside', function ($builder) use ($template){
                $builder->where('doc_template', 'B')
                        ->orWhere('doc_template', 'C')
                        ->orWhere('doc_template', 'D')
                        ->orWhere('doc_template', 'E');
            })
            ->when($recnum != null, function ($builder) use ($recnum){
                $builder->where('doc_recnum', $recnum);
            })
            ->when($date != null, function ($builder) use ($date){
                $builder->where('doc_date', $date);
            })
            ->when($date_2 != null, function ($builder) use ($date_2){
                $builder->where('doc_date_2', $date_2);
            })
            ->when($secret != null, function ($builder) use ($secret){
                $builder->where('doc_secret', $secret);
            })
            ->when($speed != null, function ($builder) use ($speed){
                $builder->where('doc_speed', $speed);
            })
            //นายกรองนายก
            ->when($level == '1', function ($builder) use ($level){
                $builder->join('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
                ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
                ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
                ->where('doc_type', '0')
                ->where('doc_status', 'success')
                ->where('sub_status', '8')
                ->where('sub2_status', '1')
                ->where('sub3_sealid_2', Auth::user()->id);
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //ปลัดรองปลัด
            ->when($level == '2', function ($builder) use ($level){
                $builder->join('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
                ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
                ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
                ->where('doc_type', '0')
                ->where('doc_status', 'success')
                ->where('sub_status', '8')
                ->where('sub2_status', '1')
                ->where(function ($query) {
                    $query->where('sub3_sealid_0', Auth::user()->id)
                        ->orWhere('sub3_sealid_1', Auth::user()->id);
                });
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //สรรบรรณกลาง
            ->when($level == '3', function ($builder) use ($level){
                $builder->where('doc_type', '0');
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //หัวหน้ากอง
            ->when($level == '4', function ($builder) use ($level){
                $builder->leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->where('doc_status', 'success')
                ->where('sub_recid', Auth::user()->group)
                ->where('seal_id_1', Auth::user()->id);
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //หัวหน้าฝ่าย
            ->when($level == '5', function ($builder) use ($level){
                $builder->leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->where('doc_status', 'success')
                ->where('sub_recid', Auth::user()->group)
                ->where('sub_cotton', Auth::user()->cotton)
                ->where('seal_id_0', Auth::user()->id);
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //สรรบรรณกอง
            ->when($level == '6', function ($builder) use ($level){
                $builder->leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->where('doc_status', 'success')
                ->where('sub_recid', Auth::user()->group);
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            //งาน
            ->when($level == '7', function ($builder) use ($level){
                $builder->leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
                ->where('doc_status', 'success')
                ->where('sub_recid', Auth::user()->group)
                ->where('sub_status', '8')
                ->where('sub2_recid', Auth::user()->id);
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            ->when($level == '8', function ($builder) use ($level){
                $builder->where('sub_status', '10');
            })
            //++++++++++=+++++=+++++=+++++=++++++++++
            ->get();
        }
        return $document;
    }

    public static function funtion_generate_PDF_deputy_AND_minister(
        $sub3d_file,
        $sub3_id,
        $sub3_sealid_2,
        $sub3_sealid_3,
        $sub3_sealid_4,
        $sub3_sealid_5,
        $sub3_sealpos_2,
        $sub3_sealpos_3,
        $sub3_sealpos_4,
        $sub3_sealpos_5,
    ){
        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($sub3d_file);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, null, null, null);

            if($pageNo == 1){
                        //Font
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);
            
                if($sub3_sealid_2 == Auth::user()->id){ //ถ้ารองปลัดเข้า
                    $user_3 = User::where('id',$sub3_sealid_2)->first(); //รองปลัด
                    //ลายเซ็นรองปลัด 
                    if($user_3->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,200,10,10);
                    }else{
                        $pdf->Image($user_0->sign,95,200,10,10);
                    }
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(95, 216);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', 'รองปลัด'));

                }else if($sub3_sealid_3 == Auth::user()->id){ //ถ้าปลัดเข้า
                    $user_2 = User::where('id',$sub3_sealid_3)->first(); //ปลัด
                    //ลายเซ็นปลัด 
                    if($user_2->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,220,10,10);
                    }else{
                        $pdf->Image($user_0->sign,95,220,10,10);
                    }
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(95, 236);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', 'ปลัด'));

                }else if($sub3_sealid_4 == Auth::user()->id){ //ถ้ารองนายกเข้า
                    $user_1 = User::where('id',$sub3_sealid_4)->first(); //รองนายก
                    //ลายเซ็นรองนายก
                    if($user_1->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                    }else{
                        $pdf->Image($user_1->sign,95,240,10,10);
                    }
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(95, 256);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', 'รองนายก'));

                }else if($sub3_sealid_5 == Auth::user()->id){ //ถ้านายกเข้า
                    $user_0 = User::where('id',$sub3_sealid_5)->first(); //นายก
                    //ลายเซ็นนายก
                    if($user_0->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
                    }else{
                        $pdf->Image(Auth::user()->sign,95,260,10,10);
                    }
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(95, 276);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', 'นายก'));
                    
                }
            }
        }
        // return response($pdf->Output())->header('Content-Type', 'application/pdf');
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
        $name_gen_new = $sub3_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;

    }

    public static function funtion_generate_PDF_VI(
        $sub3d_file,
        $sub3_sealid_0,
        $sub3_sealid_1,
        $sub3_sealid_2,
        $sub3_sealpos_0,
        $sub3_sealpos_1,
        $sub3_sealpos_2,
        $doc_id
    ){
        $pdf = new Fpdi();
        $pdf->AddPage();
        //Font
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($sub3d_file);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, null, null, null);
        }

        if($sub3_sealid_0 == Auth::user()->id){ //ถ้ารองปลัดเข้า
            //ลายเซ็นรองปลัด
            if(Auth::user()->sign == ''){
                $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
            }else{
                $pdf->Image(Auth::user()->sign,95,260,10,10);
            }
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(95, 276);
            $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_0));

            if($sub3_sealid_1 != null){ //ถ้าพบลายเซ็นปลัด
                $user_1 = User::where('id',$sub3_sealid_1)->first();
                //ลายเซ็นปลัดรองปลัด 
                if($user_1->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                }else{
                    $pdf->Image($user_1->sign,95,240,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 256);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_1));
            }

        }else if($sub3_sealid_1 == Auth::user()->id){ //ถ้าปลัดเข้า
            //ลายเซ็นปลัด
            if(Auth::user()->sign == ''){
                $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
            }else{
                $pdf->Image(Auth::user()->sign,95,260,10,10);
            }
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(95, 276);
            $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_1));

            if($sub3_sealid_0 != null){ //ถ้าพบลายเซ็นรองปลัด
                $user_0 = User::where('id',$sub3_sealid_0)->first();
                //ลายเซ็นปลัดรองปลัด 
                if($user_0->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                }else{
                    $pdf->Image($user_0->sign,95,240,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 256);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_0));
            }
        }else if($sub3_sealid_2 == Auth::user()->id){ //ถ้านายกเข้า
            if($sub3_sealid_0 != null && $sub3_sealid_1 != null){ //ถ้าพบลายเซ็น รองปลัด ปลัด
                //คิวหาลายเซ็น
                $user_0 = User::where('id',$sub3_sealid_0)->first();
                $user_1 = User::where('id',$sub3_sealid_1)->first();
                //ลายเซ็นนายกรองนายก
                if(Auth::user()->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
                }else{
                    $pdf->Image(Auth::user()->sign,95,260,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 276);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_2));

                //ลายเซ็นปลัดรองปลัด 
                if($user_1->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                }else{
                    $pdf->Image($user_1->sign,95,240,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 256);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_1));

                //ลายเซ็นปลัดรองปลัด 
                if($user_0->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,220,10,10);
                }else{
                    $pdf->Image($user_0->sign,95,220,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 236);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_0));
            }else if($sub3_sealid_0 != null && $sub3_sealid_1 == null){ //ถ้าพบลายเซ็น รองปลัด
                //คิวหาลายเซ็น
                $user_0 = User::where('id',$sub3_sealid_0)->first();
                //ลายเซ็นนายกรองนายก
                if(Auth::user()->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
                }else{
                    $pdf->Image(Auth::user()->sign,95,260,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 276);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_2));

                //ลายเซ็นปลัดรองปลัด
                if($user_0->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                }else{
                    $pdf->Image($user_0->sign,95,240,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 256);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_0));
            }else if($sub3_sealid_0 == null && $sub3_sealid_1 != null){ //ถ้าพบลายเซ็น ปลัด
                //คิวหาลายเซ็น
                $user_1 = User::where('id',$sub3_sealid_1)->first();
                //ลายเซ็นนายกรองนายก
                if(Auth::user()->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
                }else{
                    $pdf->Image(Auth::user()->sign,95,260,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 276);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_2));

                //ลายเซ็นปลัดรองปลัด 
                if($user_1->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,240,10,10);
                }else{
                    $pdf->Image($user_1->sign,95,240,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 256);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_1));
                
            }else{
                //ลายเซ็นนายกรองนายก
                if(Auth::user()->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',95,260,10,10);
                }else{
                    $pdf->Image(Auth::user()->sign,95,260,10,10);
                }
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(95, 276);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub3_sealpos_2));
            }
        }else{ //error
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [sealid] !');
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
        $name_gen_new = $doc_id."_".$date_new;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;

        // return response($pdf->Output())->header('Content-Type', 'application/pdf');

    }
    
    public static function funtion_site_ca_update(Request $request) {
        if($request->var_status == '0'){
            $sites_update = sites::where('site_id', $request->var_id)->update([
                'site_ca'=>'0'
            ]);
            return array('status' => '200', 'text' => 'ปิดระบบเรียบร้อย');
        }else if($request->var_status == '1'){
            $sites_update = sites::where('site_id', $request->var_id)->update([
                'site_ca'=>'1'
            ]);
            return array('status' => '200', 'text' => 'เปิดระบบเรียบร้อย');
        }else{
            return array('status' => '404', 'text' => 'พบปัญหา [แจ้งผู้พัฒนาระบบ]');
        }
    }

    public static function funtion_user_center_update(Request $request) {
        if($request->var_status == '0'){
            $user_center_update = User::where('id', $request->var_id)->update([
                'center'=>'0'
            ]);
            return array('status' => '200', 'text' => 'ปิดผู้พิจารณาเรียบร้อย');
        }else if($request->var_status == '1'){
            $user_center_update = User::where('id', $request->var_id)->update([
                'center'=>'1'
            ]);
            return array('status' => '200', 'text' => 'เปิดผู้พิจารณาเรียบร้อย');
        }else{
            return array('status' => '404', 'text' => 'พบปัญหา [แจ้งผู้พัฒนาระบบ]');
        }
    }

    public static function funtion_jurisprudence_update(Request $request) {
        if($request->var_status == '0'){
            $jurisprudence_update = User::where('id', $request->var_id)->update([
                'jurisprudence'=>'0'
            ]);
            return array('status' => '200', 'text' => 'ปิดนิติการเรียบร้อย');
        }else if($request->var_status == '1'){
            $jurisprudence_update = User::where('id', $request->var_id)->update([
                'jurisprudence'=>'1'
            ]);
            return array('status' => '200', 'text' => 'เปิดนิติการเรียบร้อย');
        }else{
            return array('status' => '404', 'text' => 'พบปัญหา [แจ้งผู้พัฒนาระบบ]');
        }
    }

    public static function funtion_generate_PDF_V($doc_filedirec_1, $doc_id){
        $pdf = new Fpdi();
        $pdf->AddPage();

        //Font
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);

        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($doc_filedirec_1);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/work/';
        $name_gen_new = $doc_id."_".$date_new;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;

    }
    public static function funtion_generate_PDF_IV($seal_point, $sub_recnum, $sub_date, $sub_time, $doc_docnum, $doc_title, $doc_filedirec, $sub_id, $sign_goup_0){
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();

        $pdf = new Fpdi();
        $pdf->AddPage();
        
        //Font
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);

        if($groupmems->group_seal == ''){
            $tokens = token::where('tokens'.'token_site_id', Auth::user()->site_id)
            ->first();

            $pdf->Image($tokens->token_seal,$seal_point,10,40,23);
        }else{
            $pdf->Image($groupmems->group_seal,$seal_point,10,40,23);
        }
         //กำหนดแกน x ให้กับข้อความ
         $xx1 = 0;
         $xx2 = 0;
         $xx3 = 0;
         if($seal_point > 85){
            //ขวา เพิ่ม
             for ($t = 85; $t < $seal_point; $t++) {
                 $xx1 += 1;
                 $xx2 += 1;
                 $xx3 += 1;
             }
             $x1 = 100 + $xx1;
             $x2 = 93 + $xx2;
             $x3 = 97 + $xx3;
         }else if($seal_point < 85){
             //ซ้าย ลด
             for ($t = 85; $t > $seal_point; $t--) {
                 $xx1 += 1;
                 $xx2 += 1;
                 $xx3 += 1;
             }
             $x1 = 100 - $xx1;
             $x2 = 93 - $xx2;
             $x3 = 97 - $xx3;
         }else if($seal_point == 85){
             $x1 = 100;
             $x2 = 93;
             $x3 = 97;
         }

        //ข้อความประทับตรา 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($x1, 18);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $sub_recnum));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($x2, 23.5);
        $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($sub_date)));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($x3, 28.5);
        $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_time_format($sub_time)));

        //เลขที่หนังสือ
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(30, 42);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เลขที่หนังสือ '));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(53, 42);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $doc_docnum));
        //เรื่อง
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(30, 50);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง '));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(43, 50);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $doc_title));
 
        //พิจารณาเลือกกองที่เกี่ยวข้อง       
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(85, 60);
        $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', functionController::funtion_groupmem_name(Auth::user()->group)),'0','L',false);

        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $sign = 'https://sv1.picz.in.th/images/2022/08/02/XR72zv.png';
        }else{
            $sign = Auth::user()->sign;
        }
        $pdf->Image($sign,85,80,20,20);

        //ตำแหน่ง 25
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(85, 105);
        $pdf->Write(0, iconv('UTF-8', 'cp874', Auth::user()->pos));
        //วันที่เซ็น 6
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(85, 111);
        $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($sub_date)));

        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($doc_filedirec);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
        }

        if($sign_goup_0 == ''){
            $path_ = 'work';
        }else if($sign_goup_0 == 'cottons'){
            $path_ = 'department';
        }else if($sign_goup_0 == 'groupmems'){
            $path_ = 'division';
        }

        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/'.$path_.'/';
        $name_gen_new = $sub_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        // return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }
    
    //ฟังชันเรียก เลขส่ง หลุดจอง ล่าสุด +1 tb : documents ด้วย doc_template_inside
    public static function getdoc_recnum_inside_dropped($id) {
        if($id == 'B'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'B')
            ->where('reserve_status', '2')
            ->get();
        }else if($id == 'C'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'C')
            ->where('reserve_status', '2')
            ->get();
        }else if($id == 'D'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'D')
            ->where('reserve_status', '2')
            ->get();
        }else if($id == 'E'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'E')
            ->where('reserve_status', '2')
            ->get();
        }else{
            $data = '';
        }
        return $data;
    }
    //ฟังชันเรียก เลขส่ง จอง ล่าสุด +1 tb : documents ด้วย doc_template_inside
    public static function getdoc_recnum_inside_reserve($id) {
        if($id == 'B'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'B')
            ->where('reserve_status', '0')
            ->get();
        }else if($id == 'C'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'C')
            ->where('reserve_status', '0')
            ->get();
        }else if($id == 'D'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'D')
            ->where('reserve_status', '0')
            ->get();
        }else if($id == 'E'){
            $data = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'E')
            ->where('reserve_status', '0')
            ->get();
        }else{
            $data = '';
        }
        return $data;
    }
    //ฟังชันเรียก เลขส่ง รัน ล่าสุด +1 tb : documents ด้วย doc_template_inside
    public static function getdoc_recnum_inside_run($id) {
        if($id == 'B'){
            //หาเลขรัน
            $data = functionController::funtion_documents_doc_recnum_delivery_inside_plus(Auth::user()->site_id);
        }else if($id == 'C'){
            $data = functionController::funtion_documents_doc_recnum_announce_plus(Auth::user()->site_id);
        }else if($id == 'D'){
            $data = functionController::funtion_documents_doc_recnum_order_plus(Auth::user()->site_id);
        }else if($id == 'E'){
            $data = functionController::funtion_documents_doc_recnum_certificate_plus(Auth::user()->site_id);
        }else{
            $data = '';
        }
        return $data;
    }

    //function pdf_preview
    public static function funtion_PDFRespond_garuda(Request $request) {
        $pdf = new Fpdi();
        $pdf->AddPage();

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 42.5);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_draft_garuda));

        $pdf->Image('image/Garuda.jpeg',90,25,25,25);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(135, 40);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(50,5, iconv('UTF-8', 'cp874', $request->sub3d_government_garuda),'0','L',false); 

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(100, 60);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_date_garuda));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 70); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 70); 
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_topic_garuda));

        $strlen_podium = strlen($request->sub3d_podium_garuda);
        // $strip_tags_podium = strip_tags($request->sub3d_podium,"<b><p>");
        // console.log($strip_tags_podium);
        if($strlen_podium <='270'){
            $MultiCell_H = 6;
        }else if($strlen_podium >= '271' && $strlen_podium <= '740'){
            $MultiCell_H = 7;
        }else if($strlen_podium >= '741' && $strlen_podium <= '1010'){
            $MultiCell_H = 8;
        }else if($strlen_podium >= '1011' ){
            $MultiCell_H = 9;
        }
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 80); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(160,$MultiCell_H, iconv('UTF-8', 'cp874', $request->sub3d_podium_garuda),'0','L',false);

        if($MultiCell_H == 6){
            $sign_H = 80+40;
        }else if($MultiCell_H == 7){
            $sign_H = 80+90;
        }else if($MultiCell_H == 8){
            $sign_H = 80+130;
        }else if($MultiCell_H == 9){
            $sign_H = 80+160;
        }

        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',140,$sign_H,10,10);
        }else{
            $pdf->Image(Auth::user()->sign,140,$sign_H,10,10);
        }
        $pos_H = $sign_H+12;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, $pos_H);
        $pdf->Write(0, iconv('UTF-8', 'cp874', Auth::user()->pos));

        if($request->action_garuda == 'preview'){
            return response($pdf->Output())->header('Content-Type', 'application/pdf');
        }else if($request->action_garuda == 'respond'){
            $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
            $random = Str::random(5);
            $date_new = date('Y-m-d');
            $year_new = date('Y');
            $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
            $name_gen_new = $request->sub3_id_garuda."_".$date_new."_".$random;
            // $name_gen_new = 'test_by_domji';
            $full_path = $upload_location.$name_gen_new.'.pdf';
            $pdf->Output('F', $full_path);
            // return response($pdf->Output())->header('Content-Type', 'application/pdf');
            return $full_path;
        }else{
            return "Error".$request;
        }
    }

     //function pdf_preview
     public static function funtion_PDFRespond_garuda_retrun(Request $request) {
        $pdf = new Fpdi();
        $pdf->AddPage();

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 42.5);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_draft_garuda));

        $pdf->Image('image/Garuda.jpeg',90,25,25,25);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(135, 40);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(50,5, iconv('UTF-8', 'cp874', $request->docrtdt_government_garuda),'0','L',false); 

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(100, 60);
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_date_garuda));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 70); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 70); 
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_topic_garuda));

        $strlen_podium = strlen($request->docrtdt_podium_garuda);
        // $strip_tags_podium = strip_tags($request->docrtdt_podium,"<b><p>");
        // console.log($strip_tags_podium);
        if($strlen_podium <='270'){
            $MultiCell_H = 6;
        }else if($strlen_podium >= '271' && $strlen_podium <= '740'){
            $MultiCell_H = 7;
        }else if($strlen_podium >= '741' && $strlen_podium <= '1010'){
            $MultiCell_H = 8;
        }else if($strlen_podium >= '1011' ){
            $MultiCell_H = 9;
        }
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 80); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(160,$MultiCell_H, iconv('UTF-8', 'cp874', $request->docrtdt_podium_garuda),'0','L',false);

        if($MultiCell_H == 6){
            $sign_H = 80+40;
        }else if($MultiCell_H == 7){
            $sign_H = 80+90;
        }else if($MultiCell_H == 8){
            $sign_H = 80+130;
        }else if($MultiCell_H == 9){
            $sign_H = 80+160;
        }

        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',140,$sign_H,10,10);
        }else{
            $pdf->Image(Auth::user()->sign,140,$sign_H,10,10);
        }
        $pos_H = $sign_H+12;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, $pos_H);
        $pdf->Write(0, iconv('UTF-8', 'cp874', Auth::user()->pos));

        if($request->action_garuda == 'preview'){
            return response($pdf->Output())->header('Content-Type', 'application/pdf');
        }else if($request->action_garuda == 'respond'){
            $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
            $random = Str::random(5);
            $date_new = date('Y-m-d');
            $year_new = date('Y');
            $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
            $name_gen_new = $request->docrt_id_garuda."_".$date_new."_".$random;
            // $name_gen_new = 'test_by_domji';
            $full_path = $upload_location.$name_gen_new.'.pdf';
            $pdf->Output('F', $full_path);
            // return response($pdf->Output())->header('Content-Type', 'application/pdf');
            return $full_path;
        }else{
            return "Error".$request;
        }
    }

    //function pdf_preview
    public static function funtion_PDFRespond(Request $request) {
        // return response()->json($request->sub3d_government,200);

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->Image('image/Garuda.jpeg',25,25,20,20);
        
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(95, 35);
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',20);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'บันทึกข้อความ'));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 55); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'ส่วนราชการ'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(50, 55); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_government));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 67); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'ที่ร่าง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 67); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_draft));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(125, 67); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'วันที่'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, 67); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_date));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 79); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 79); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_topic));
        // ----------- ----------- ----------- ----------- ----------- -----------
        // นำจำนวน
        $strlen_podium = strlen($request->sub3d_podium);
        // $strip_tags_podium = strip_tags($request->sub3d_podium,"<b><p>");
        // console.log($strip_tags_podium);
        if($strlen_podium <='270'){
            $MultiCell_H = 6;
        }else if($strlen_podium >= '271' && $strlen_podium <= '740'){
            $MultiCell_H = 7;
        }else if($strlen_podium >= '741' && $strlen_podium <= '1010'){
            $MultiCell_H = 8;
        }else if($strlen_podium >= '1011' ){
            $MultiCell_H = 9;
        }
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 91); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(160,$MultiCell_H, iconv('UTF-8', 'cp874', $request->sub3d_podium),'0','L',false); //strip_tags($request->sub3d_podium,"<b><i>&nbsp;")

        if($MultiCell_H == 6){
            $sign_H = 91+40;
        }else if($MultiCell_H == 7){
            $sign_H = 91+90;
        }else if($MultiCell_H == 8){
            $sign_H = 91+130;
        }else if($MultiCell_H == 9){
            $sign_H = 91+160;
        }
     
        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',140,$sign_H,10,10);
        }else{
            $pdf->Image(Auth::user()->sign,140,$sign_H,10,10);
        }
        $pos_H = $sign_H+12;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, $pos_H);
        $pdf->Write(0, iconv('UTF-8', 'cp874', Auth::user()->pos));
        
        // $pdf->Ln();
        // // ----------- ----------- ----------- ----------- ----------- -----------
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->SetXY(75, 250); //+12
        // $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        // $pdf->SetFont('THSarabunNew','B',16);
        // $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_therefore));
        // // ----------- ----------- ----------- ----------- ----------- -----------
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->SetXY(95, 260); //+12
        // $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        // $pdf->SetFont('THSarabunNew','B',16);
        // $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_pos));

        if($request->action == 'preview'){
            return response($pdf->Output())->header('Content-Type', 'application/pdf');
        }else if($request->action == 'respond'){
            $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
            $random = Str::random(5);
            $date_new = date('Y-m-d');
            $year_new = date('Y');
            $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
            $name_gen_new = $request->sub3_id."_".$date_new."_".$random;
            // $name_gen_new = 'test_by_domji';
            $full_path = $upload_location.$name_gen_new.'.pdf';
            $pdf->Output('F', $full_path);
            // return response($pdf->Output())->header('Content-Type', 'application/pdf');
            return $full_path;
        }else{
            return "Error".$request;
        }
        

    }

    //function pdf_preview
    public static function funtion_PDFRespond_retrun(Request $request) {
        // return response()->json($request->sub3d_government,200);

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->Image('image/Garuda.jpeg',25,25,20,20);
        
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(95, 35);
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',20);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'บันทึกข้อความ'));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 55); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'ส่วนราชการ'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(50, 55); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_government));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 67); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'ที่ร่าง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 67); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_draft));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(125, 67); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'วันที่'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, 67); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_date));
        // ----------- ----------- ----------- ----------- ----------- -----------
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 79); //+12
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง'));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(40, 79); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $request->docrtdt_topic));
        // ----------- ----------- ----------- ----------- ----------- -----------
        // นำจำนวน
        $strlen_podium = strlen($request->docrtdt_podium);
        // $strip_tags_podium = strip_tags($request->sub3d_podium,"<b><p>");
        // console.log($strip_tags_podium);
        if($strlen_podium <='270'){
            $MultiCell_H = 6;
        }else if($strlen_podium >= '271' && $strlen_podium <= '740'){
            $MultiCell_H = 7;
        }else if($strlen_podium >= '741' && $strlen_podium <= '1010'){
            $MultiCell_H = 8;
        }else if($strlen_podium >= '1011' ){
            $MultiCell_H = 9;
        }
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 91); //+12
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);
        $pdf->MultiCell(160,$MultiCell_H, iconv('UTF-8', 'cp874', $request->docrtdt_podium),'0','L',false); //strip_tags($request->sub3d_podium,"<b><i>&nbsp;")

        if($MultiCell_H == 6){
            $sign_H = 91+40;
        }else if($MultiCell_H == 7){
            $sign_H = 91+90;
        }else if($MultiCell_H == 8){
            $sign_H = 91+130;
        }else if($MultiCell_H == 9){
            $sign_H = 91+160;
        }
     
        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',140,$sign_H,10,10);
        }else{
            $pdf->Image(Auth::user()->sign,140,$sign_H,10,10);
        }
        $pos_H = $sign_H+12;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140, $pos_H);
        $pdf->Write(0, iconv('UTF-8', 'cp874', Auth::user()->pos));
        
        // $pdf->Ln();
        // // ----------- ----------- ----------- ----------- ----------- -----------
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->SetXY(75, 250); //+12
        // $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        // $pdf->SetFont('THSarabunNew','B',16);
        // $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_therefore));
        // // ----------- ----------- ----------- ----------- ----------- -----------
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->SetXY(95, 260); //+12
        // $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
        // $pdf->SetFont('THSarabunNew','B',16);
        // $pdf->Write(0, iconv('UTF-8', 'cp874', $request->sub3d_pos));

        if($request->action == 'preview'){
            return response($pdf->Output())->header('Content-Type', 'application/pdf');
        }else if($request->action == 'respond'){
            $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
            $random = Str::random(5);
            $date_new = date('Y-m-d');
            $year_new = date('Y');
            $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
            $name_gen_new = $request->docrt_id."_".$date_new."_".$random;
            // $name_gen_new = 'test_by_domji';
            $full_path = $upload_location.$name_gen_new.'.pdf';
            $pdf->Output('F', $full_path);
            // return response($pdf->Output())->header('Content-Type', 'application/pdf');
            return $full_path;
        }else{
            return "Error".$request;
        }
        

    }
   
    //ฟังชันเรียก tb reserve_numbers ด้วย id user
    public static function funtion_calendarReserve($id) {
        header("Access-Control-Allow-Origin: * ");
        header("Content-Type: application/json; charset=UTF-8");
        ini_set('memory_limit', '2048M');
        $json_data = array();

        if(Auth::user()->level == '3'){
            //เลขรับภายนอก
            $reserve_numbers_t0_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->whereNull('reserve_group')
            ->where('reserve_type','0')
            ->where('reserve_template','A')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขรับภายใน
            $reserve_numbers_t1_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type','0')
            ->where('reserve_template','B')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();

            foreach ($reserve_numbers_t0_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#20B2AA', //Primary (light-blue),
                    'borderColor' => '#20B2AA' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t1_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#696969', //Primary (light-blue),
                    'borderColor' => '#696969' //Primary (light-blue),
                ];
            }

            $json = json_encode($json_data);
            return $json;

        }else if(Auth::user()->level == '6'){

            //เลขรับภายนอก
            $reserve_numbers_t0_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->whereNull('reserve_group')
            ->where('reserve_type','0')
            ->where('reserve_template','A')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขรับภายใน
            $reserve_numbers_t1_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type','1')
            ->where('reserve_template','A')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขส่ง
            $reserve_numbers_t2_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_type','1')
            ->where('reserve_template','B')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขประกาศ
            $reserve_numbers_t3_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_type','1')
            ->where('reserve_template','C')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขคำสั่ง
            $reserve_numbers_t4_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_type','1')
            ->where('reserve_template','D')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();
            //เลขหนังสือรับรอง
            $reserve_numbers_t5_pa_count = reserve_number::
            select(reserve_number::raw("reserve_id"),reserve_number::raw("reserve_number"),reserve_number::raw("DATE_FORMAT(reserve_date, '%Y-%m-%d') as date_format"))
            ->where('reserve_owner',$id)
            ->where('reserve_type','1')
            ->where('reserve_template','E')
            ->where('reserve_status','0')
            ->where('reserve_site',Auth::user()->site_id)
            ->orderByDesc('reserve_date')
            ->get();

            foreach ($reserve_numbers_t0_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#20B2AA', //Primary (light-blue),
                    'borderColor' => '#20B2AA' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t1_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#696969', //Primary (light-blue),
                    'borderColor' => '#696969' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t2_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#0066FF', //Primary (light-blue),
                    'borderColor' => '#0066FF' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t3_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#00CC00', //Primary (light-blue),
                    'borderColor' => '#00CC00' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t4_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#CC0000', //Primary (light-blue),
                    'borderColor' => '#CC0000' //Primary (light-blue),
                ];
            }
            foreach ($reserve_numbers_t5_pa_count as $row){
                $json_data[] = [
                    'id' => $row['reserve_id'],
                    'title' => $row['reserve_number'],
                    'start' => $row['date_format'],
                    'end' => $row['date_format'],
                    'backgroundColor' => '#FFCC00', //Primary (light-blue),
                    'borderColor' => '#FFCC00' //Primary (light-blue),
                ];
            }

            $json = json_encode($json_data);
            return $json;

        }else{
            $json = json_encode($json_data);
            return $json;
        }
       
        
    }

    //ฟังชันเรียก เลขรับภายในล่าสุด +1 tb : documents ด้วย id_group
    public static function funtion_documents_doc_recnum_inside_plus($id) {
        $sub_doc_count = sub_doc::where('sub_recid',Auth::user()->group)
        ->max('sub_recnum');

        // ->where('doc_type','0')
        // ->where('doc_template','A')
        //จอย tb

        $sub_doc_count_plus = $sub_doc_count + 1;

        for ($i = $sub_doc_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'A')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $sub_doc_count_plus = $i;
                break;
            }
        }
        return $sub_doc_count_plus;
    }

    //ฟังชันเรียก เลขรับภายในล่าสุด +1 tb : sub ด้วย id_group
    public static function funtion_documents_doc_recnum_inside_plus_1($id,$group) {
        $sub_doc_count = sub_doc::where('sub_recid',$group)
        ->max('sub_recnum');

        $sub_doc_count_plus = $sub_doc_count + 1;

        for ($i = $sub_doc_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_group',$group)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'A')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $sub_doc_count_plus = $i;
                break;
            }
        }
        return $sub_doc_count_plus;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ นายก
    public function getuserS_1_documents_admission_division_allController_2($id,$id_1,$id_2)
    {
        $userS = User::where('id','!=',$id)
        ->where('id','!=',$id_2)
        ->where('id','!=',$id_1)
        ->where('level','1')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ รองนายก|ปลัด|รองปลัด 
    public function getuserS_2_documents_admission_division_allController_2($id,$id_1,$id_2)
    {
        $userS = User::where('id','!=',$id)
        ->where('id','!=',$id_2)
        ->where('id','!=',$id_1)
        ->where('level','2')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ นายก
    public function getuserS_1_documents_admission_division_allController_1($id,$id_1)
    {
        $userS = User::where('id','!=',$id)
        ->where('id','!=',$id_1)
        ->where('level','1')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ รองนายก|ปลัด|รองปลัด 
    public function getuserS_2_documents_admission_division_allController_1($id,$id_1)
    {
        $userS = User::where('id','!=',$id)
        ->where('id','!=',$id_1)
        ->where('level','2')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ นายก
    public function getuserS_1_documents_admission_division_allController_0($id)
    {
        $userS = User::where('id','!=',$id)
        ->where('level','1')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    //function เรียก users ด้วย id เรียกสิทธื์ รองนายก|ปลัด|รองปลัด 
    public function getuserS_2_documents_admission_division_allController_0($id)
    {
        $userS = User::where('id','!=',$id)
        ->where('level','2')
        ->where('site_id',Auth::user()->site_id)
        ->select('name', 'id')
        ->distinct()
        ->get();
        return $userS;
    }

    
    public static function funtion_generate_PDF_department_to_division($seal_file ,$seal_detail_0 ,$seal_id_0 ,$seal_pos_0 ,$sub_id) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();

        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($seal_file);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
            //เอาแค่หน้าแรก
            if($pageNo == 1){
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);

                $x = 210;
                //หมายเหตุ   
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(70, $x);
                $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_0),'0','L',false);

                //ลายเซ็นหัวหน้ากอง
                $user_Check = User::where('id', $seal_id_0)
                ->first();
                $x = $x + 20;
                if($user_Check->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,$x,20,20);
                }else{
                    $pdf->Image($user_Check->sign,85,$x,20,20);
                }
                
                $x = $x + 25;
                //ตำแหน่ง 25
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(85, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_0));
                
                //วันที่เซ็น 6
                $x = $x + 6;
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(90, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
            }
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/division/';
        $name_gen_new = $sub_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        //  return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }
    public static function funtion_generate_PDF_department_to_work($seal_file ,$seal_detail_0 ,$seal_id_0 ,$seal_pos_0 ,$sub_id) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();

        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($seal_file);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
            //เอาแค่หน้าแรก
            if($pageNo == 1){
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);

                $x = 210;
                //หมายเหตุ   
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(70, $x);
                $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_0),'0','L',false);

                //ลายเซ็นหัวหน้ากอง
                $user_Check = User::where('id', $seal_id_0)
                ->first();
                $x = $x + 20;
                if($user_Check->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,$x,20,20);
                }else{
                    $pdf->Image($user_Check->sign,85,$x,20,20);
                }
                
                $x = $x + 25;
                //ตำแหน่ง 25
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(85, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_0));
                
                //วันที่เซ็น 6
                $x = $x + 6;
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(90, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
            }
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/work/';
        $name_gen_new = $sub_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        //  return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }
    
    public static function funtion_generate_PDF_division_to_department($seal_file ,$seal_detail_1 ,$seal_id_1 ,$seal_pos_1 ,$sub_id) {
         // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
         $groupmems = Groupmem::where('group_id', Auth::user()->group)
         ->where('group_site_id',Auth::user()->site_id)
         ->first();
    
         $pdf = new Fpdi();
         //นับจำนวนหน้า
         $sourceFilePages = $pdf->setSourceFile($seal_file);
         for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
             $tplIdx = $pdf->importPage($pageNo);
             $pdf->AddPage();
             $pdf->useTemplate($tplIdx, null, null, null);
             //เอาแค่หน้าแรก
             if($pageNo == 1){
                 $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                 $pdf->SetFont('THSarabunNew','',16);
 
                 $x = 140;
                 //หมายเหตุ   
                 $pdf->SetTextColor(0, 0, 0);
                 $pdf->SetXY(70, $x);
                 $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_1),'0','L',false);
 
                 //ลายเซ็นหัวหน้ากอง
                 $user_Check = User::where('id', $seal_id_1)
                 ->first();
                 $x = $x + 20;
                 if($user_Check->sign == ''){
                     $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,$x,20,20);
                 }else{
                     $pdf->Image($user_Check->sign,85,$x,20,20);
                 }
                 
                 $x = $x + 25;
                 //ตำแหน่ง 25
                 $pdf->SetTextColor(0, 0, 0);
                 $pdf->SetXY(85, $x);
                 $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_1));
                 
                 //วันที่เซ็น 6
                 $x = $x + 6;
                 $pdf->SetTextColor(0, 0, 0);
                 $pdf->SetXY(90, $x);
                 $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
             }
         }
         $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
         $random = Str::random(5);
         $date_new = date('Y-m-d');
         $year_new = date('Y');
         $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/department/';
         $name_gen_new = $sub_id."_".$date_new."_".$random;
         $full_path = $upload_location.$name_gen_new.'.pdf';
         $pdf->Output('F', $full_path);
         return $full_path;
        //  return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }
    
    public static function funtion_generate_PDF_division_to_work($seal_file ,$seal_detail_1 ,$seal_id_1 ,$seal_pos_1 ,$sub_id) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();
   
        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($seal_file);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
            //เอาแค่หน้าแรก
            if($pageNo == 1){
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);

                $x = 140;
                //หมายเหตุ   
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(70, $x);
                $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_1),'0','L',false);

                //ลายเซ็นหัวหน้ากอง
                $user_Check = User::where('id', $seal_id_1)
                ->first();
                $x = $x + 20;
                if($user_Check->sign == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,$x,20,20);
                }else{
                    $pdf->Image($user_Check->sign,85,$x,20,20);
                }
                
                $x = $x + 25;
                //ตำแหน่ง 25
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(85, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_1));
                
                //วันที่เซ็น 6
                $x = $x + 6;
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(90, $x);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
            }
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/work/';
        $name_gen_new = $sub_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        // return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }
    //function ประทับตราและเซน ของหัวหน้าฝ่ายหรือหัวหน้ากอง
    public static function funtion_generate_PDF_III($doc_filedirec_1 ,$seal_point ,$sub_recnum ,$sub_date ,$sub_time ,$sub_id ,$seal_pos_0 ,$seal_date_1 ,$seal_pos_1 ,$seal_date_0 ,$seal_id_1 ,$seal_id_0 ,$seal_detail_1 ,$seal_detail_0) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();

        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($doc_filedirec_1);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
            //เอาแค่หน้าแรก
            if($pageNo == 1){
                //Font
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);

                
                //กำหนดแกน x ให้กับข้อความ
                  $x1 = 0; $x2 = 0; $x3 = 0;
                  if($seal_point == '1'){ $sealpoint = 3; $x1 = 20; $x2 = 13; $x3 = 17; }
                  if($seal_point == '2'){ $sealpoint = 43; $x1 = 60; $x2 = 53; $x3 = 57; }
                  if($seal_point == '3'){ $sealpoint = 83; $x1 = 100; $x2 = 93; $x3 = 97; }
                  if($seal_point == '4'){ $sealpoint = 123; $x1 = 140; $x2 = 134; $x3 = 138; }
                  if($seal_point == '5'){ $sealpoint = 163;  $x1 = 180; $x2 = 174; $x3 = 178; }

                //ตราแสตมป์
                if($groupmems->group_seal == ''){
                    $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/Xiv4Nn.png',$sealpoint,10,40,23);
                }else{
                    //$pdf->Image($tokens->token_seal,$sealpoint,10,40,23);
                    $pdf->Image($groupmems->group_seal,$sealpoint,10,40,23);
                }
                
                $pdf->SetFont('THSarabunNew','',14);
                //ข้อความประทับตรา 
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x1, 18);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub_recnum));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x2, 23.5);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($sub_date)));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x3, 28.5);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_time_format($sub_time)));

                
                $pdf->SetFont('THSarabunNew','',16);

                if($seal_date_0 != ''){

                    $x = 150;
                    //หมายเหตุ   
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(70, $x);
                    $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_0),'0','L',false);

                    //ลายเซ็นหัวหน้าฝ่าย
                    $user_Check = User::where('id', $seal_id_0)
                    ->first();
                    $x = $x + 10;
                    if($user_Check->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,$x,20,20);
                        
                    }else{
                        $pdf->Image($user_Check->sign,85,$x,20,20);
                       
                    }
                                     
                    //ตำแหน่ง 25
                    $Y = 0;
                    $Y = strlen($seal_pos_0);
                    if($Y >= 14){$YY = 93;}
                    else if($Y == 13){$YY = 90;}
                    else if($Y == 12){$YY = 91;}
                    else if($Y == 10){$YY = 92;}                    
                    else if($Y == 9){$YY = 93;}                    
                    else if($Y == 8){$YY = 94;}                    
                    else if($Y == 7){$YY = 95;}
                    else{$YY = 95;}


                    $pdf->SetTextColor(0, 0, 0);
                    $x = $x + 25;  
                    $pdf->SetXY($YY,  $x);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_0));
                    //วันที่เซ็น 6
                    $pdf->SetTextColor(0, 0, 0);
                    $x = $x + 6;  
                    $pdf->SetXY(90, $x);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($seal_date_0)));
                }
                else if(Auth::user()->level == '5'){
                    //หมายเหตุ   
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(70, 180);
                    $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_0),'0','L',false);

                    //ลายเซ็นหัวหน้าฝ่าย
                    if(Auth::user()->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,200,20,20);
                    }else{
                        $pdf->Image(Auth::user()->sign,85,200,20,20);
                    }
                    
                    //ตำแหน่ง 25
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(85, 225);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_0));
                    //วันที่เซ็น 6
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(90, 231);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
                }
               
                if($seal_date_1 != ''){
                    $x = 220;
                    //หมายเหตุ   
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(70, $x);
                    $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_1),'0','L',false);

                    //ลายเซ็นหัวหน้ากอง
                    $user_Check = User::where('id', $seal_id_1)
                    ->first();
                    $x = $x + 10;
                    if($user_Check->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,140,20,20);
                    }else{
                        $pdf->Image($user_Check->sign,85,$x,20,20);
                    }
                    
                    $x = $x + 25;
                    //ตำแหน่ง 25
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(85, $x);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_1));
                    
                    //วันที่เซ็น 6
                    $x = $x + 6;
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(90, $x);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($seal_date_1)));
                }else if(Auth::user()->level == '4'){
                    //หมายเหตุ   
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(70, 120);
                    $pdf->MultiCell(105,10, iconv('UTF-8', 'cp874', $seal_detail_1),'0','L',false);

                    //ลายเซ็นหัวหน้ากอง
                    if(Auth::user()->sign == ''){
                        $pdf->Image('https://sv1.picz.in.th/images/2022/08/02/XR72zv.png',85,140,20,20);
                    }else{
                        $pdf->Image(Auth::user()->sign,85,140,20,20);
                    }

                    //ตำแหน่ง 25
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(85, 165);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', $seal_pos_1));
                    //วันที่เซ็น 6
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetXY(85, 171);
                    $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format(date('Y-m-d H:i:s'))));
                }
               
            }
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/work/';
        $name_gen_new = $sub_id."_".$date_new;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        // return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }

    //function เรียก cottons ด้วย id group
    public function getcottons($id)
    {
        $cottons_name = cottons::where('cottons_group',$id)->distinct()
            ->get();
        return $cottons_name;
    }

    //function ประทับตรา ของสารบรรณกอง
    public static function funtion_generate_PDF_II($doc_filedirec_1 ,$seal_point ,$sub_recnum ,$sub_date ,$sub_time ,$sub_id ,$sign_goup_0) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $groupmems = Groupmem::where('group_id', Auth::user()->group)
        ->where('group_site_id',Auth::user()->site_id)
        ->first();

        $pdf = new Fpdi();
        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($doc_filedirec_1);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
            //เอาแค่หน้าแรก
            if($pageNo == 1){
                //Font
                $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
                $pdf->SetFont('THSarabunNew','',16);
                
                if($groupmems->group_seal == ''){
                    //$pdf->Image('https://sv1.picz.in.th/images/2022/08/02/Xiv4Nn.png',$seal_point,10,40,23);
                    $tokens = token::where('tokens'.'token_site_id', Auth::user()->site_id)
                    ->first();

                     $pdf->Image($tokens->token_seal,$seal_point,10,40,23);
                }else{
                    $pdf->Image($groupmems->group_seal,$seal_point,10,40,23);
                }
                

                //กำหนดแกน x ให้กับข้อความ
                $xx1 = 0;
                $xx2 = 0;
                $xx3 = 0;
                if($seal_point > 85){
                   //ขวา เพิ่ม
                    for ($t = 85; $t < $seal_point; $t++) {
                        $xx1 += 1;
                        $xx2 += 1;
                        $xx3 += 1;
                    }
                    $x1 = 100 + $xx1;
                    $x2 = 93 + $xx2;
                    $x3 = 97 + $xx3;
                }else if($seal_point < 85){
                    //ซ้าย ลด
                    for ($t = 85; $t > $seal_point; $t--) {
                        $xx1 += 1;
                        $xx2 += 1;
                        $xx3 += 1;
                    }
                    $x1 = 100 - $xx1;
                    $x2 = 93 - $xx2;
                    $x3 = 97 - $xx3;
                }else if($seal_point == 85){
                    $x1 = 100;
                    $x2 = 93;
                    $x3 = 97;
                }
                    
                //ข้อความประทับตรา 
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x1, 18);
                $pdf->Write(0, iconv('UTF-8', 'cp874', $sub_recnum));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x2, 23.5);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($sub_date)));
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY($x3, 28.5);
                $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_time_format($sub_time)));

            }
        }
        if($sign_goup_0 == ''){
            $path_ = 'work';
        }else if($sign_goup_0 == 'cottons'){
            $path_ = 'department';
        }else if($sign_goup_0 == 'groupmems'){
            $path_ = 'division';
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/'.$path_.'/';
        $name_gen_new = $sub_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
        // return response($pdf->Output())->header('Content-Type', 'application/pdf');
   
    }

    //ฟังชันเรียกสถานะ sub3_status tb: sub3_docs ด้วย status
    public static function funtion_sub3_status($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้าฝ่าย</span>';
        }else if($status == '1'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้ากอง</span>';
        }else if($status == '2'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณานิติการ</span>';
        }else if($status == '3'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหน้าห้องปลัดและหน้าห้องนายก</span>';
        }else if($status == '4'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหน้าห้องปลัดและหน้าห้องนายก</span>';
        }else if($status == '5'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณารองปลัดและปลัด</span>';
        }else if($status == '6'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณารองปลัดและปลัด</span>';
        }else if($status == '7'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณารองนายกและนายก</span>';
        }else if($status == '8'){
            $txt_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณารองนายกและนายก</span>';
        }else if($status == '9'){
            $txt_status = '<span class="badge bg-success">ลงนามเรียบร้อย</span>';
        }else if($status == 'C'){
            $txt_status = '<span class="badge bg-success">ไม่ได้รับการอนุมัติจากนิติกร</span>';
        }else{
            $txt_status = "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }

    //ฟังชันเรียกสถานะ sub2_status tb: sub2_docs ด้วย status
    public static function funtion_sub2_status($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-danger">ยังไม่อ่าน</span>';
        }elseif($status == '1'){
            $txt_status = '<span class="badge bg-success">อ่านแล้ว</span>';
        }else{
            return "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }
     //ฟังชันเรียกประเภทเอกสาร
     public static function funtion_typedoc($id) {
        if($id == 'A'){
            $txt_status = 'หนังสือรับ';
        }elseif($id == 'B'){
            $txt_status = 'หนังสือส่ง';
        }elseif($id == 'C'){
            $txt_status = 'หนังสือเลขประกาศ';
        }elseif($id == 'D'){
            $txt_status = 'หนังสือเลขคำสั่ง';
        }elseif($id == 'E'){
            $txt_status = 'หนังสือรับรอง';
        }else{
            return "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }

    //ฟังชันเรียกสถานะ sub_status tb: sub_docs ด้วย status
    public static function funtion_sub_status($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-danger">ใหม่</span>';
        }elseif($status == '1'){
            $txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
        }elseif($status == '2'){
            $txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
        }elseif($status == '3'){
            $txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '4'){
            $txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '5'){
            $txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '6'){
            $txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '7'){
            $txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '8'){
            $txt_status = '<span class="badge bg-success">สำเร็จ</span>';
        }else{
            return "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }

    
    //ฟังชันเรียกstatus sub_doc ด้วย sub_id
    public static function funtion_sub_status_detail($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-danger">รอสารบรรกองลงรับ</span>';
        }elseif($status == '1'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
        }elseif($status == '2'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
        }elseif($status == '3'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '4'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '5'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '6'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '7'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-warning">กำลังดำเนินการ</span>';
        }elseif($status == '8'){
            $txt_status = '<span class="badge bg-success">ลงทะเบียนรับแล้ว</span> <span class="badge bg-success">ส่งถึงผู้รับแล้ว</span>';

        }else{
            return "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }
    
       //ฟังชันเรียกstatus sub_doc ด้วย sub_id
       public static function funtion_sub2_recid_name($status) {
            $sub2docsS = sub2_doc::leftJoin('users','users.id','sub2_docs.sub2_recid')
                ->where('sub2_subid', $status)
                ->get();

            foreach($sub2docsS as $sub2doc){
                if($sub2doc->sub2_status == 1){$text = '<span class="badge bg-success">อ่านแล้ว</span>';}
                else{$text = '<span class="badge bg-danger">ยังไม่อ่าน</span>';}
                $txt_status[] = $sub2doc->name.' '.$text;
                
            }
            $sub_recid_name = implode("<br>", $txt_status);
            return $sub_recid_name;

       
    }
    

    //function ประทับตรา เซ็น และแทรกหน้าแรก PDF  ของหัวหน้าสำนักปลัด
    public static function funtion_generate_PDF_I(array $sub_recid ,$seal_point ,$doc_recnum ,$doc_date ,$doc_time ,$pos ,$doc_filedirec ,$doc_id ,$seal_deteil ,$doc_docnum ,$doc_title) {
        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $tokens = token::where('token_site_id', Auth::user()->site_id)
        ->where('token_level','3')
        ->first();

        //หาชื่อกองงาน
        for ($t = 0; $t < count($sub_recid); $t++) {
            $sub_recid_ar[] = functionController::funtion_groupmem_name($sub_recid[$t]);
        }
        $sub_recid_name = implode(" ,", $sub_recid_ar);

        $pdf = new Fpdi();
        $pdf->AddPage();
        
        //Font
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->SetFont('THSarabunNew','',16);

        //ประทับตา
        if($seal_point != '0'){
            //กำหนดแกน x ให้กับข้อความ
            $xx1 = 0;
            $xx2 = 0;
            $xx3 = 0;

            if($seal_point == '1'){ $sealpoint = 5; $x1 = 20; $x2 = 13; $x3 = 17; }
            if($seal_point == '2'){ $sealpoint = 45; $x1 = 60; $x2 = 53; $x3 = 57; }
            if($seal_point == '3'){ $sealpoint = 85; $x1 = 100; $x2 = 93; $x3 = 97; }
            if($seal_point == '4'){ $sealpoint = 125; $x1 = 140; $x2 = 134; $x3 = 138; }
            if($seal_point == '5'){ $sealpoint = 165;  $x1 = 180; $x2 = 174; $x3 = 178; }
            $pdf->Image($tokens->token_seal,$sealpoint,10,40,23);

            //dd($tokens);

            $pdf->SetFont('THSarabunNew','',14);
            //ข้อความประทับตรา 
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($x1, 18);
            $pdf->Write(0, iconv('UTF-8', 'cp874', $doc_recnum));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($x2, 23);
            $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($doc_date)));
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($x3, 28);
            $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_time_format($doc_time)));

        }
        $pdf->SetFont('THSarabunNew','',16);
        //เลขที่หนังสือ
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(30, 42);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เลขที่หนังสือ '));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(53, 42);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $doc_docnum));
        //เรื่อง
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetXY(30, 50);
        $pdf->Write(0, iconv('UTF-8', 'cp874', 'เรื่อง '));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(43, 50);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $doc_title));

       
        //พิจารณาเลือกกองที่เกี่ยวข้อง       
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(70, 60);
        $n = 6;
        $pdf->MultiCell(110,$n, iconv('UTF-8', 'cp874', $sub_recid_name." \n ".$seal_deteil),'0','L',false);

         $y = 85 + $n + 5;

        //ลายเซ็น
        if(Auth::user()->sign == ''){
            $sign = 'https://sv1.picz.in.th/images/2022/08/02/XR72zv.png';
        }else{
            $sign = Auth::user()->sign;
        }

        $pdf->Image($sign,100,$y,20,20);

        //ตำแหน่ง 25
         $y = $y + 25;
        $pdf->SetTextColor(0, 0, 0);       
        $pdf->SetXY(85, $y);
        $pdf->Write(0, iconv('UTF-8', 'cp874', $pos));

        //วันที่เซ็น 6
        $y = $y + 6;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(90, $y);
        $pdf->Write(0, iconv('UTF-8', 'cp874', functionController::funtion_date_format($doc_date)));

        //นับจำนวนหน้า
        $sourceFilePages = $pdf->setSourceFile($doc_filedirec);
        for($pageNo = 1; $pageNo <= $sourceFilePages; $pageNo++){
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, null, null, null);
        }
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $random = Str::random(5);
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/center/';
        $name_gen_new = $doc_id."_".$date_new."_".$random;
        $full_path = $upload_location.$name_gen_new.'.pdf';
        $pdf->Output('F', $full_path);
        return $full_path;
       //  return response($pdf->Output())->header('Content-Type', 'application/pdf');
    }

    //format วันที่ เดือน ปี ในเอกสาร
    public static function funtion_date_format($date) {
        $y = substr($date, 0, 4);
        $m = substr($date, 5, 2);
        $d = substr($date, 8, 2);
        $yy = $y + 543;
        if ($m == "01") { $m = "มกราคม"; }else
        if ($m == "02") { $m = "กุมภาพันธ์"; }else
        if ($m == "03") { $m = "มีนาคม"; }else
        if ($m == "04") { $m = "เมษายน"; }else
        if ($m == "05") { $m = "พฤษภาคม"; }else
        if ($m == "06") { $m = "มิถุนายน"; }else
        if ($m == "07") { $m = "กรกฎาคม"; }else
        if ($m == "08") { $m = "สิงหาคม"; }else
        if ($m == "09") { $m = "กันยายน"; }else
        if ($m == "10") { $m = "ตุลาคม"; }else
        if ($m == "11") { $m = "พฤศจิกายน"; }else
        if ($m == "12") { $m = "ธันวาคม"; }
        if ($d == "01") { $d = "1"; }else
        if ($d == "02") { $d = "2"; }else
        if ($d == "03") { $d = "3"; }else
        if ($d == "04") { $d = "4"; }else
        if ($d == "05") { $d = "5"; }else
        if ($d == "06") { $d = "6"; }else
        if ($d == "07") { $d = "7"; }else
        if ($d == "08") { $d = "8"; }else
        if ($d == "09") { $d = "9"; }
        return $d ." ".  $m ." ".  $yy;
        //22 กรกฎาคม 2565
    }

    //format เวลา ในเอกสาร
    public static function funtion_time_format($time) {
        $t = substr($time, 0, 5);
        return $t;
    }

    //ฟังชันเรียกสถานะ doc_status
    public static function funtion_doc_status($status) {
        if($status == 'waiting'){
            $txt_status = '<span class="badge bg-warning">รอพิจารณา</span>';
        }elseif($status == 'success'){
            $txt_status = '<span class="badge bg-success">พิจารณาแล้ว</span>';
        }else{
            $txt_status = "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }


    //ฟังชันเรียกชื่อสิทธิ์ด้วย id
    public static function funtion_reserve_status($status) {
        if($status == '0'){
            $txt_status = '<span class="badge bg-warning">จอง</span>';
        }elseif($status == '1'){
            $txt_status = '<span class="badge bg-danger">ใช้งานแล้ว</span>';
        }elseif($status == '2'){
            $txt_status = '<span class="badge bg-success">ว่าง</span>';
        }else{
            $txt_status = "ไม่ถูกนิยาม";
        }
        return $txt_status;
    }

    //ฟังชันเรียก เลขหนังสือรับรองภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_delivery_inside_plus($id) {
        $document_count = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
        ->where('doc_site_id',$id)
        ->where('doc_group',Auth::user()->group)
        ->where('doc_type','1')
        ->where('doc_template','B')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_group',Auth::user()->group)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'B')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

      //ฟังชันเรียก เลขหนังสือรับรองภายนอกล่าสุด +1 tb : documents ด้วย id_site
      public static function funtion_documents_doc_recnum_delivery_inside_plus_1($id,$group) {
        $document_count = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
        ->where('doc_site_id',$id)
        ->where('doc_group',$group)
        ->where('doc_type','1')
        ->where('doc_template','B')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_group',$group)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'B')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }


    //ฟังชันเรียก เลขหนังสือรับรองภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_certificate_plus($id) {
        $document_count = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
        ->where('doc_site_id',$id)
        ->where('doc_type','1')
        ->where('doc_template','E')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'E')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

    //ฟังชันเรียก เลขคำสั่งภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_order_plus($id) {
        $document_count = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
        ->where('doc_site_id',$id)
        ->where('doc_type','1')
        ->where('doc_template','D')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'D')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

    //ฟังชันเรียก เลขประกาศภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_announce_plus($id) {
        $document_count = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
        ->where('doc_site_id',$id)
        ->where('doc_type','1')
        ->where('doc_template','C')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '1')
            ->where('reserve_template', 'C')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

    //ฟังชันเรียก เลขส่งภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_delivery_plus($id) {
        $document_count = document::where('doc_site_id',$id)
        ->where('doc_type','0')
        ->where('doc_template','B')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->whereNull('reserve_group')
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '0')
            ->where('reserve_template', 'B')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

    //ฟังชันเรียก เลขรับภายนอกล่าสุด +1 tb : documents ด้วย id_site
    public static function funtion_documents_doc_recnum_plus($id) {
        $document_count = document::where('doc_site_id',$id)
        ->where('doc_type','0')
        ->where('doc_template','A')
        ->max('doc_recnum');
        $document_count_plus = $document_count + 1;

        for ($i = $document_count_plus; $i < 20000; $i++) {
            $reserve_number_count = reserve_number::where('reserve_site',$id)
            ->whereNull('reserve_group')
            ->where('reserve_status','!=','1')
            ->where('reserve_type', '0')
            ->where('reserve_template', 'A')
            ->where('reserve_number',$i)
            ->count();
            if($reserve_number_count == '0'){
                $document_count_plus = $i;
                break;
            }
        }
        return $document_count_plus;
    }

    //ฟังชันเรียก ชื่อ-นามสกุล tb : User ด้วย id
    public static function funtion_users($id) {
        $users_Check = User::where('id', $id)->first();
        if($users_Check){
            return $users_Check->name;
        }else{
            return "ไม่ถูกนิยาม";
        }
    }


    //ฟังชัน line notify
    public static function line_notify($message, $token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    //ฟังชันเรียก sites ด้วย id
    public function addSign(Request $request){
        $sign_image = $request->file('sign');
        
        $name_gen=hexdec(uniqid());

        $sign_img_ext = strtolower($sign_image->getClientOriginalExtension());
        $sign_img_name = $name_gen.'.'.$sign_img_ext;
            
        $upload_location = 'image/user/';
        $full_path = $upload_location.$sign_img_name;

        if($request->old_sign != ''){
            $old_sign = $request->old_sign;
            unlink($old_sign);
        }
        $sign_image->move($upload_location,$sign_img_name);
        //query
        $update = User::where('id', $request->id)->update([
            'sign'=>$full_path,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        return redirect()->back();
    }

    //ฟังชันเรียก replaces ด้วย user_id
    public static function funtion_replaces($id) {
        $replace = replace::where('replace_user_id_acting', $id)
        ->where('replace_user_id', Auth::user()->id)
        ->first();
        if($replace){
            return "1";
        }else{
            return "0";
        }
    }

    //ฟังชันเรียกชื่อ cottons แสดง ด้วย id
    public static function funtion_cottons($id) {
        $cottons = cottons::where('cottons_id', $id)->first();
        if($cottons){
            return $cottons->cottons_name;
        }else{
            return "ไม่ถูกนิยาม";
        }
    }

    //ฟังชันเรียก sites ด้วย id
    public static function funtion_sites_site_path_folder($id) {
        $site_path_folder = sites::where('sites.site_id', $id)->first();
        if($site_path_folder){
            return $site_path_folder->site_path_folder;
        }else{
            return 0;
        }
    }

    //ฟังชันเรียก sites ด้วย id
    public static function funtion_sites($id) {
        $sitesS_Check = sites::where('sites.site_id', $id)->first();
        if($sitesS_Check){
            return $sitesS_Check->site_name;
        }else{
            return "ไม่ถูกนิยาม";
        }
    }

    //ฟังชันเรียกชื่อกองงานด้วย id
    public static function funtion_groupmem_name($group_id) {
        $GroupmemS_Check = Groupmem::where('groupmems.group_id', $group_id)->first();
        if($GroupmemS_Check){
            return $GroupmemS_Check->group_name;
        }else{
            return "ไม่ถูกนิยาม";
        }
    }
    
    

    //ฟังชันเรียกชื่อสิทธิ์ด้วย id
    public static function funtion_user_level($level) {
        if($level == '1'){
            $txt_user_level = 'นายก|รองนายก';
        }elseif($level == '2'){
            $txt_user_level = 'ปลัด|รองปลัด';
        }elseif($level == '3'){
            $txt_user_level = 'สารบรรณกลาง';
        }elseif($level == '4'){
            $txt_user_level = 'หัวหน้ากอง';
        }elseif($level == '5'){
            $txt_user_level = 'หัวหน้าฝ่าย';
        }elseif($level == '6'){
            $txt_user_level = 'สารบรรณกอง';
        }elseif($level == '7'){
            $txt_user_level = 'งาน';
        }elseif($level == '8'){
            $txt_user_level = 'หน้าห้องปลัด|หน้าห้องนายก';
        }else{
            return "ไม่ถูกนิยาม";
        }
        return $txt_user_level;
    }

    //ฟังชันเรียกชื่อสิทธิ์ด้วย id
    public static function funtion_doc_speed($speed) {
        if($speed == '0'){
            $txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
        }elseif($speed == '1'){
            $txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
        }elseif($speed == '2'){
            $txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
        }elseif($speed == '3'){
            $txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
        }
        return $txt_doc_speed;
    }
      //ฟังชันเรียกชื่อกองงานด้วย id
      public static function display_pdf_sub3_doc($sub_id) {
        $sub2_doc_Check = sub2_doc::where('sub2_docs.sub2_subid', $sub_id)
        ->where('sub2_docs.sub2_recid', Auth::user()->id)
        ->first();
        if($sub2_doc_Check){
            $sub3_doc_Check = sub3_doc::where('sub3_docs.sub3_sub_2id', $sub2_doc_Check->sub2_id)
            ->first();

            if($sub3_doc_Check){
                $sub3_detail_Check = sub3_detail::where('sub3_details.sub3d_sub_3id', $sub3_doc_Check->sub3_id)
                ->first();
                if($sub3_detail_Check->sub3d_file != ''){
                    return $sub3_detail_Check->sub3d_file;
                }
            }
        }
    }
    public static function display_pdf($pathToFile)
    {       
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $Desktop = stripos($_SERVER["HTTP_USER_AGENT"],"Windows");
        
        $css = '
			<style>
			div.PC{
			    display : block;
			}
			div.Phone{
                display : none;
			}
			#the-canvas{
                width: 100%;
                height : 1000px;
			}
            div.textsentto{ 
                border: 3px dashed #f08080;
            }
            label.textsentto{
                float:right;
            }
			</style>';
            
        if($iPod != NULL || $iPhone != NULL || $iPad != NULL){
	        $css = "
            <style>
                div.container-fluid{
                padding-right: 1px;
                padding-left: 1px;
            }
            div.container{
                padding-right: 0px;
                padding-left: 0px;
            }
            div.PC{
                display : none;
            }
            div.Phone{
                display : block;
            }
            #the-canvas{
                width: 100%;
                height : 500px;
            }
	        </style>";
        }
        if($Android != NULL){
            $css = '
            <style>
            @media screen and (max-width: 1920px) and (min-width: 1024px) {
                div.PC{
                    display : block;
                }
                div.Phone{
                    display : none;
                }
            #the-canvas{
                        width: 100%;
                        height : 1000px;
                    }
                div.textsentto{ 
                    border: 3px dashed #f08080;
                }
                label.textsentto{
                    float:right;
                }
                
            } 
            /* ipad  */
            @media screen and (max-width: 1024px) and (min-width: 768px) {
                div.container-fluid{
                     padding-right: 1px;
                     padding-left: 1px;
                 }
                 div.container{
                     padding-right: 0px;
                     padding-left: 0px;
                 }
                div.PC{
                    display : none;
                }
                div.Phone{
                    display : block;
                }
            #the-canvas{
                        width: 100%;
                        height : 900px;
                    }
            }
            @media screen and (max-width: 767px) and (min-width: 320px) {
                div.container-fluid{
                     padding-right: 1px;
                     padding-left: 1px;
                 }
                 div.container{
                     padding-right: 0px;
                     padding-left: 0px;
                 }
                div.PC{
                    display : none;
                }
                div.Phone{
                    display : block;
                }
            #the-canvas{
                        width: 100%;
                        height : 450px;
                    }
            }
            </style>';
        }
        if($webOS != NULL){
            $css = '
            <style>
            @media screen and (max-width: 1920px) and (min-width: 1024px) {
                div.PC{
                    display : block;
                }
                div.Phone{
                    display : none;
                }
            #the-canvas{
                        width: 100%;
                        height : 1000px;
                    }
                div.textsentto{ 
                    border: 3px dashed #f08080;
                }
                label.textsentto{
                    float:right;
                }
                
            } 
            /* ipad  */
            @media screen and (max-width: 1024px) and (min-width: 768px) {
                div.container-fluid{
                     padding-right: 1px;
                     padding-left: 1px;
                 }
                 div.container{
                     padding-right: 0px;
                     padding-left: 0px;
                 }
                div.PC{
                    display : none;
                }
                div.Phone{
                    display : block;
                }
            #the-canvas{
                        width: 100%;
                        height : 900px;
                    }
            }
            @media screen and (max-width: 767px) and (min-width: 320px) {
                div.container-fluid{
                     padding-right: 1px;
                     padding-left: 1px;
                 }
                 div.container{
                     padding-right: 0px;
                     padding-left: 0px;
                 }
                div.PC{
                    display : none;
                }
                div.Phone{
                    display : block;
                }
            #the-canvas{
                        width: 100%;
                        height : 450px;
                    }
            }
            </style>';
        }
        if($Desktop != NULL){
            $css = '
			<style>
			div.PC{
			    display : block;
			}
			div.Phone{
                display : none;
			}
			#the-canvas{
                width: 100%;
                height : 1000px;
			}
            div.textsentto{ 
                border: 3px dashed #f08080;
            }
            label.textsentto{
                float:right;
            }
			</style>';
        }
		
        $js = '
        <script src="'.asset('js/pdf.js').'"></script>
        <script id="script">
        var url = "'.asset($pathToFile).'";
        pdfjsLib.GlobalWorkerOptions.workerSrc = "'.asset('js/pdf.worker.js').'";
        var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 2,
        canvas = document.getElementById("the-canvas"),
        ctx = canvas.getContext("2d");

        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale,
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
    
                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                };
                var renderTask = page.render(renderContext);
    
                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });
    
            // Update page counters
            document.getElementById("page_num").textContent = num;
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById("prev").addEventListener("click", onPrevPage);

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById("next").addEventListener("click", onNextPage);

        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById("page_count").textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
        </script>
        ';
        $div = 
        $css.'
        <div class="PC">
            <div class="col-lg-12" height="800px" style="height:800px;padding-left: 0px;padding-right: -;padding-right: 0px;">
                <embed src="'.asset($pathToFile).'" mce_src="" width="100%" height="100%">
                </embed>
            </div>
        </div>
        <div class="Phone">
        <div class="col-lg-12" style="padding-right: 0px;padding-left: 0px;">
            <canvas id="the-canvas" style="border: 1px solid black; direction: ltr;padding-left: 0px;padding-right: -;padding-right: 0px;" width="100%"></canvas>
            <div align="right">
                <b><a id="prev"><< ก่อนหน้า |</a><a id="next"> ถัดไป>></a></b>&nbsp; &nbsp;<a>Page: <span id="page_num"></span> /<span id="page_count"></span></a></div>                                   
            </div>
        </div>
        '.$js;
        return $div;
    }
}