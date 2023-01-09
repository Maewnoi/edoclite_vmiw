//ฟังชั่นนี้จะมีการป้องกันไม่ให้กด submit มากกว่า 1 ครั้ง ต้องใช้รวมกันกับ form เท่านั้น
function submitForm(btn) {
     btn.disabled = true;
     btn.className = ('loadingbydomji555+');
     btn.innerHTML = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
     btn.form.submit();
}

function logout(btn) {

    swal ({
        title: "คุณต้องการออกจากระบบใช่ไหม?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            // btn.preventDefault();
            btn.closest('form').submit();
            // swal("ออกจากระบบเรียบร้อย!", {
            //     icon: "success",
            // });
        } else {
             swal("คุณอาจจะหลงคลิก!");
        }
    });
}
// alert(var_memberController_add_level);
//------------------------------------------------------------------------------------------
// replaceController
$('#replaceController-checkbox').each(function () {
    var _token = $('#replaceController_token').val(); //_token
    $(".name-replaceController-checkbox").click(function(event) {
        if ($(this).is(':checked')) {
            var id = $(this).data('id');
            var act = 'true';

        } else {
            var id = $(this).data('id');
            var act = 'false';
        }
        $.ajax({
            type: "POST",
            url: "/replace/update",
            headers: {
                'X-CSRF-Token': _token 
            },
            data: {
                id: id,
                act: act
            },
            success: function(data) {
                if(data == 1){
                    swal({
                        title: "ทำรายการเรียบร้อย",
                        icon: "success",
                    });
                }else if(data == 0){
                    swal({
                        title: 'แจ้งเตือน : ERROR ![act]',
                        icon: "error",
                    });
                }else if(data == 3){
                    swal({
                        title: 'แจ้งเตือน : ERROR ![replace]',
                        icon: "error",
                    });
                }
            },
            error: function(request, status, error) {
                swal({
                    title: 'แจ้งเตือน : ERROR ![' + request.responseText +']',
                    icon: "error",
                });
            }
        });
        // console.log(var_data);
    });
});
//------------------------------------------------------------------------------------------
//navigation_search_documents form
$('#navigation_search_table').each(function () {
    document.getElementById('processing_navigation_search_documents').style.display = 'none';
    function function_fetch(){
        // event.preventDefault();
        var _token = $('#navigation_input_search_documents_csrf_token').val(); //_token
        var _level = $('#navigation_input_search_documents_level').val(); //_level

        var origin = $('#navigation_input_search_documents_origin').val(); //หน่วยงานต้นเรื่อง
        var docnum = $('#navigation_input_search_documents_docnum').val(); //เลขที่หนังสือ
        var title = $('#navigation_input_search_documents_title').val(); //เรื่อง
        var template = $('#navigation_input_search_documents_template').val(); //เอกสารนอก/ภายใน
        var recnum = $('#navigation_input_search_documents_recnum').val(); //เลขที่รับส่วนงาน
        var date = $('#navigation_input_search_documents_date').val(); //วันที่
        var date_2 = $('#navigation_input_search_documents_date_2').val(); //วันที่ลง
        var secret = $('#navigation_input_search_documents_secret').val(); //ชั้นความลับ
        var speed = $('#navigation_input_search_documents_speed').val(); //ชั้นความเร็ว
        var var_data = {
            origin: origin,
            docnum: docnum,
            title: title,
            template: template,
            recnum: recnum,
            date: date,
            date_2: date_2,
            secret: secret,
            speed: speed
        };
        // table.rows.add( var_data ).draw().
        // var_data.splice(0);
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#navigation_search_table').DataTable({
            oLanguage: {
                sEmptyTable: "ไม่พบข้อมูลที่คุณต้องการ อิอิ"
            },
            processing: true,
            paging: false,
            searching: false,
            language: {
                processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
            },    
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }
            ],
            order: [
                [0, "DESC"]
            ],
            ajax: {
                url: '/navigation/search',
                type: 'POST',
                dataType:"json",
                headers: {
                    'X-CSRF-Token': _token 
                },
                data: var_data,
                dataSrc: ""
            },
            columns: [
                { 
                    data: 'doc_id' 
                },
                
                {
                    data: {doc_id:'doc_id',doc_type:'doc_type'} ,
                    render: function ( data) {
                        if(_level == '1'){
                            //นายกรองนายก
                            return (` <a href="/documents_admission_minister_sign/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                        }else if(_level == '2'){
                            //ปลัดรองปลัด
                            return (` <a href="/documents_admission_deputy_sign/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                        }else if(_level == '3'){
                            //สรรบรรณกลาง
                            return (` <a href="/documents_admission_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                        }else if(_level == '4'){
                            //หัวหน้ากอง
                            if(data.doc_type == '0'){
                                return (` <a href="/documents_admission_division_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }else if(data.doc_type == '1'){
                                return (` <a href="/documents_admission_division_inside_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }
                        }else if(_level == '5'){
                            //หัวหน้าฝ่าย
                            if(data.doc_type == '0'){
                                return (` <a href="/documents_admission_department_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }else if(data.doc_type == '1'){
                                return (` <a href="/documents_admission_department_inside_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }
                        }else if(_level == '6'){
                            //สรรบรรณกอง
                            if(data.doc_type == '0'){
                                return (` <a href="/documents_admission_group/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }else if(data.doc_type == '1'){
                                return (` <a href="/documents_admission_group_inside/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }
                        }else if(_level == '7'){
                            //งาน
                            if(data.doc_type == '0'){
                                return (` <a href="/documents_admission_work_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }else if(data.doc_type == '1'){
                                return (` <a href="/documents_admission_work_inside_all/detail/`+ data.doc_id +`"><i class="far fa-file-alt"></i></a>`)
                            }
                        }
                        
                    }
                },
                { 
                    data: 'doc_origin' 
                },
                { 
                    data: 'doc_docnum' 
                },
                { 
                    data: 'doc_template' ,
                    render: function ( data) {
                        if(data == 'A'){
                            txt_doc_template = 'เอกสารภายนอก';
                        }else if(data == 'B' || data == 'C' || data == 'D' || data == 'E'){
                            txt_doc_template = 'เอกสารภายใน';
                        }
                        return (txt_doc_template)
                    }
                },
                { 
                    data: 'doc_recnum' 
                },
                { 
                    data: 'doc_date' ,
                    render: function ( data) {
                        var year = data.toString().substring(0, 4);
                        var month = data.toString().substring(5, 7);
                        var day = data.toString().substring(8, 10);
                        var date = [day, month, year].join('-');
                        return (``+ date +``)
                    }
                },
                { 
                    data: 'doc_secret' ,
                    render: function ( data) {
                        if(data == '0'){
                            txt_doc_secret = 'ปกติ';
                        }else if(data == '1'){
                            txt_doc_secret = 'ลับ';
                        }else if(data == '2'){
                            txt_doc_secret = 'ลับมาก';
                        }else if(data == '3'){
                            txt_doc_secret = 'ลับที่สุด!';
                        }
                        return (txt_doc_secret)
                    }
                },
                { 
                    data: 'doc_speed' ,
                    render: function ( data) {
                        if(data == '0'){
                            txt_doc_speed = 'ปกติ';
                        }else if(data == '1'){
                            txt_doc_speed = 'ด่วน';
                        }else if(data == '2'){
                            txt_doc_speed = 'ด่วนมาก';
                        }else if(data == '3'){
                            txt_doc_speed = 'ด่วนที่สุด!';
                        }
                        return (txt_doc_speed)
                    }
                },
                
            ]
        }).on( 'processing.dt', function ( e, settings, processing ) {
            $('#processing_navigation_search_documents').css( 'display', processing ? 'block' : 'none' );
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
     
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
        // table.ajax.reload(null, false);
        $.fn.dataTable.ext.errMode = function(obj,param,err){
            console.log('Handling DataTable issue of Table '+err);
        };
        // table.ajax.reload();
 
        table.destroy();
        // console.log(var_data);


        // fetch('/navigation/search', {
        //     method: 'POST',
        //     headers: {
        //     'Accept': 'application/json',
        //     'Content-Type': 'application/json',
        //     'X-CSRF-TOKEN': _token
        // },
        //     body:  JSON.stringify(var_data)
        // })
        // .then(response => response.json())
        // .then(result => {
        //     console.log(result);
        // });

    }
    
    $('#navigation_input_search_documents_origin').on('keyup',function(event) {
        //หน่วยงานต้นเรื่อง
        function_fetch();
    });
    $('#navigation_input_search_documents_docnum').on('keyup',function(event) {
        //เลขที่หนังสือ
        function_fetch();
    });
    $('#navigation_input_search_documents_title').on('keyup',function(event) {
        //เรื่อง
        function_fetch();
    });
    $('#navigation_input_search_documents_template').on('change',function(event) {
        //เอกสารนอก/ภายใน
        function_fetch();
    });
    $('#navigation_input_search_documents_recnum').on('keyup',function(event) {
        //เลขที่รับส่วนงาน
        function_fetch();
    });
    $('#navigation_input_search_documents_date').on('change',function(event) {
        //วันที่
        function_fetch();
    });
    $('#navigation_input_search_documents_date_2').on('change',function(event) {
        //วันที่ลง
        function_fetch();
    });
    $('#navigation_input_search_documents_secret').on('change',function(event) {
        //ชั้นความลับ
        function_fetch();
    });
    $('#navigation_input_search_documents_speed').on('change',function(event) {
        function_fetch();
    });
});


//------------------------------------------------------------------------------------------
//admin.member.index
$(".check_jurisprudence").click(function(event) { //มีการ loop เลยใช้ classname.
    // event.preventDefault();
    var var_id = $(this).data('id');
    var var_token = $(this).data('token');

    if ($(this).is(':checked')) {
        var var_data = {
            var_id: var_id,
            var_status: '1'
        };
    }else{
        var var_data = {
            var_id: var_id,
            var_status: '0'
        };
    }

    fetch('/jurisprudence/update', {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': var_token
    },
    body:  JSON.stringify(var_data)
    })
    .then(response => response.json())
    .then(result => {
        // console.log(result);
        if(result['status'] == '200'){
            swal({
                title: "แจ้งเดือน",
                text: result['text'],
                icon: "success",
            });
        }else if(result['status'] == '404'){
            swal({
                title: "แจ้งเดือน",
                text: result['text'],
                icon: "error",
            });
        }
    });
});

$(".check_user_center").click(function(event) { //มีการ loop เลยใช้ classname.
    // event.preventDefault();
    var var_id = $(this).data('id');
    var var_token = $(this).data('token');

    if ($(this).is(':checked')) {
        var var_data = {
            var_id: var_id,
            var_status: '1'
        };
    }else{
        var var_data = {
            var_id: var_id,
            var_status: '0'
        };
    }

    fetch('/user_center/update', {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': var_token
    },
    body:  JSON.stringify(var_data)
    })
    .then(response => response.json())
    .then(result => {
        // console.log(result);
        if(result['status'] == '200'){
            swal({
                title: "แจ้งเดือน",
                text: result['text'],
                icon: "success",
            });
        }else if(result['status'] == '404'){
            swal({
                title: "แจ้งเดือน",
                text: result['text'],
                icon: "error",
            });
        }
    });
});

$("#memberController_add_level").change(function(event) {
    var var_memberController_add_level = $("#memberController_add_level").val();
    if(var_memberController_add_level=='0'||var_memberController_add_level=='1'||var_memberController_add_level=='2'||var_memberController_add_level=='3'
    ||var_memberController_add_level=='8'){
        document.getElementById('memberController_add_form-group_group').style.display = 'none';
        document.getElementById("memberController_add_group").required = false;

        document.getElementById('memberController_add_form-group_sites').style.display = 'block';
        document.getElementById("memberController_add_sites").required = true;

        document.getElementById('memberController_add_form-group_cotton').style.display = 'none';
    }else if(var_memberController_add_level=='5'||var_memberController_add_level=='7'){
        document.getElementById('memberController_add_form-group_group').style.display = 'block';
        document.getElementById("memberController_add_group").required = true;

        document.getElementById('memberController_add_form-group_sites').style.display = 'none';
        document.getElementById("memberController_add_sites").required = false;

        document.getElementById('memberController_add_form-group_cotton').style.display = 'block';
        
    }else{
        document.getElementById('memberController_add_form-group_group').style.display = 'block';
        document.getElementById("memberController_add_group").required = true;

        document.getElementById('memberController_add_form-group_sites').style.display = 'none';
        document.getElementById("memberController_add_sites").required = false;

        document.getElementById('memberController_add_form-group_cotton').style.display = 'none';
    }
});

$("#memberController_add_group").change(function(event) {
    showcottons();
    // alert("test");
});

function date_format(reserve_date) {

    const  y = parseInt(reserve_date.substr(0, 4));
    const  m = parseInt(reserve_date.substr(5, 2));
    const  d = reserve_date.substr(8, 2);
    
    const  yy = (y + 543);

    if (m == '01'){  mm = "มกราคม";}
    else if (m == '02'){  mm = "กุมภาพันธ์";}
    else if (m == '03'){  mm = "มีนาคม";}
    else if (m == '04'){  mm = "เมษายน";}
    else if (m == '05'){  mm = "พฤษภาคม";}
    else if (m == '06'){  mm = "มิถุนายน";}
    else if (m == '07'){  mm = "กรกฎาคม";}
    else if (m == '08'){  mm = "สิงหาคม";}
    else if (m == '09'){  mm = "กันยายน";}
    else if (m == '10'){  mm = "ตุลาคม";}
    else if (m == '11'){  mm = "พฤศจิกายน";}
    else if (m == '12'){  mm = "ธันวาคม";}

 
    if (d == "01"){ dd = "1"; }
    else if (d == "02"){ dd = "2";}
    else if (d == "03"){ dd = "3";}
    else if (d == "04"){ dd = "4";}
    else if (d == "05"){ dd = "5";}
    else if (d == "06"){ dd = "6";}
    else if (d == "07"){ dd = "7";}
    else if (d == "08"){ dd = "8";}
    else if (d == "09"){ dd = "9";}
    else{ dd = d ;}

   const format = dd + " " + mm + " " + yy;
    
    return format
}
//------------------------------------------------------------------------------------------
//member_dashboard

$("#member_dashoardController_doc_recnum_b").change(function(event) {
    var dnd = $('#member_dashoardController_doc_recnum_b :selected').parent().attr('label');
    //alert($(this).find(':selected').data('id'));
    if(dnd == 'เลขที่จองไว้'){
        document.getElementById("member_dashoardController_doc_date_2_b").readOnly = true;
        shoWreserve_date_member_b_dashboard($(this).find(':selected').data('id'));
    }else if(dnd == 'เลขที่หลุดจอง'){
        document.getElementById("member_dashoardController_doc_date_2_b").readOnly = true;
        shoWreserve_date_member_b_dashboard($(this).find(':selected').data('id'));
    }else{
        document.getElementById("member_dashoardController_doc_date_2_b").readOnly = false;
        document.getElementById('member_dashoardController_doc_date_2_b').value = date_now_format();
    }
});

$("#member_dashoardController_doc_recnum").change(function(event) {
    var dnd = $('#member_dashoardController_doc_recnum :selected').parent().attr('label');
    //alert($(this).find(':selected').data('id'));
    if(dnd == 'เลขที่จองไว้'){
        document.getElementById("member_dashoardController_doc_date_2").readOnly = true;
        shoWreserve_date_member_dashboard($(this).find(':selected').data('id'));
    }else if(dnd == 'เลขที่หลุดจอง'){
        document.getElementById("member_dashoardController_doc_date_2").readOnly = true;
        shoWreserve_date_member_dashboard($(this).find(':selected').data('id'));
    }else{
        document.getElementById("member_dashoardController_doc_date_2").readOnly = false;
        document.getElementById('member_dashoardController_doc_date_2').value = date_now_format();
    }
});
//member_dashboard
$("#member_dashoardController_doc_template_inside").change(function(event) {
    // alert("test s");
    let doc_recnum_inside = document.querySelector("#member_dashoardController_doc_recnum_inside");
    doc_recnum_inside.innerHTML = '<option value="">กรุณาเลือกประเภทก่อน</option>';

    var var_member_dashoardController_doc_template_inside = $("#member_dashoardController_doc_template_inside").val();
    if(var_member_dashoardController_doc_template_inside == ''){
        let option = document.createElement("option");
        doc_recnum_inside.appendChild(option);
    }else{
        let url_run = "/get_doc_recnum_inside_run/" + var_member_dashoardController_doc_template_inside;
        fetch(url_run)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                optgroup = document.createElement('optgroup');
                optgroup.label  = 'เลขรันปกติ';
                doc_recnum_inside.appendChild(optgroup);

                let option = document.createElement("option");
                option.text = '( ' + result + ' )';
                option.value = result;
                optgroup.appendChild(option);
            });
        // จอง
        let url_reserve = "/get_doc_recnum_inside_reserve/" + var_member_dashoardController_doc_template_inside;
            fetch(url_reserve)
            .then(response => response.json())
            .then(result => {
                optgroup = document.createElement('optgroup');
                optgroup.label  = 'เลขที่จองไว้';
                doc_recnum_inside.appendChild(optgroup);

                for (let item of result) {
                    
                    let option = document.createElement("option");
                    option.text ='( ' + item.reserve_number + ' ) ' + date_format(item.reserve_date);
                    
                    option.value = item.reserve_number;
                    option.dataset.id = item.reserve_id;
                    optgroup.appendChild(option);
                }
            });
        // หลุดจอง
        let url_dropped = "/get_doc_recnum_inside_dropped/" + var_member_dashoardController_doc_template_inside;
            fetch(url_dropped)
            .then(response => response.json())
            .then(result => {
                optgroup = document.createElement('optgroup');
                optgroup.label  = 'เลขที่หลุดจอง';
                doc_recnum_inside.appendChild(optgroup);

                for (let item of result) {
                    
                    let option = document.createElement("option");
                    //option.text = '( ' + item.reserve_number + ' )' + item.reserve_date;
                    option.text ='( ' + item.reserve_number + ' ) ' + date_format(item.reserve_date);
                    option.value = item.reserve_number;
                    option.dataset.id = item.reserve_id;
                    optgroup.appendChild(option);
                }
            });
    }
}); 



//member_dashboard
$("#member_dashoardController_doc_recnum_inside").change(function(event) {
    var dnd = $('#member_dashoardController_doc_recnum_inside :selected').parent().attr('label');
    //alert($(this).find(':selected').data('id'));
    // console.log($(this).find(':selected').data('id'));
    if(dnd == 'เลขที่จองไว้'){
        document.getElementById("member_dashoardController_doc_date_2_inside").readOnly = true;
        shoWreserve_date_member_dashboard_inside($(this).find(':selected').data('id'));
    }else if(dnd == 'เลขที่หลุดจอง'){
        document.getElementById("member_dashoardController_doc_date_2_inside").readOnly = true;
        shoWreserve_date_member_dashboard_inside($(this).find(':selected').data('id'));
    }else{
        document.getElementById("member_dashoardController_doc_date_2_inside").readOnly = false;
        document.getElementById('member_dashoardController_doc_date_2_inside').value = date_now_format();
    }
});

//member_dashboard
function shoWreserve_date_member_dashboard_inside(data_id) {
    let url_inside = "/getdoc_recnum/" + data_id;
   
    fetch(url_inside)
        .then(response => response.text())
        .then(result => {
            var date = result;
         
            var day = result.toString().substring(0, 2);
            var month = result.toString().substring(2, 4);
            var year = result.toString().substring(4, 8);
            // console.log([day, month, year].join('-'));
            var date = [year, month, day].join('-');
            document.getElementById("member_dashoardController_doc_date_2_inside").value = date;
        });
}

//member_dashboard
$("#member_dashoardController_RadioAttachments_inside_0").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_inside_form-group_group').style.display = 'none';
    document.getElementById("member_dashoardController_doc_attached_file_inside").required = false;
});
$("#member_dashoardController_RadioAttachments_inside_1").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_inside_form-group_group').style.display = 'block';
    document.getElementById("member_dashoardController_doc_attached_file_inside").required = true;
});

//member_dashboard
$("#member_dashoardController_send_inside").change(function(event) {
    var var_member_dashoardController_send_inside = $("#member_dashoardController_send_inside").val();
    if(var_member_dashoardController_send_inside == '0'){
        document.getElementById('documents_admission_group_allController_selected_multiple_sub_recid_inside_form-group').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub_recid_inside").required = false;

        
        document.getElementById('documents_admission_group_allController_selected_multiple_sub2_recid_inside_form-group').style.display = 'block';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_inside").required = true;

        
    }else if(var_member_dashoardController_send_inside == '1'){
        document.getElementById('documents_admission_group_allController_selected_multiple_sub_recid_inside_form-group').style.display = 'block';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub_recid_inside").required = true;

        document.getElementById('documents_admission_group_allController_selected_multiple_sub2_recid_inside_form-group').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_inside").required = false;

    }else{
        document.getElementById('documents_admission_group_allController_selected_multiple_sub_recid_inside_form-group').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub_recid_inside").required = false;

        document.getElementById('documents_admission_group_allController_selected_multiple_sub2_recid_inside_form-group').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_inside").required = false;
    }
});

function date_now_format() {
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();
    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    const formattedToday = yyyy + '-' + mm + '-' + dd;
    return formattedToday
}

function shoWreserve_date_member_dashboard(data_id) {
    let url = "/getdoc_recnum/" + data_id;
    fetch(url)
        .then(response => response.text())
        .then(result => {
            var date = result;
            // alert(result);
            var day = result.toString().substring(0, 2);
            var month = result.toString().substring(2, 4);
            var year = result.toString().substring(4, 8);
            //console.log([day, month, year].join('-'));
            var date = [year, month, day].join('-');
            document.getElementById("member_dashoardController_doc_date_2").value = date;
        });
}

function shoWreserve_date_member_b_dashboard(data_id) {
    let url = "/getdoc_recnum/" + data_id;
    fetch(url)
        .then(response => response.text())
        .then(result => {
            var date = result;
            // alert(result);
            var day = result.toString().substring(0, 2);
            var month = result.toString().substring(2, 4);
            var year = result.toString().substring(4, 8);
            //console.log([day, month, year].join('-'));
            var date = [year, month, day].join('-');
            document.getElementById("member_dashoardController_doc_date_2_b").value = date;
        });
}



$("#member_dashoardController_RadioAttachments_0").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group').style.display = 'none';
    document.getElementById("member_dashoardController_doc_attached_file").required = false;
});
$("#member_dashoardController_RadioAttachments_1").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group').style.display = 'block';
    document.getElementById("member_dashoardController_doc_attached_file").required = true;
});

$("#member_dashoardController_RadioAttachments_0_b").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group_b').style.display = 'none';
    document.getElementById("member_dashoardController_doc_attached_file_b").required = false;
});
$("#member_dashoardController_RadioAttachments_1_b").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group_b').style.display = 'block';
    document.getElementById("member_dashoardController_doc_attached_file_b").required = true;
});

$("#member_dashoardController_checkbox_seal_point").click(function(event) {
    var var_checkbox_seal_point = document.getElementById("member_dashoardController_checkbox_seal_point");
    if(var_checkbox_seal_point.checked == true){
        document.getElementById('member_dashoardController_seal_point').style.display = 'block';
    }else{
        document.getElementById('member_dashoardController_seal_point').style.display = 'none';
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_all.detail
$("#open_doc_attached_file").click(function(event) {
    var var_open_doc_attached_file = $("#open_doc_attached_file").val();
    var var_window = window.open(var_open_doc_attached_file,'windowName', 'width=1350,height=600,scrollbars=no');
    setTimeout(function(){var_window.close();}, 5000);
});
//------------------------------------------------------------------------------------------
//member.documents_admission_group_all.detail
$("#documents_admission_group_allController_sign_goup_0").change(function(event) {
    // var dnd = document.querySelector('#documents_admission_group_allController_sign_goup_0');
    var dnd = $('#documents_admission_group_allController_sign_goup_0 :selected').val();
    if(dnd == 'cottons'){
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = false;


        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'block';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_cottons").required = true;
    }else if(dnd == 'groupmems'){
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = false;

        
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_cottons").required = false;
    }else{
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = true;


        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'none';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid_cottons").required = false;
    }
});

$("#documents_admission_group_allController_sub_recnum").change(function(event) {
    var dnd = $('#documents_admission_group_allController_sub_recnum :selected').parent().attr('label');
    if(dnd == 'เลขที่จองไว้'){
        document.getElementById("documents_admission_group_allController_sub_date").readOnly = true;
        shoWreserve_date_documents_admission_group_all($(this).find(':selected').data('id'));
    }else if(dnd == 'เลขที่หลุดจอง'){
        document.getElementById("documents_admission_group_allController_sub_date").readOnly = true;
        shoWreserve_date_documents_admission_group_all($(this).find(':selected').data('id'));
    }else{
        document.getElementById("documents_admission_group_allController_sub_date").readOnly = false;
        document.getElementById('documents_admission_group_allController_sub_date').value = date_now_format();
    }
});

function shoWreserve_date_documents_admission_group_all(data_id) {
    let url = "/getdoc_recnum_inside/" + data_id;
    fetch(url)
        .then(response => response.json())
        .then(result => {
            var date = result;
            // alert(result);
            var day = result.toString().substring(0, 2);
            var month = result.toString().substring(2, 4);
            var year = result.toString().substring(4, 8);
            //console.log([day, month, year].join('-'));
            var date = [year, month, day].join('-');
            document.getElementById("documents_admission_group_allController_sub_date").value = date;
        });
}
//------------------------------------------------------------------------------------------
//member.documents_admission_group_inside_all.detail
$("#documents_admission_group_inside_allController_sign_goup_0").change(function(event) {
    var dnd = $('#documents_admission_group_inside_allController_sign_goup_0 :selected').val();
    if(dnd == 'cottons'){
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = false;


        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'block';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons").required = true;
    }else if(dnd == 'groupmems'){
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = false;

        
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'none';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons").required = false;
    }else{
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = true;


        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'none';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons").required = false;
    }
});

$("#documents_admission_secretary_retrunController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_secretary_retrunController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_secretary_retrunController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_secretary_retrunController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_admission_inside_secretary_retrunController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_inside_secretary_retrunController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_inside_secretary_retrunController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_inside_secretary_retrunController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_admission_jurisprudenceController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_jurisprudenceController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_jurisprudenceController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_jurisprudenceController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_admission_inside_jurisprudenceController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_inside_jurisprudenceController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_inside_jurisprudenceController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_inside_jurisprudenceController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_retrun_inside_secretaryController_docrt_sealid").change(function(event) {
    var dnd = $('#documents_retrun_inside_secretaryController_docrt_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_retrun_inside_secretaryController_form-group_docrt_note').style.display = 'block';
    }else{
        document.getElementById('documents_retrun_inside_secretaryController_form-group_docrt_note').style.display = 'none';
    }
});

$("#documents_retrun_inside_jurisprudenceController_docrt_sealid").change(function(event) {
    var dnd = $('#documents_retrun_inside_jurisprudenceController_docrt_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_retrun_inside_jurisprudenceController_form-group_docrt_note').style.display = 'block';
    }else{
        document.getElementById('documents_retrun_inside_jurisprudenceController_form-group_docrt_note').style.display = 'none';
    }
});

$("#documents_admission_deputy_signController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_deputy_signController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_deputy_signController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_deputy_signController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_admission_inside_deputy_signController_sub3_sealid").change(function(event) {
    var dnd = $('#documents_admission_inside_deputy_signController_sub3_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_admission_inside_deputy_signController_form-group_sub3_note').style.display = 'block';
    }else{
        document.getElementById('documents_admission_inside_deputy_signController_form-group_sub3_note').style.display = 'none';
    }
});

$("#documents_retrun_inside_deputy_signController_docrt_sealid").change(function(event) {
    var dnd = $('#documents_retrun_inside_deputy_signController_docrt_sealid :selected').val();
    if(dnd == 'ตีกลับ'){
        document.getElementById('documents_retrun_inside_deputy_signController_form-group_docrt_note').style.display = 'block';
    }else{
        document.getElementById('documents_retrun_inside_deputy_signController_form-group_docrt_note').style.display = 'none';
    }
});

$("#documents_admission_group_inside_allController_sub_recnum").change(function(event) {
    var dnd = $('#documents_admission_group_inside_allController_sub_recnum :selected').parent().attr('label');
    if(dnd == 'เลขที่จองไว้'){
        document.getElementById("documents_admission_group_inside_allController_sub_date").readOnly = true;
        shoWreserve_date_documents_admission_group_inside_all($(this).find(':selected').data('id'));
    }else if(dnd == 'เลขที่หลุดจอง'){
        document.getElementById("documents_admission_group_inside_allController_sub_date").readOnly = true;
        shoWreserve_date_documents_admission_group_inside_all($(this).find(':selected').data('id'));
    }else{
        document.getElementById("documents_admission_group_inside_allController_sub_date").readOnly = false;
        document.getElementById('documents_admission_group_inside_allController_sub_date').value = date_now_format();
    }
});

function shoWreserve_date_documents_admission_group_inside_all(data_id) {
    let url = "/getdoc_recnum_inside_s/" + data_id;
    fetch(url)
        .then(response => response.json())
        .then(result => {
            var date = result;
            // alert(result);
            var day = result.toString().substring(0, 2);
            var month = result.toString().substring(2, 4);
            var year = result.toString().substring(4, 8);
            //console.log([day, month, year].join('-'));
            var date = [year, month, day].join('-');
            document.getElementById("documents_admission_group_inside_allController_sub_date").value = date;
        });
}

//------------------------------------------------------------------------------------------
//member.documents_admission_department_all.detail
$("#documents_admission_department_allController_sign_goup_1").change(function(event) {
    var var_documents_admission_department_allController_sign_goup_1 = $("#documents_admission_department_allController_sign_goup_1").val();
    if(var_documents_admission_department_allController_sign_goup_1 != ''){
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_department_allController_selected_multiple_sub2_recid").required = false;
    }else{
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_department_allController_selected_multiple_sub2_recid").required = true;
    }
});

//------------------------------------------------------------------------------------------
//member.documents_admission_department_all.detail
$("#documents_admission_department_allController_sign_goup_1_inside").change(function(event) {
    var var_documents_admission_department_allController_sign_goup_1_inside = $("#documents_admission_department_allController_sign_goup_1_inside").val();
    if(var_documents_admission_department_allController_sign_goup_1_inside != ''){
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'none';
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid_inside').value  = '';
        document.getElementById("documents_admission_department_allController_selected_multiple_sub2_recid_inside").required = false;
    }else{
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'block';
        document.getElementById('documents_admission_department_allController_form-group_selected_multiple_sub2_recid_inside').value  = '';
        document.getElementById("documents_admission_department_allController_selected_multiple_sub2_recid_inside").required = true;
    }
});

//------------------------------------------------------------------------------------------
//member.documents_admission_division_inside_all.detail
$("#documents_admission_division_allController_sign_goup_0_inside").change(function(event) {
    //จับ label ของ optgroup
    var dnd = $('#documents_admission_division_allController_sign_goup_0_inside :selected').val();
    if(dnd == 'cottons'){
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside_cottons').style.display = 'block';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside_cottons").required = true;


        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'none';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside").required = false;
    }else{
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside_cottons').style.display = 'none';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside_cottons").required = false;


        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'block';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside").required = true;
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_division_all.detail
$("#documents_admission_division_allController_sign_goup_0").change(function(event) {
    //จับ label ของ optgroup
    var dnd = $('#documents_admission_division_allController_sign_goup_0 :selected').val();
    if(dnd == 'cottons'){
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'block';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_cottons").required = true;


        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid").required = false;
    
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
    // }else if(dnd == 'นายก'){
        // document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        // document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid").required = false;
        
        //ดึงข้อมูล
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'none';
        // fn_show_documents_admission_division_allController_sign_goup_3();
        // setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'block'; },1000);
    
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
    // }else if(dnd == 'รองนายก|ปลัด|รองปลัด'){
        // document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        // document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid").required = false;
        
        //ดึงข้อมูล
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'none';
        // fn_show_documents_admission_division_allController_sign_goup_3();
        // setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'block'; },1000);
        
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
    }else{
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_cottons').style.display = 'none';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_cottons").required = false;


        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid").required = true;
        
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_4').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
        // document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
    }
});

// $("#documents_admission_division_allController_sign_goup_4").change(function(event) {
//     var dnd = $('#documents_admission_division_allController_sign_goup_4 :selected').parent().attr('label');
//     if(dnd == 'นายก'){
//         //ดึงข้อมูล
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
//         fn_show_documents_admission_division_allController_sign_goup_4();
//         setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'block'; },1000);
    
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
//     }else if(dnd == 'รองนายก|ปลัด|รองปลัด'){
//         //ดึงข้อมูล
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';
//         fn_show_documents_admission_division_allController_sign_goup_4();
//         setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'block'; },1000);

//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
//     }else{
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_5').value  = '';

//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
//     }
// });

// $("#documents_admission_division_allController_sign_goup_5").change(function(event) {
//     var dnd = $('#documents_admission_division_allController_sign_goup_5 :selected').parent().attr('label');
//     if(dnd == 'นายก'){
//         //ดึงข้อมูล
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';

//         fn_show_documents_admission_division_allController_sign_goup_5();
//         setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'block'; },1000);
//     }else if(dnd == 'รองนายก|ปลัด|รองปลัด'){
//          //ดึงข้อมูล
//          document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//          document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
 
//          fn_show_documents_admission_division_allController_sign_goup_5();
//          setTimeout(function(){ document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'block'; },1000);
//     }else{
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').style.display = 'none';
//         document.getElementById('documents_admission_division_allController_form-group_sign_goup_6').value  = '';
//     }
// });
//------------------------------------------------------------------------------------------
//member.documents_admission_work_inside_all.detail
$("#documents_admission_work_inside_allController_sub3_type").change(function(event) {
    var var_documents_admission_work_inside_allController_sub3_type = $("#documents_admission_work_inside_allController_sub3_type").val();
    if(var_documents_admission_work_inside_allController_sub3_type == '0'){
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-message-memo').style.display = 'block';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_check_respond').value  = 'respond';
    }else if(var_documents_admission_work_inside_allController_sub3_type == '1'){
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-garuda').style.display = 'block';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_check_respond').value  = 'respond_garuda';
    }else if(var_documents_admission_work_inside_allController_sub3_type == '2'){
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-normal').style.display = 'block';
        document.getElementById('documents_admission_work_inside_allController_check_respond').value  = 'respond_normal';
    }else{
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_inside_allController_check_respond').value  = '';
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_all.detail
$("#documents_admission_work_allController_sub3_type").change(function(event) {
    var var_documents_admission_work_allController_sub3_type = $("#documents_admission_work_allController_sub3_type").val();
    if(var_documents_admission_work_allController_sub3_type == '0'){
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'block';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_allController_check_respond').value  = 'respond';
    }else if(var_documents_admission_work_allController_sub3_type == '1'){
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'block';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_allController_check_respond').value  = 'respond_garuda';
    }else if(var_documents_admission_work_allController_sub3_type == '2'){
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-normal').style.display = 'block';
        document.getElementById('documents_admission_work_allController_check_respond').value  = 'respond_normal';
    }else{
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-normal').style.display = 'none';
        document.getElementById('documents_admission_work_allController_check_respond').value  = '';
    }
});

$("#documents_admission_work_allController_sub3d_file_normal").change(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-normal").disabled = false;
});

$("#documents_admission_work_retrun_sub3d_file_normal").change(function(event) {
    document.getElementById("documents_admission_work_retrun_bt_respond-normal").disabled = false;
});

$("#documents_admission_inside_work_retrun_sub3d_file_normal").change(function(event) {
    document.getElementById("documents_admission_inside_work_retrun_bt_respond-normal").disabled = false;
});

$("#documents_retrun_inside_work_retrunController_docrtdt_file_normal").change(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-normal").disabled = false;
});

$("#documents_admission_work_inside_allController_sub3d_file_normal").change(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-normal").disabled = false;
});

$("#navigationController_docrtdt_file_normal").change(function(event) {
    document.getElementById("navigationController_bt_respond-normal").disabled = false;
});
//------------------------------------------------------------------------------------------
//navigationController
$("#navigationController_docrt_type").change(function(event) {
    var var_navigationController_docrt_type = $("#navigationController_docrt_type").val();
    if(var_navigationController_docrt_type == '0'){
        document.getElementById('navigationController_form-group_tb-docrt_details-message-memo').style.display = 'block';
        document.getElementById('navigationController_form-group_tb-docrt_details-garuda').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-normal').style.display = 'none';
        document.getElementById('navigationController_check_respond').value  = 'respond';
    }else if(var_navigationController_docrt_type == '1'){
        document.getElementById('navigationController_form-group_tb-docrt_details-message-memo').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-garuda').style.display = 'block';
        document.getElementById('navigationController_form-group_tb-docrt_details-normal').style.display = 'none';
        document.getElementById('navigationController_check_respond').value  = 'respond_garuda';
    }else if(var_navigationController_docrt_type == '2'){
        document.getElementById('navigationController_form-group_tb-docrt_details-message-memo').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-garuda').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-normal').style.display = 'block';
        document.getElementById('navigationController_check_respond').value  = 'respond_normal';
    }else{
        document.getElementById('navigationController_form-group_tb-docrt_details-message-memo').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-garuda').style.display = 'none';
        document.getElementById('navigationController_form-group_tb-docrt_details-normal').style.display = 'none';
        document.getElementById('navigationController_check_respond').value  = '';
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_division_retrun.detail
$("#documents_retrun_inside_division_retrunController_docrtdt_government-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = true;
});
$("#ddocuments_retrun_inside_division_retrunController_docrtdt_draft-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_date-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_topic-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_podium-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_bt_preview-garuda").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_division_retrunController_docrtdt_government_garuda = $("#documents_retrun_inside_division_retrunController_docrtdt_government-garuda").val(); //ส่วนราชการ
    let documents_retrun_inside_division_retrunController_docrtdt_draft_garuda = $("#documents_retrun_inside_division_retrunController_docrtdt_draft-garuda").val(); //ที่ร่าง
    let documents_retrun_inside_division_retrunController_docrtdt_date_garuda = $("#documents_retrun_inside_division_retrunController_docrtdt_date-garuda").val(); //วันที่
    let documents_retrun_inside_division_retrunController_docrtdt_topic_garuda = $("#documents_retrun_inside_division_retrunController_docrtdt_topic-garuda").val(); //เรื่อง
    let documents_retrun_inside_division_retrunController_docrtdt_podium_garuda = $("#documents_retrun_inside_division_retrunController_docrtdt_podium-garuda").val(); //ข้อความตั้งแท่น
    if(documents_retrun_inside_division_retrunController_docrtdt_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government_garuda: documents_retrun_inside_division_retrunController_docrtdt_government_garuda,
            docrtdt_draft_garuda: documents_retrun_inside_division_retrunController_docrtdt_draft_garuda,
            docrtdt_date_garuda: documents_retrun_inside_division_retrunController_docrtdt_date_garuda,
            docrtdt_topic_garuda: documents_retrun_inside_division_retrunController_docrtdt_topic_garuda,
            docrtdt_podium_garuda: documents_retrun_inside_ddivision_retrunController_docrtdt_podium_garuda,
            action_garuda: 'preview',
            docrtdt_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_division_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_division_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_division_retrunController_bt_respond-garuda").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_department_retrun.detail
$("#documents_retrun_inside_department_retrunController_docrtdt_government-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = true;
});
$("#ddocuments_retrun_inside_department_retrunController_docrtdt_draft-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_date-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_topic-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_podium-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_bt_preview-garuda").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_department_retrunController_docrtdt_government_garuda = $("#documents_retrun_inside_department_retrunController_docrtdt_government-garuda").val(); //ส่วนราชการ
    let documents_retrun_inside_department_retrunController_docrtdt_draft_garuda = $("#documents_retrun_inside_department_retrunController_docrtdt_draft-garuda").val(); //ที่ร่าง
    let documents_retrun_inside_department_retrunController_docrtdt_date_garuda = $("#documents_retrun_inside_department_retrunController_docrtdt_date-garuda").val(); //วันที่
    let documents_retrun_inside_department_retrunController_docrtdt_topic_garuda = $("#documents_retrun_inside_department_retrunController_docrtdt_topic-garuda").val(); //เรื่อง
    let documents_retrun_inside_department_retrunController_docrtdt_podium_garuda = $("#documents_retrun_inside_department_retrunController_docrtdt_podium-garuda").val(); //ข้อความตั้งแท่น
    if(documents_retrun_inside_department_retrunController_docrtdt_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government_garuda: documents_retrun_inside_department_retrunController_docrtdt_government_garuda,
            docrtdt_draft_garuda: documents_retrun_inside_department_retrunController_docrtdt_draft_garuda,
            docrtdt_date_garuda: documents_retrun_inside_department_retrunController_docrtdt_date_garuda,
            docrtdt_topic_garuda: documents_retrun_inside_department_retrunController_docrtdt_topic_garuda,
            docrtdt_podium_garuda: documents_retrun_inside_department_retrunController_docrtdt_podium_garuda,
            action_garuda: 'preview',
            docrtdt_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_department_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_department_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_department_retrunController_bt_respond-garuda").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_work_retrun.detail
$("#documents_retrun_inside_work_retrunController_docrtdt_government-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#ddocuments_retrun_inside_work_retrunController_docrtdt_draft-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_date-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_topic-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_podium-garuda").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_bt_preview-garuda").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_work_retrunController_docrtdt_government_garuda = $("#documents_retrun_inside_work_retrunController_docrtdt_government-garuda").val(); //ส่วนราชการ
    let documents_retrun_inside_work_retrunController_docrtdt_draft_garuda = $("#documents_retrun_inside_work_retrunController_docrtdt_draft-garuda").val(); //ที่ร่าง
    let documents_retrun_inside_work_retrunController_docrtdt_date_garuda = $("#documents_retrun_inside_work_retrunController_docrtdt_date-garuda").val(); //วันที่
    let documents_retrun_inside_work_retrunController_docrtdt_topic_garuda = $("#documents_retrun_inside_work_retrunController_docrtdt_topic-garuda").val(); //เรื่อง
    let documents_retrun_inside_work_retrunController_docrtdt_podium_garuda = $("#documents_retrun_inside_work_retrunController_docrtdt_podium-garuda").val(); //ข้อความตั้งแท่น
    if(documents_retrun_inside_work_retrunController_docrtdt_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government_garuda: documents_retrun_inside_work_retrunController_docrtdt_government_garuda,
            docrtdt_draft_garuda: documents_retrun_inside_work_retrunController_docrtdt_draft_garuda,
            docrtdt_date_garuda: documents_retrun_inside_work_retrunController_docrtdt_date_garuda,
            docrtdt_topic_garuda: documents_retrun_inside_work_retrunController_docrtdt_topic_garuda,
            docrtdt_podium_garuda: documents_retrun_inside_work_retrunController_docrtdt_podium_garuda,
            action_garuda: 'preview',
            docrtdt_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_work_retrunController_bt_respond-garuda").disabled = false;
        });
    }

});
//------------------------------------------------------------------------------------------
//member.documents_admission_inside_work_retrun.detail
$("#documents_admission_inside_work_retrunController_sub3d_government-garuda").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#ddocuments_admission_inside_work_retrunController_sub3d_draft-garuda").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_date-garuda").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_topic-garuda").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_podium-garuda").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_inside_work_retrunController_bt_preview-garuda").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_inside_work_retrunController_sub3d_government_garuda = $("#documents_admission_inside_work_retrunController_sub3d_government-garuda").val(); //ส่วนราชการ
    let documents_admission_inside_work_retrunController_sub3d_draft_garuda = $("#documents_admission_inside_work_retrunController_sub3d_draft-garuda").val(); //ที่ร่าง
    let documents_admission_inside_work_retrunController_sub3d_date_garuda = $("#documents_admission_inside_work_retrunController_sub3d_date-garuda").val(); //วันที่
    let documents_admission_inside_work_retrunController_sub3d_topic_garuda = $("#documents_admission_inside_work_retrunController_sub3d_topic-garuda").val(); //เรื่อง
    let documents_admission_inside_work_retrunController_sub3d_podium_garuda = $("#documents_admission_inside_work_retrunController_sub3d_podium-garuda").val(); //ข้อความตั้งแท่น
    
    if(documents_admission_inside_work_retrunController_sub3d_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government_garuda: documents_admission_inside_work_retrunController_sub3d_government_garuda,
            sub3d_draft_garuda: documents_admission_inside_work_retrunController_sub3d_draft_garuda,
            sub3d_date_garuda: documents_admission_inside_work_retrunController_sub3d_date_garuda,
            sub3d_topic_garuda: documents_admission_inside_work_retrunController_sub3d_topic_garuda,
            sub3d_podium_garuda: documents_admission_inside_work_retrunController_sub3d_podium_garuda,
            action_garuda: 'preview',
            sub3d_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_inside_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_inside_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_inside_work_retrunController_bt_respond-garuda").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_retrun.detail
$("#documents_admission_work_retrunController_sub3d_government-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#ddocuments_admission_work_retrunController_sub3d_draft-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_date-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_topic-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_podium-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_retrunController_bt_preview-garuda").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_retrunController_sub3d_government_garuda = $("#documents_admission_work_retrunController_sub3d_government-garuda").val(); //ส่วนราชการ
    let documents_admission_work_retrunController_sub3d_draft_garuda = $("#documents_admission_work_retrunController_sub3d_draft-garuda").val(); //ที่ร่าง
    let documents_admission_work_retrunController_sub3d_date_garuda = $("#documents_admission_work_retrunController_sub3d_date-garuda").val(); //วันที่
    let documents_admission_work_retrunController_sub3d_topic_garuda = $("#documents_admission_work_retrunController_sub3d_topic-garuda").val(); //เรื่อง
    let documents_admission_work_retrunController_sub3d_podium_garuda = $("#documents_admission_work_retrunController_sub3d_podium-garuda").val(); //ข้อความตั้งแท่น
    
    if(documents_admission_work_retrunController_sub3d_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government_garuda: documents_admission_work_retrunController_sub3d_government_garuda,
            sub3d_draft_garuda: documents_admission_work_retrunController_sub3d_draft_garuda,
            sub3d_date_garuda: documents_admission_work_retrunController_sub3d_date_garuda,
            sub3d_topic_garuda: documents_admission_work_retrunController_sub3d_topic_garuda,
            sub3d_podium_garuda: documents_admission_work_retrunController_sub3d_podium_garuda,
            action_garuda: 'preview',
            sub3d_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_retrunController_bt_respond-garuda").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//navigationController
$("#navigationController_docrtdt_government-garuda").keyup(function(event) {
    document.getElementById("navigationController_bt_respond-garuda").disabled = true;
});
$("#navigationController_docrtdt_draft-garuda").keyup(function(event) {
    document.getElementById("navigationController_bt_respond-garuda").disabled = true;
});
$("#navigationController_docrtdt_date-garuda").keyup(function(event) {
    document.getElementById("navigationController_bt_respond-garuda").disabled = true;
});
$("#navigationController_docrtdt_topic-garuda").keyup(function(event) {
    document.getElementById("navigationController_bt_respond-garuda").disabled = true;
});
$("#navigationController_docrtdt_podium-garuda").keyup(function(event) {
    document.getElementById("navigationController_bt_respond-garuda").disabled = true;
});
$("#navigationController_bt_preview-garuda").click(function(event) {
    let _token = $("#navigationController_token").val(); //csrf_token
    let navigationController_docrtdt_speed_garuda = $("#navigationController_docrtdt_speed").val(); //ความเร็ว
    let navigationController_docrtdt_government_garuda = $("#navigationController_docrtdt_government-garuda").val(); //ส่วนราชการ
    let navigationController_docrtdt_draft_garuda = $("#navigationController_docrtdt_draft-garuda").val(); //ที่ร่าง
    let navigationController_docrtdt_date_garuda = $("#navigationController_docrtdt_date-garuda").val(); //วันที่
    let navigationController_docrtdt_topic_garuda = $("#navigationController_docrtdt_topic-garuda").val(); //เรื่อง
    let navigationController_docrtdt_podium_garuda = $("#navigationController_docrtdt_podium-garuda").val(); //ข้อความตั้งแท่น
   
    if(navigationController_docrtdt_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_speed_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government_garuda: navigationController_docrtdt_government_garuda,
            docrtdt_draft_garuda: navigationController_docrtdt_draft_garuda,
            docrtdt_date_garuda: navigationController_docrtdt_date_garuda,
            docrtdt_topic_garuda: navigationController_docrtdt_topic_garuda,
            docrtdt_podium_garuda: navigationController_docrtdt_podium_garuda,
            action_garuda: 'preview',
            docrtdt_id_garuda: null,
        };

        fetch('/PDFRespond_garuda_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {

            // $("#modal-Create-new-document-inside-retrun-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        // $("#modal-Create-new-document-inside-retrun-preview").modal("hide");
                    }
                }, 1000);
            }else{
                document.getElementById('navigationController_pdf_preview-garuda').style.display = 'block';
                document.getElementById('navigationController_page-garuda').style.display = 'none';
                let input_cotton = document.querySelector("#navigationController_pdf_preview-garuda");
                input_cotton.src = fileURL;
                // $("#navigationController_close-modal-preview").click(function(event) {
                //     $("#modal-Create-new-document-inside-retrun-preview").modal("hide");
                // });
            }
            document.getElementById("navigationController_bt_respond-garuda").disabled = false;
        });

    }
});
$("#navigationController_bt_preview-edit-garuda").click(function(event) {
    document.getElementById('navigationController_pdf_preview-garuda').style.display = 'none';
    document.getElementById('navigationController_page-garuda').style.display = 'block';
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_all.detail
$("#documents_admission_work_allController_sub3d_government-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_allController_sub3d_draft-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_allController_sub3d_date-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_allController_sub3d_topic-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_allController_sub3d_podium-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = true;
});

$("#documents_admission_work_allController_bt_preview-garuda").click(function(event) {

    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_allController_sub3d_speed_garuda = $("#documents_admission_work_allController_sub3d_speed").val(); //ความเร็ว
    let documents_admission_work_allController_sub3d_government_garuda = $("#documents_admission_work_allController_sub3d_government-garuda").val(); //ส่วนราชการ
    let documents_admission_work_allController_sub3d_draft_garuda = $("#documents_admission_work_allController_sub3d_draft-garuda").val(); //ที่ร่าง
    let documents_admission_work_allController_sub3d_date_garuda = $("#documents_admission_work_allController_sub3d_date-garuda").val(); //วันที่
    let documents_admission_work_allController_sub3d_topic_garuda = $("#documents_admission_work_allController_sub3d_topic-garuda").val(); //เรื่อง
    let documents_admission_work_allController_sub3d_podium_garuda = $("#documents_admission_work_allController_sub3d_podium-garuda").val(); //ข้อความตั้งแท่น

    if(documents_admission_work_allController_sub3d_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_speed_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government_garuda: documents_admission_work_allController_sub3d_government_garuda,
            sub3d_draft_garuda: documents_admission_work_allController_sub3d_draft_garuda,
            sub3d_date_garuda: documents_admission_work_allController_sub3d_date_garuda,
            sub3d_topic_garuda: documents_admission_work_allController_sub3d_topic_garuda,
            sub3d_podium_garuda: documents_admission_work_allController_sub3d_podium_garuda,
            action_garuda: 'preview',
            sub3d_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_allController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_allController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_allController_bt_respond-garuda").disabled = false;
        });

        
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_inside_all.detail
$("#documents_admission_work_inside_allController_sub3d_government-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_draft-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_date-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_topic-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_podium-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = true;
});

$("#documents_admission_work_inside_allController_bt_preview-garuda").click(function(event) {

    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_inside_allController_sub3d_speed_garuda = $("#documents_admission_work_inside_allController_sub3d_speed").val(); //ความเร็ว
    let documents_admission_work_inside_allController_sub3d_government_garuda = $("#documents_admission_work_inside_allController_sub3d_government-garuda").val(); //ส่วนราชการ
    let documents_admission_work_inside_allController_sub3d_draft_garuda = $("#documents_admission_work_inside_allController_sub3d_draft-garuda").val(); //ที่ร่าง
    let documents_admission_work_inside_allController_sub3d_date_garuda = $("#documents_admission_work_inside_allController_sub3d_date-garuda").val(); //วันที่
    let documents_admission_work_inside_allController_sub3d_topic_garuda = $("#documents_admission_work_inside_allController_sub3d_topic-garuda").val(); //เรื่อง
    let documents_admission_work_inside_allController_sub3d_podium_garuda = $("#documents_admission_work_inside_allController_sub3d_podium-garuda").val(); //ข้อความตั้งแท่น

    if(documents_admission_work_inside_allController_sub3d_government_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_draft_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_date_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_topic_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_podium_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_speed_garuda == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government_garuda: documents_admission_work_inside_allController_sub3d_government_garuda,
            sub3d_draft_garuda: documents_admission_work_inside_allController_sub3d_draft_garuda,
            sub3d_date_garuda: documents_admission_work_inside_allController_sub3d_date_garuda,
            sub3d_topic_garuda: documents_admission_work_inside_allController_sub3d_topic_garuda,
            sub3d_podium_garuda: documents_admission_work_inside_allController_sub3d_podium_garuda,
            action_garuda: 'preview',
            sub3d_id_garuda: null,
        };
        // console.log(var_data);

        fetch('/PDFRespond_garuda', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_inside_allController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_inside_allController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_inside_allController_bt_respond-garuda").disabled = false;
        });

        
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_division_retrun.detail
$("#documents_retrun_inside_division_retrunController_docrtdt_government").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_draft").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_date").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_topic").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_docrtdt_podium").keyup(function(event) {
    document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_division_retrunController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_division_retrunController_docrtdt_government = $("#documents_retrun_inside_division_retrunController_docrtdt_government").val(); //ส่วนราชการ
    let documents_retrun_inside_division_retrunController_docrtdt_draft = $("#documents_retrun_inside_division_retrunController_docrtdt_draft").val(); //ที่ร่าง
    let documents_retrun_inside_division_retrunController_docrtdt_date = $("#documents_retrun_inside_division_retrunController_docrtdt_date").val(); //วันที่
    let documents_retrun_inside_division_retrunController_docrtdt_topic = $("#documents_retrun_inside_division_retrunController_docrtdt_topic").val(); //เรื่อง
    let documents_retrun_inside_division_retrunController_docrtdt_podium = $("#documents_retrun_inside_division_retrunController_docrtdt_podium").val(); //ข้อความตั้งแท่น
    if(documents_retrun_inside_division_retrunController_docrtdt_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_division_retrunController_docrtdt_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government: documents_retrun_inside_division_retrunController_docrtdt_government,
            docrtdt_draft: documents_retrun_inside_division_retrunController_docrtdt_draft,
            docrtdt_date: documents_retrun_inside_division_retrunController_docrtdt_date,
            docrtdt_topic: documents_retrun_inside_division_retrunController_docrtdt_topic,
            docrtdt_podium: documents_retrun_inside_division_retrunController_docrtdt_podium,
            action: 'preview',
            docrtdt_id: null,
        };

        fetch('/PDFRespond_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_division_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_division_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_division_retrunController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_department_retrun.detail
$("#documents_retrun_inside_department_retrunController_docrtdt_government").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_draft").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_date").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_topic").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_docrtdt_podium").keyup(function(event) {
    document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_department_retrunController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_department_retrunController_docrtdt_government = $("#documents_retrun_inside_department_retrunController_docrtdt_government").val(); //ส่วนราชการ
    let documents_retrun_inside_department_retrunController_docrtdt_draft = $("#documents_retrun_inside_department_retrunController_docrtdt_draft").val(); //ที่ร่าง
    let documents_retrun_inside_department_retrunController_docrtdt_date = $("#documents_retrun_inside_department_retrunController_docrtdt_date").val(); //วันที่
    let documents_retrun_inside_department_retrunController_docrtdt_topic = $("#documents_retrun_inside_department_retrunController_docrtdt_topic").val(); //เรื่อง
    let documents_retrun_inside_department_retrunController_docrtdt_podium = $("#documents_retrun_inside_department_retrunController_docrtdt_podium").val(); //ข้อความตั้งแท่น
    if(documents_retrun_inside_department_retrunController_docrtdt_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_department_retrunController_docrtdt_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government: documents_retrun_inside_department_retrunController_docrtdt_government,
            docrtdt_draft: documents_retrun_inside_department_retrunController_docrtdt_draft,
            docrtdt_date: documents_retrun_inside_department_retrunController_docrtdt_date,
            docrtdt_topic: documents_retrun_inside_department_retrunController_docrtdt_topic,
            docrtdt_podium: documents_retrun_inside_department_retrunController_docrtdt_podium,
            action: 'preview',
            docrtdt_id: null,
        };

        fetch('/PDFRespond_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_department_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_department_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_department_retrunController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_retrun_inside_work_retrun.detail
$("#documents_retrun_inside_work_retrunController_docrtdt_government").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_draft").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_date").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_topic").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_docrtdt_podium").keyup(function(event) {
    document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_retrun_inside_work_retrunController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_retrun_inside_work_retrunController_docrtdt_government = $("#documents_retrun_inside_work_retrunController_docrtdt_government").val(); //ส่วนราชการ
    let documents_retrun_inside_work_retrunController_docrtdt_draft = $("#documents_retrun_inside_work_retrunController_docrtdt_draft").val(); //ที่ร่าง
    let documents_retrun_inside_work_retrunController_docrtdt_date = $("#documents_retrun_inside_work_retrunController_docrtdt_date").val(); //วันที่
    let documents_retrun_inside_work_retrunController_docrtdt_topic = $("#documents_retrun_inside_work_retrunController_docrtdt_topic").val(); //เรื่อง
    let documents_retrun_inside_work_retrunController_docrtdt_podium = $("#documents_retrun_inside_work_retrunController_docrtdt_podium").val(); //ข้อความตั้งแท่น

    if(documents_retrun_inside_work_retrunController_docrtdt_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_retrun_inside_work_retrunController_docrtdt_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government: documents_retrun_inside_work_retrunController_docrtdt_government,
            docrtdt_draft: documents_retrun_inside_work_retrunController_docrtdt_draft,
            docrtdt_date: documents_retrun_inside_work_retrunController_docrtdt_date,
            docrtdt_topic: documents_retrun_inside_work_retrunController_docrtdt_topic,
            docrtdt_podium: documents_retrun_inside_work_retrunController_docrtdt_podium,
            action: 'preview',
            docrtdt_id: null,
        };

        fetch('/PDFRespond_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_retrun_inside_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_retrun_inside_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_retrun_inside_work_retrunController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_inside_work_retrun.detail
$("#documents_admission_inside_work_retrunController_sub3d_government").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_draft").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_date").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_topic").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_inside_work_retrunController_sub3d_podium").keyup(function(event) {
    document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_inside_work_retrunController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_inside_work_retrunController_sub3d_government = $("#documents_admission_inside_work_retrunController_sub3d_government").val(); //ส่วนราชการ
    let documents_admission_inside_work_retrunController_sub3d_draft = $("#documents_admission_inside_work_retrunController_sub3d_draft").val(); //ที่ร่าง
    let documents_admission_inside_work_retrunController_sub3d_date = $("#documents_admission_inside_work_retrunController_sub3d_date").val(); //วันที่
    let documents_admission_inside_work_retrunController_sub3d_topic = $("#documents_admission_inside_work_retrunController_sub3d_topic").val(); //เรื่อง
    let documents_admission_inside_work_retrunController_sub3d_podium = $("#documents_admission_inside_work_retrunController_sub3d_podium").val(); //ข้อความตั้งแท่น

    if(documents_admission_inside_work_retrunController_sub3d_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_inside_work_retrunController_sub3d_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government: documents_admission_inside_work_retrunController_sub3d_government,
            sub3d_draft: documents_admission_inside_work_retrunController_sub3d_draft,
            sub3d_date: documents_admission_inside_work_retrunController_sub3d_date,
            sub3d_topic: documents_admission_inside_work_retrunController_sub3d_topic,
            sub3d_podium: documents_admission_inside_work_retrunController_sub3d_podium,
            action: 'preview',
            sub3d_id: null,
        };

        fetch('/PDFRespond', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_inside_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_inside_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_inside_work_retrunController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_retrun.detail
$("#documents_admission_work_retrunController_sub3d_government").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_draft").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_date").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_topic").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_work_retrunController_sub3d_podium").keyup(function(event) {
    document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = true;
});
$("#documents_admission_work_retrunController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_retrunController_sub3d_government = $("#documents_admission_work_retrunController_sub3d_government").val(); //ส่วนราชการ
    let documents_admission_work_retrunController_sub3d_draft = $("#documents_admission_work_retrunController_sub3d_draft").val(); //ที่ร่าง
    let documents_admission_work_retrunController_sub3d_date = $("#documents_admission_work_retrunController_sub3d_date").val(); //วันที่
    let documents_admission_work_retrunController_sub3d_topic = $("#documents_admission_work_retrunController_sub3d_topic").val(); //เรื่อง
    let documents_admission_work_retrunController_sub3d_podium = $("#documents_admission_work_retrunController_sub3d_podium").val(); //ข้อความตั้งแท่น

    if(documents_admission_work_retrunController_sub3d_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_retrunController_sub3d_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            sub3d_government: documents_admission_work_retrunController_sub3d_government,
            sub3d_draft: documents_admission_work_retrunController_sub3d_draft,
            sub3d_date: documents_admission_work_retrunController_sub3d_date,
            sub3d_topic: documents_admission_work_retrunController_sub3d_topic,
            sub3d_podium: documents_admission_work_retrunController_sub3d_podium,
            // sub3d_therefore: documents_admission_work_allController_sub3d_therefore,
            // sub3d_pos: documents_admission_work_allController_sub3d_pos,
            action: 'preview',
            sub3d_id: null,
        };

        fetch('/PDFRespond', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_retrunController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_retrunController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_retrunController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//navigationController
$("#navigationController_docrtdt_government").keyup(function(event) {
    document.getElementById("navigationController_bt_respond").disabled = true;
});
$("#navigationController_docrtdt_draft").keyup(function(event) {
    document.getElementById("navigationController_bt_respond").disabled = true;
});
$("#navigationController_docrtdt_date").keyup(function(event) {
    document.getElementById("navigationController_bt_respond").disabled = true;
});
$("#navigationController_docrtdt_topic").keyup(function(event) {
    document.getElementById("navigationController_bt_respond").disabled = true;
});
$("#navigationController_docrtdt_podium").keyup(function(event) {
    document.getElementById("navigationController_bt_respond").disabled = true;
});
$("#navigationController_bt_preview").click(function(event) {
    let _token = $("#navigationController_token").val(); //csrf_token
    let navigationController_docrtdt_speed = $("#navigationController_docrtdt_speed").val(); //ความเร็ว
    let navigationController_docrtdt_government = $("#navigationController_docrtdt_government").val(); //ส่วนราชการ
    let navigationController_docrtdt_draft = $("#navigationController_docrtdt_draft").val(); //ที่ร่าง
    let navigationController_docrtdt_date = $("#navigationController_docrtdt_date").val(); //วันที่
    let navigationController_docrtdt_topic = $("#navigationController_docrtdt_topic").val(); //เรื่อง
    let navigationController_docrtdt_podium = $("#navigationController_docrtdt_podium").val(); //ข้อความตั้งแท่น

    if(navigationController_docrtdt_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else if(navigationController_docrtdt_speed == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{
        const var_data = {
            docrtdt_government: navigationController_docrtdt_government,
            docrtdt_draft: navigationController_docrtdt_draft,
            docrtdt_date: navigationController_docrtdt_date,
            docrtdt_topic: navigationController_docrtdt_topic,
            docrtdt_podium: navigationController_docrtdt_podium,
            action: 'preview',
            docrtdt_id: null,
        };

        fetch('/PDFRespond_retrun', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {

            // $("#modal-Create-new-document-inside-retrun-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-Create-new-document-inside-retrun-preview").modal("hide");
                    }
                }, 1000);
            }else{
                document.getElementById('navigationController_pdf_preview').style.display = 'block';
                document.getElementById('navigationController_page').style.display = 'none';
                let input_cotton = document.querySelector("#navigationController_pdf_preview");
                input_cotton.src = fileURL;
                // $("#navigationController_close-modal-preview").click(function(event) {
                //     $("#modal-Create-new-document-inside-retrun-preview").modal("hide");
                // });
            }
            document.getElementById("navigationController_bt_respond").disabled = false;
        });


    }
});
$("#navigationController_bt_preview-edit").click(function(event) {
    document.getElementById('navigationController_pdf_preview').style.display = 'none';
    document.getElementById('navigationController_page').style.display = 'block';
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_all.detail
$("#documents_admission_work_allController_sub3d_government").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_allController_sub3d_draft").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_allController_sub3d_date").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_allController_sub3d_topic").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_allController_sub3d_podium").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
});
// $("#documents_admission_work_allController_sub3d_therefore").change(function(event) {
//     document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
// });
// $("#documents_admission_work_allController_sub3d_pos").change(function(event) {
//     document.getElementById("documents_admission_work_allController_bt_respond").disabled = true;
// });

$("#documents_admission_work_allController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_allController_sub3d_speed = $("#documents_admission_work_allController_sub3d_speed").val(); //ความเร็ว
    let documents_admission_work_allController_sub3d_government = $("#documents_admission_work_allController_sub3d_government").val(); //ส่วนราชการ
    let documents_admission_work_allController_sub3d_draft = $("#documents_admission_work_allController_sub3d_draft").val(); //ที่ร่าง
    let documents_admission_work_allController_sub3d_date = $("#documents_admission_work_allController_sub3d_date").val(); //วันที่
    let documents_admission_work_allController_sub3d_topic = $("#documents_admission_work_allController_sub3d_topic").val(); //เรื่อง
    let documents_admission_work_allController_sub3d_podium = $("#documents_admission_work_allController_sub3d_podium").val(); //ข้อความตั้งแท่น
    // let documents_admission_work_allController_sub3d_therefore = $("#documents_admission_work_allController_sub3d_therefore").val(); //จึงเรียน
    // let documents_admission_work_allController_sub3d_pos = $("#documents_admission_work_allController_sub3d_pos").val(); //ตำแหน่ง

    if(documents_admission_work_allController_sub3d_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_allController_sub3d_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    // }else if(documents_admission_work_allController_sub3d_therefore == ''){
    //     document.getElementById('documents_admission_work_allController_alert_error').style.display = 'block';
    //     document.getElementById('documents_admission_work_allController_tag_p_error').innerText  = 'กรุณาเลือก ผู้รับ';
    //     return;
    // }else if(documents_admission_work_allController_sub3d_pos == ''){
    //     document.getElementById('documents_admission_work_allController_alert_error').style.display = 'block';
    //     document.getElementById('documents_admission_work_allController_tag_p_error').innerText  = 'กรุณาเลือก ตำแหน่ง';
    //     return;
    }else if(documents_admission_work_allController_sub3d_speed == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{
        // document.getElementById('documents_admission_work_allController_alert_error').style.display = 'none';

        const var_data = {
                        sub3d_government: documents_admission_work_allController_sub3d_government,
                        sub3d_draft: documents_admission_work_allController_sub3d_draft,
                        sub3d_date: documents_admission_work_allController_sub3d_date,
                        sub3d_topic: documents_admission_work_allController_sub3d_topic,
                        sub3d_podium: documents_admission_work_allController_sub3d_podium,
                        // sub3d_therefore: documents_admission_work_allController_sub3d_therefore,
                        // sub3d_pos: documents_admission_work_allController_sub3d_pos,
                        action: 'preview',
                        sub3d_id: null,
        };
        // console.log(var_data);
        //post
        fetch('/PDFRespond', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_allController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_allController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_allController_bt_respond").disabled = false;
        });

        //get บ่ได้ใช้ละอันนิหะ
        // fetch(url)
        // .then(response => response.arrayBuffer())
        // .then(result => {
        //     $("#modal-preview").modal("show");
        //     var blob = new Blob([result], { type: 'application/pdf' });
        //     var fileURL = URL.createObjectURL(blob);
            
        //     const isMobile = navigator.userAgentData.mobile;
        //     if(isMobile){
        //         var newWin = window.open(fileURL);
        //         newWin.focus();
        //         var timer = setInterval(function() {
        //             if (newWin.closed) {
        //                 clearInterval(timer);
        //                 $("#modal-preview").modal("hide");
        //             }
        //         }, 1000);
        //     }else{
        //         let input_cotton = document.querySelector("#documents_admission_work_allController_pdf_preview");
        //         input_cotton.src = fileURL;
        //         $("#documents_admission_work_allController_close-modal-preview").click(function(event) {
        //             $("#modal-preview").modal("hide");
        //         });
        //     }
        //     document.getElementById("documents_admission_work_allController_bt_respond").disabled = false;
        // });
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_inside_all.detail
$("#documents_admission_work_inside_allController_sub3d_government").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_draft").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_date").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_topic").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = true;
});
$("#documents_admission_work_inside_allController_sub3d_podium").keyup(function(event) {
    document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = true;
});

$("#documents_admission_work_inside_allController_bt_preview").click(function(event) {
    let _token = $("#_token").val(); //csrf_token
    let documents_admission_work_inside_allController_sub3d_speed = $("#documents_admission_work_inside_allController_sub3d_speed").val(); //ความเร็ว
    let documents_admission_work_inside_allController_sub3d_government = $("#documents_admission_work_inside_allController_sub3d_government").val(); //ส่วนราชการ
    let documents_admission_work_inside_allController_sub3d_draft = $("#documents_admission_work_inside_allController_sub3d_draft").val(); //ที่ร่าง
    let documents_admission_work_inside_allController_sub3d_date = $("#documents_admission_work_inside_allController_sub3d_date").val(); //วันที่
    let documents_admission_work_inside_allController_sub3d_topic = $("#documents_admission_work_inside_allController_sub3d_topic").val(); //เรื่อง
    let documents_admission_work_inside_allController_sub3d_podium = $("#documents_admission_work_inside_allController_sub3d_podium").val(); //ข้อความตั้งแท่น

    if(documents_admission_work_inside_allController_sub3d_government == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ส่วนงานราชการ!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_draft == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก ที่ร่าง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_date == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก วันที่!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_topic == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก เรื่อง!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_podium == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณากรอก รายละเอียด!",
            icon: "warning",
        });
        return;
    }else if(documents_admission_work_inside_allController_sub3d_speed == ''){
        swal({
            title: "แจ้งเดือน",
            text: "กรุณาเลือก ชั้นความเร็ว!",
            icon: "warning",
        });
        return;
    }else{

        const var_data = {
                        sub3d_government: documents_admission_work_inside_allController_sub3d_government,
                        sub3d_draft: documents_admission_work_inside_allController_sub3d_draft,
                        sub3d_date: documents_admission_work_inside_allController_sub3d_date,
                        sub3d_topic: documents_admission_work_inside_allController_sub3d_topic,
                        sub3d_podium: documents_admission_work_inside_allController_sub3d_podium,
                        action: 'preview',
                        sub3d_id: null,
        };
        // console.log(var_data);
        //post
        fetch('/PDFRespond', {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token
        },
        body:  JSON.stringify(var_data)
        })
        .then(response => response.arrayBuffer())
        .then(result => {
            // const content = await rawResponse.json();
            $("#modal-preview").modal("show");
            var blob = new Blob([result], { type: 'application/pdf' });
            var fileURL = URL.createObjectURL(blob);
                            
            // const isMobile = navigator.userAgentData.mobile;
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            var newWin = window.open(fileURL);
                newWin.focus();
                var timer = setInterval(function() {
                    if (newWin.closed) {
                        clearInterval(timer);
                        $("#modal-preview").modal("hide");
                    }
                }, 1000);
            }else{
                let input_cotton = document.querySelector("#documents_admission_work_inside_allController_pdf_preview");
                input_cotton.src = fileURL;
                $("#documents_admission_work_inside_allController_close-modal-preview").click(function(event) {
                    $("#modal-preview").modal("hide");
                });
            }
            document.getElementById("documents_admission_work_inside_allController_bt_respond").disabled = false;
        });
    }
});
//------------------------------------------------------------------------------------------
//selected_multiple
$('#selected_multiple').multiSelect();
$('#select-all').click(function() {
    $('#selected_multiple').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_group_all.detail selected_multiple
$('#documents_admission_group_allController_selected_multiple_sub2_recid').multiSelect();
$('#documents_admission_group_allController_selected_multiple_sub2_recid-select-all').click(function() {
    $('#documents_admission_group_allController_selected_multiple_sub2_recid').multiSelect('select_all');
    return false;
});
$('#documents_admission_group_allController_selected_multiple_sub2_recid_cottons').multiSelect();
$('#documents_admission_group_allController_selected_multiple_sub2_recid_cottons-select-all').click(function() {
    $('#documents_admission_group_allController_selected_multiple_sub2_recid_cottons').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_group_inside_all.detail selected_multiple
$('#documents_admission_group_inside_allController_selected_multiple_sub2_recid').multiSelect();
$('#documents_admission_group_inside_allController_selected_multiple_sub2_recid-select-all').click(function() {
    $('#documents_admission_group_inside_allController_selected_multiple_sub2_recid').multiSelect('select_all');
    return false;
});
$('#documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons').multiSelect();
$('#documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons-select-all').click(function() {
    $('#documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_department_all.detail selected_multiple
$('#documents_admission_department_allController_selected_multiple_sub2_recid').multiSelect();
$('#documents_admission_department_allController_selected_multiple_sub2_recid-select-all').click(function() {
    $('#documents_admission_department_allController_selected_multiple_sub2_recid').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_department_inside_all.detail selected_multiple
$('#documents_admission_department_allController_selected_multiple_sub2_recid_inside').multiSelect();
$('#documents_admission_department_allController_selected_multiple_sub2_recid_inside-select-all').click(function() {
    $('#documents_admission_department_allController_selected_multiple_sub2_recid_inside').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_division_all.detail selected_multiple
$('#documents_admission_division_allController_selected_multiple_sub2_recid').multiSelect();
$('#documents_admission_division_allController_selected_multiple_sub2_recid-select-all').click(function() {
    $('#documents_admission_division_allController_selected_multiple_sub2_recid').multiSelect('select_all');
    return false;
});
$('#documents_admission_division_allController_selected_multiple_sub2_recid_cottons').multiSelect();
$('#documents_admission_division_allController_selected_multiple_sub2_recid_cottons-select-all').click(function() {
    $('#documents_admission_division_allController_selected_multiple_sub2_recid_cottons').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member.documents_admission_division_inside_all.detail selected_multiple
$('#documents_admission_division_allController_selected_multiple_sub2_recid_inside').multiSelect();
$('#documents_admission_division_allController_selected_multiple_sub2_recid_inside-select-all').click(function() {
    $('#documents_admission_division_allController_selected_multiple_sub2_recid_inside').multiSelect('select_all');
    return false;
});
$('#documents_admission_division_allController_selected_multiple_sub2_recid_inside_cottons').multiSelect();
$('#documents_admission_division_allController_selected_multiple_sub2_recid_inside_cottons-select-all').click(function() {
    $('#documents_admission_division_allController_selected_multiple_sub2_recid_inside_cottons').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member_dashboard selected_multiple
$('#documents_admission_group_allController_selected_multiple_sub_recid_inside').multiSelect();
$('#documents_admission_group_allController_selected_multiple_sub_recid_inside-select-all').click(function() {
    $('#documents_admission_group_allController_selected_multiple_sub_recid_inside').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member_dashboard selected_multiple2
$('#documents_admission_group_allController_selected_multiple_sub2_recid_inside').multiSelect();
$('#documents_admission_group_allController_selected_multiple_sub2_recid_inside-select-all').click(function() {
    $('#documents_admission_group_allController_selected_multiple_sub2_recid_inside').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//selected_multiple
$('#documents_admission_allController_update-groupmems_selected_multiple').multiSelect();
$('#documents_admission_group_allController_selected_multiple_sub2_recid_cottons-select-all-select-all').click(function() {
    $('#documents_admission_group_allController_selected_multiple_sub2_recid_cottons-select-all').multiSelect('select_all');
    return false;
});
//------------------------------------------------------------------------------------------
//member_dashboard selected_multiple2
// $('#documents_admission_work_allController_sub3d_podium').summernote({
//     placeholder: 'อะ',
//     tabsize: 2,
//     height: 500,
//     toolbar: [
//         ['style', ['style']],
//         ['font', ['bold', 'underline', 'clear']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//         ['table', ['table']],
//         ['insert', ['link', 'picture', 'video']],
//         ['view', ['fullscreen', 'codeview', 'help']]
//       ]
// });
//------------------------------------------------------------------------------------------


//Table
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "order": [
            [0, "asc"]
        ],
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $("#example3").DataTable({
        "responsive": true,
        "order": [
            [4, "asc"]
        ],
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

});
//------------------------------------------------------------------------------------------
//load
window.addEventListener("load", function() {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
//------------------------------------------------------------------------------------------
//Initialize Select2 Elements
$(function() {
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
//------------------------------------------------------------------------------------------
//function เรียก cotton
function showcottons() {
    let input_group = $("#memberController_add_group").val();
    let url = "/cottons/" + input_group;
    // console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {
            // console.log(result);
            let input_cotton = document.querySelector("#memberController_add_cotton");
            input_cotton.innerHTML = '<option value="">บังคับเลือก</option>';
            for (let item of result) {
                let option = document.createElement("option");
                option.text = item.cottons_name;
                option.value = item.cottons_id;
                input_cotton.appendChild(option);
            }
        });
}
//------------------------------------------------------------------------------------------
//function เรียก user นายกและรองนายก|ปลัด|รองปลัด
// function fn_show_documents_admission_division_allController_sign_goup_3() {
//     let input_group = $("#documents_admission_division_allController_sign_goup_3").val();
//     let url_1 = "/users_level_1_0/" + input_group;
//     let url_2 = "/users_level_2_0/" + input_group;
//     // console.log(url_1);
//     fetch(url_1)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_4");
            
//             input_sign_goup.innerHTML = '<option value="">ไม่มีผู้พิจารณา</option>';

//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'นายก';
//             input_sign_goup.appendChild(optgroup);

//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);    
//             }
//         });

//     fetch(url_2)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_4");
            
//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'รองนายก|ปลัด|รองปลัด';
//             input_sign_goup.appendChild(optgroup);
            
//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);
//             }
//         });
// }
// function fn_show_documents_admission_division_allController_sign_goup_4() {
//     let input_group = $("#documents_admission_division_allController_sign_goup_3").val();

//     let input_group_1 = $("#documents_admission_division_allController_sign_goup_4").val();
//     let url_1 = "/users_level_1_1/" + input_group + "/" + input_group_1;
//     let url_2 = "/users_level_2_1/" + input_group + "/" + input_group_1;

//     fetch(url_1)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_5");
            
//             input_sign_goup.innerHTML = '<option value="">ไม่มีผู้พิจารณา</option>';

//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'นายก';
//             input_sign_goup.appendChild(optgroup);

//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);    
//             }
//         });

//     fetch(url_2)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_5");
            
//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'รองนายก|ปลัด|รองปลัด';
//             input_sign_goup.appendChild(optgroup);
            
//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);
//             }
//         });
// }

// function fn_show_documents_admission_division_allController_sign_goup_5() {
//     let input_group = $("#documents_admission_division_allController_sign_goup_3").val();
//     let input_group_1 = $("#documents_admission_division_allController_sign_goup_4").val();
//     let input_group_2 = $("#documents_admission_division_allController_sign_goup_5").val();
//     let url_1 = "/users_level_1_2/" + input_group + "/" + input_group_1 + "/" + input_group_2;
//     let url_2 = "/users_level_2_2/" + input_group + "/" + input_group_1 + "/" + input_group_2;

//     fetch(url_1)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_6");
            
//             input_sign_goup.innerHTML = '<option value="">ไม่มีผู้พิจารณา</option>';

//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'นายก';
//             input_sign_goup.appendChild(optgroup);

//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);    
//             }
//         });

//     fetch(url_2)
//         .then(response => response.json())
//         .then(result => {
//             // console.log(result);
//             let input_sign_goup = document.querySelector("#documents_admission_division_allController_sign_goup_6");
            
//             optgroup = document.createElement('optgroup');
//             optgroup.label  = 'รองนายก|ปลัด|รองปลัด';
//             input_sign_goup.appendChild(optgroup);
            
//             for (let item of result) {
//                 let option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 optgroup.appendChild(option);
//             }
//         });
// }
//------------------------------------------------------------------------------------------


