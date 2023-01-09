<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\functionController;
use App\Models\auto_reserve_numbers;
use App\Models\Groupmem;
use App\Models\token;
use App\Models\User;
use App\Models\reserve_number;
use App\Models\document;

class reserve_numbersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reserve_numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test_notify';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //alert
        // $alert_to_admin = "1911";
        // functionController::line_notify($alert_to_admin,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF');
        

        $get_auto_reserve_number = auto_reserve_numbers::get();
        foreach($get_auto_reserve_number as $row){
            $txt_arn_template = functionController::get_arn_template($row->arn_template);
            if($row->arn_level == '3'){
                $first_User = User::where('users.id', $row->arn_user_id)
                ->first();
                $first_tokens = token::where('tokens.token_site_id', $row->arn_site_id)
                ->where('tokens.token_level', $row->arn_level)
                ->first();
                 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if($row->arn_template == 'receive'){
                    //เลขรับภายนอก
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_plus = functionController::funtion_documents_doc_recnum_plus($row->arn_site_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_number'=>$documents_doc_recnum_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'0',
                            'reserve_template' =>'A',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else if($row->arn_template == 'delivery'){
                    // เลขส่งภายนอก
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_delivery_plus = functionController::funtion_documents_doc_recnum_delivery_plus($row->arn_site_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_number'=>$documents_doc_recnum_delivery_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'0',
                            'reserve_template' =>'B',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else{
                    $error_to_admin_0 = "ERROR reserve_numbersCommand arn_template id : ".$get_auto_reserve_number->arn_id;
                    functionController::line_notify($error_to_admin_0,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF');
                }
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
               
                if($first_tokens && $first_User){
                    $token = $first_tokens->token_token;
                    $message = "\n⚠️ ระบบจองเลขอัตโนมัติ ⚠️\n> สิทธิ์ : สารบรรกลาง \n> ผู้จอง : ".$first_User->name." \n> ประเภทเลข : ".$txt_arn_template." \n> จำนวนเลขที่จองต่อวัน : ".$row->arn_quantity." \n> เวลา : ".date('Y-m-d H:i')." \n> หมายเหตุ : ระบบจะจองเลขอัตโนมัติเวลา 00.01 ของทุกวันเมื่อมีการเปิดใช้งาน";
                }else{
                    $error_to_admin = "ERROR reserve_numbersCommand first_tokens id : ".$get_auto_reserve_number->arn_id;
                    functionController::line_notify($error_to_admin,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF');
                }
            }else if($row->arn_level == '6'){
                $first_groupmems = User::join('groupmems', 'groupmems.group_id', '=', 'users.group')
                ->where('users.id', $row->arn_user_id)
                ->first();
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if($row->arn_template == 'receive_inside'){
                    // เลขรับภายใน
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_inside_plus = functionController::funtion_documents_doc_recnum_inside_plus_1($row->arn_site_id,$first_groupmems->group_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_group'=>$first_groupmems->group_id,
                            'reserve_number'=>$documents_doc_recnum_inside_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'1',
                            'reserve_template' =>'A',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else if($row->arn_template == 'delivery_inside'){
                    // เลขส่งภายใน
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_delivery_inside_plus = functionController::funtion_documents_doc_recnum_delivery_inside_plus_1($row->arn_site_id,$first_groupmems->group_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_group'=>$first_groupmems->group_id,
                            'reserve_number'=>$documents_doc_recnum_delivery_inside_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'1',
                            'reserve_template' =>'B',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else if($row->arn_template == 'announce'){
                    //เลขประกาศภายใน
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_announce_plus = functionController::funtion_documents_doc_recnum_announce_plus($row->arn_site_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_group'=>$first_groupmems->group_id,
                            'reserve_number'=>$documents_doc_recnum_announce_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'1',
                            'reserve_template' =>'C',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else if($row->arn_template == 'order'){
                    // เลขคำสั่งภายใน
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_order_plus = functionController::funtion_documents_doc_recnum_order_plus($row->arn_site_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_group'=>$first_groupmems->group_id,
                            'reserve_number'=>$documents_doc_recnum_order_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'1',
                            'reserve_template' =>'D',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else if($row->arn_template == 'certificate'){
                    // เลขรับรองภายใน
                    for ($i = 1; $i <= $row->arn_quantity; $i++) {
                        $documents_doc_recnum_certificate_plus = functionController::funtion_documents_doc_recnum_certificate_plus($row->arn_site_id);
                        $insert_reserve_number_receive = reserve_number::insert([
                            'reserve_group'=>$first_groupmems->group_id,
                            'reserve_number'=>$documents_doc_recnum_certificate_plus,
                            'reserve_date'=>date('Y-m-d H:i:s'),
                            'reserve_status'=>'0',
                            'reserve_type'=>'1',
                            'reserve_template' =>'E',
                            'reserve_owner'=>$row->arn_user_id,
                            'reserve_site'=>$row->arn_site_id,
                            'reserve_created_at'=>date('Y-m-d H:i:s')
                        ]);
                    }
                }else{
                    $error_to_admin_1 = "ERROR reserve_numbersCommand arn_template id : ".$get_auto_reserve_number->arn_id;
                    functionController::line_notify($error_to_admin_1,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF'); 
                }
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if($first_groupmems){
                    $token = $first_groupmems->group_token;
                    $message = "\n⚠️ ระบบจองเลขอัตโนมัติ ⚠️\n> สิทธิ์ : สารบรรกอง \n> ผู้จอง : ".$first_groupmems->name." \n> ประเภทเลข : ".$txt_arn_template." \n> จำนวนเลขที่จองต่อวัน : ".$row->arn_quantity." \n> เวลา : ".date('Y-m-d H:i')." \n> หมายเหตุ : ระบบจะจองเลขอัตโนมัติเวลา 00.01 ของทุกวันเมื่อมีการเปิดใช้งาน";
                }else{
                    $error_to_admin = "ERROR reserve_numbersCommand first_groupmems id : ".$get_auto_reserve_number->arn_id;
                    functionController::line_notify($error_to_admin,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF');
                }
            }
            functionController::line_notify($message,$token);
        }
        $this->info('successfully');
        return 0;
    }
}
