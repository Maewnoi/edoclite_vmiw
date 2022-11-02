//ฟังชั่นนี้จะมีการป้องกันไม่ให้กด submit มากกว่า 1 ครั้ง ต้องใช้รวมกันกับ form เท่านั้น
function submitForm(btn) {
     btn.disabled = true;
     btn.className = ('loadingbydomji555+');
     btn.innerHTML = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
     btn.form.submit();
}
// alert(var_memberController_add_level);
//------------------------------------------------------------------------------------------
//admin.member.index
$("#memberController_add_level").change(function(event) {
    var var_memberController_add_level = $("#memberController_add_level").val();
    if(var_memberController_add_level=='0'||var_memberController_add_level=='1'||var_memberController_add_level=='2'||var_memberController_add_level=='3'){
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
    const mm = '';

    if (m == '01'){ const mm = "มกราคม";}
    else if (m == '02'){const  mm = "กุมภาพันธ์";}
    else if (m == '03'){ const mm = "มีนาคม";}
    else if (m == '04'){ const mm = "เมษายน";}
    else if (m == '05'){ const mm = "พฤษภาคม";}
    else if (m == '06'){ const mm = "มิถุนายน";}
    else if (m == '07'){ const mm = "กรกฎาคม";}
    else if (m == '08'){ const mm = "สิงหาคม";}
    else if (m == '09'){ const mm = "กันยายน";}
    else if (m == '10'){ const mm = "ตุลาคม";}
    else if (m == '11'){ const mm = "พฤศจิกายน";}
    else if (m == '12'){ const mm = "ธันวาคม";}

/* 
    if (d == "01"){ d = "1"; }
    else if (d == "02"){ d = "2";}
    else if (d == "03"){ d = "3";}
    else if (d == "04"){ d = "4";}
    else if (d == "05"){ d = "5";}
    else if (d == "06"){ d = "6";}
    else if (d == "07"){ d = "7";}
    else if (d == "08"){ d = "8";}
    else if (d == "09"){ d = "9";} 
*/
   const format = d + "/" + mm + "/" + yy;
    
    return format
}
//------------------------------------------------------------------------------------------
//member_dashboard
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
                //    option.text = '( ' + item.reserve_number + ' ) ' + date_format(item.reserve_date);
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
                    option.text = '( ' + item.reserve_number + ' )' + item.reserve_date;
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



$("#member_dashoardController_RadioAttachments_0").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group').style.display = 'none';
    document.getElementById("member_dashoardController_doc_attached_file").required = false;
});
$("#member_dashoardController_RadioAttachments_1").click(function(event) {
    document.getElementById('member_dashoardController_doc_attached_file_form-group_group').style.display = 'block';
    document.getElementById("member_dashoardController_doc_attached_file").required = true;
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
    var dnd = $('#documents_admission_group_allController_sign_goup_0 :selected').parent().attr('label');
    if(dnd == 'หัวหน้าฝ่าย'){
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = false;
    }else if(dnd == 'หัวหน้ากอง'){
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = false;
    }else{
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById('documents_admission_group_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_allController_selected_multiple_sub2_recid").required = true;
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
    var dnd = $('#documents_admission_group_inside_allController_sign_goup_0 :selected').parent().attr('label');
    if(dnd == 'หัวหน้าฝ่าย'){
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = false;
    }else if(dnd == 'หัวหน้ากอง'){
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'none';
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = false;
    }else{
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').style.display = 'block';
        document.getElementById('documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid').value  = '';
        document.getElementById("documents_admission_group_inside_allController_selected_multiple_sub2_recid").required = true;
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
    var dnd = $('#documents_admission_division_allController_sign_goup_0_inside :selected').parent().attr('label');
    if(dnd == 'หัวหน้าฝ่าย'){
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'none';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside").required = false;
    }else{
        document.getElementById('documents_admission_division_allController_form-group_selected_multiple_sub2_recid_inside').style.display = 'block';
        document.getElementById("documents_admission_division_allController_selected_multiple_sub2_recid_inside").required = true;
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_division_all.detail
$("#documents_admission_division_allController_sign_goup_0").change(function(event) {
    //จับ label ของ optgroup
    var dnd = $('#documents_admission_division_allController_sign_goup_0 :selected').parent().attr('label');
    if(dnd == 'หัวหน้าฝ่าย'){
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
//member.documents_admission_work_all.detail
$("#documents_admission_work_allController_sub3_type").change(function(event) {
    var var_documents_admission_work_allController_sub3_type = $("#documents_admission_work_allController_sub3_type").val();
    if(var_documents_admission_work_allController_sub3_type == '0'){
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'block';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
    }else if(var_documents_admission_work_allController_sub3_type == '1'){
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'block';
    }else{
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-message-memo').style.display = 'none';
        document.getElementById('documents_admission_work_allController_form-group_tb-sub3_details-garuda').style.display = 'none';
    }
});
//------------------------------------------------------------------------------------------
//member.documents_admission_work_all.detail
$("#documents_admission_work_allController_sub3d_government-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = true;
});
$("#documents_admission_work_allController_sub3d_draft-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = true;
});
$("#documents_admission_work_allController_sub3d_date-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = true;
});
$("#documents_admission_work_allController_sub3d_topic-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = true;
});
$("#documents_admission_work_allController_sub3d_podium-garuda").keyup(function(event) {
    document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = true;
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
        console.log(var_data);

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
                            
            const isMobile = navigator.userAgentData.mobile;
            if(isMobile){
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
            document.getElementById("documents_admission_work_allController_bt_respond-garudav").disabled = false;
        });

        
    }
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
        console.log(var_data);
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
                            
            const isMobile = navigator.userAgentData.mobile;
            if(isMobile){
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
//selected_multiple
$('#selected_multiple').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_group_all.detail selected_multiple
$('#documents_admission_group_allController_selected_multiple_sub2_recid').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_group_inside_all.detail selected_multiple
$('#documents_admission_group_inside_allController_selected_multiple_sub2_recid').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_department_all.detail selected_multiple
$('#documents_admission_department_allController_selected_multiple_sub2_recid').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_department_inside_all.detail selected_multiple
$('#documents_admission_department_allController_selected_multiple_sub2_recid_inside').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_division_all.detail selected_multiple
$('#documents_admission_division_allController_selected_multiple_sub2_recid').multiSelect();
//------------------------------------------------------------------------------------------
//member.documents_admission_division_inside_all.detail selected_multiple
$('#documents_admission_division_allController_selected_multiple_sub2_recid_inside').multiSelect();
//------------------------------------------------------------------------------------------
//member_dashboard selected_multiple
$('#documents_admission_group_allController_selected_multiple_sub_recid_inside').multiSelect();
//------------------------------------------------------------------------------------------
//member_dashboard selected_multiple2
$('#documents_admission_group_allController_selected_multiple_sub2_recid_inside').multiSelect();
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
// member.dashboard
window.onload = function () {


    
    if($("#member_dashboard_input_documents_admission_all_waiting_count_level_3").val()&&$("#member_dashboard_input_documents_admission_all_success_count_level_3").val()){
        var var_member_dashboard_input_documents_admission_all_waiting_count_level_3 = $("#member_dashboard_input_documents_admission_all_waiting_count_level_3").val();
        var var_member_dashboard_input_documents_admission_all_success_count_level_3 = $("#member_dashboard_input_documents_admission_all_success_count_level_3").val();
        var var_chart_level_3 = new CanvasJS.Chart("chart_level_3", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_documents_admission_all_waiting_count_level_3, label: "เอกสารรอพิจารณา" },
                    { y: var_member_dashboard_input_documents_admission_all_success_count_level_3, label: "เอกสารพิจารณาแล้ว" }
                ]
            }]
        });
        var_chart_level_3.render();
    }

    if($("#member_dashboard_input_documents_admission_division_all_count_0_level_4").val()&&$("#member_dashboard_input_documents_admission_division_all_count_1_level_4").val()){
        var var_member_dashboard_input_documents_admission_division_all_count_0_level_4 = $("#member_dashboard_input_documents_admission_division_all_count_0_level_4").val();
        var var_member_dashboard_input_documents_admission_division_all_count_1_level_4 = $("#member_dashboard_input_documents_admission_division_all_count_1_level_4").val();
        var var_chart_level_4 = new CanvasJS.Chart("chart_level_4", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_documents_admission_division_all_count_0_level_4, label: "เอกสารรอพิจารณา" },
                    { y: var_member_dashboard_input_documents_admission_division_all_count_1_level_4, label: "เอกสารที่เซ็นแล้ว" }
                ]
            }]
        });
        var_chart_level_4.render();
    }

    if($("#member_dashboard_input_documents_admission_division_inside_all_count_0_level_4").val()&&$("#member_dashboard_input_documents_admission_division_inside_all_count_1_level_4").val()){
        var var_member_dashboard_input_documents_admission_division_inside_all_count_0_level_4 = $("#member_dashboard_input_documents_admission_division_inside_all_count_0_level_4").val();
        var var_member_dashboard_input_documents_admission_division_inside_all_count_1_level_4 = $("#member_dashboard_input_documents_admission_division_inside_all_count_1_level_4").val();
        var var_chart_inside_level_4 = new CanvasJS.Chart("chart_inside_level_4", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_documents_admission_division_inside_all_count_0_level_4, label: "เอกสารรอพิจารณา" },
                    { y: var_member_dashboard_input_documents_admission_division_inside_all_count_1_level_4, label: "เอกสารที่เซ็นแล้ว" }
                ]
            }]
        });
        var_chart_inside_level_4.render();
    }

    if($("#member_dashboard_input_document_admission_department_all_count_0_level_5").val()&&$("#member_dashboard_input_document_admission_department_all_count_1_level_5").val()){
        var var_member_dashboard_input_document_admission_department_all_count_0_level_5 = $("#member_dashboard_input_document_admission_department_all_count_0_level_5").val();
        var var_member_dashboard_input_document_admission_department_all_count_1_level_5 = $("#member_dashboard_input_document_admission_department_all_count_1_level_5").val();
        var var_chart_level_5 = new CanvasJS.Chart("chart_level_5", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_department_all_count_0_level_5, label: "เอกสารรอพิจารณา" },
                    { y: var_member_dashboard_input_document_admission_department_all_count_1_level_5, label: "เอกสารที่เซ็นแล้ว" }
                ]
            }]
        });
        var_chart_level_5.render();
    }

    if($("#member_dashboard_input_document_admission_department_inside_all_count_0_level_5").val()&&$("#member_dashboard_input_document_admission_department_inside_all_count_1_level_5").val()){
        var var_member_dashboard_input_document_admission_department_inside_all_count_0_level_5 = $("#member_dashboard_input_document_admission_department_inside_all_count_0_level_5").val();
        var var_member_dashboard_input_document_admission_department_inside_all_count_1_level_5 = $("#member_dashboard_input_document_admission_department_inside_all_count_1_level_5").val();
        var var_chart_inside_level_5 = new CanvasJS.Chart("chart_inside_level_5", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_department_inside_all_count_0_level_5, label: "เอกสารรอพิจารณา" },
                    { y: var_member_dashboard_input_document_admission_department_inside_all_count_1_level_5, label: "เอกสารที่เซ็นแล้ว" }
                ]
            }]
        });
        var_chart_inside_level_5.render();
    }

    if($("#member_dashboard_input_document_admission_all_group_count_0_level_6").val()&&$("#member_dashboard_input_document_admission_all_group_count_1_level_6").val()&&$("#member_dashboard_input_document_admission_all_group_count_2_level_6").val()){
        var var_member_dashboard_input_document_admission_all_group_count_0_level_6 = $("#member_dashboard_input_document_admission_all_group_count_0_level_6").val();
        var var_member_dashboard_input_document_admission_all_group_count_1_level_6 = $("#member_dashboard_input_document_admission_all_group_count_1_level_6").val();
        var var_member_dashboard_input_document_admission_all_group_count_2_level_6 = $("#member_dashboard_input_document_admission_all_group_count_2_level_6").val();
        var var_chart_level_6 = new CanvasJS.Chart("chart_level_6", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_all_group_count_0_level_6, label: "เอกสารใหม่" },
                    { y: var_member_dashboard_input_document_admission_all_group_count_1_level_6, label: "เอกสารรอดำเนินการ" },
                    { y: var_member_dashboard_input_document_admission_all_group_count_2_level_6, label: "เอกสารดำเนินการแล้ว" }
                ]
            }]
        });
        var_chart_level_6.render();
    }

    if($("#member_dashboard_input_document_admission_all_group_inside_count_0_level_6").val()&&$("#member_dashboard_input_document_admission_all_group_inside_count_1_level_6").val()&&$("#member_dashboard_input_document_admission_all_group_inside_count_2_level_6").val()){
        var var_member_dashboard_input_document_admission_all_group_inside_count_0_level_6 = $("#member_dashboard_input_document_admission_all_group_inside_count_0_level_6").val();
        var var_member_dashboard_input_document_admission_all_group_inside_count_1_level_6 = $("#member_dashboard_input_document_admission_all_group_inside_count_1_level_6").val();
        var var_member_dashboard_input_document_admission_all_group_inside_count_2_level_6 = $("#member_dashboard_input_document_admission_all_group_inside_count_2_level_6").val();
        var var_chart_inside_level_6 = new CanvasJS.Chart("chart_inside_level_6", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_all_group_inside_count_0_level_6, label: "เอกสารใหม่" },
                    { y: var_member_dashboard_input_document_admission_all_group_inside_count_1_level_6, label: "เอกสารรอดำเนินการ" },
                    { y: var_member_dashboard_input_document_admission_all_group_inside_count_2_level_6, label: "เอกสารดำเนินการแล้ว" }
                ]
            }]
        });
        var_chart_inside_level_6.render();
    }

    if($("#member_dashboard_input_document_admission_all_work_count_0_level_7").val()&&$("#member_dashboard_input_document_admission_all_work_count_1_level_7").val()){
        var var_member_dashboard_input_document_admission_all_work_count_0_level_7 = $("#member_dashboard_input_document_admission_all_work_count_0_level_7").val();
        var var_member_dashboard_input_document_admission_all_work_count_1_level_7 = $("#member_dashboard_input_document_admission_all_work_count_1_level_7").val();
        var var_chart_level_7 = new CanvasJS.Chart("chart_level_7", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_all_work_count_0_level_7, label: "เอกสารรับเข้ายังไม่อ่าน" },
                    { y: var_member_dashboard_input_document_admission_all_work_count_1_level_7, label: "เอกสารรับเข้าอ่านแล้ว" }
                ]
            }]
        });
        var_chart_level_7.render();
    }

    if($("#member_dashboard_input_document_admission_all_work_inside_count_0_level_7").val()&&$("#member_dashboard_input_document_admission_all_work_inside_count_1_level_7").val()){
        var var_member_dashboard_input_document_admission_all_work_inside_count_0_level_7 = $("#member_dashboard_input_document_admission_all_work_inside_count_0_level_7").val();
        var var_member_dashboard_input_document_admission_all_work_inside_count_1_level_7 = $("#member_dashboard_input_document_admission_all_work_inside_count_1_level_7").val();
        var var_chart_inside_level_7 = new CanvasJS.Chart("chart_inside_level_7", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                fontFamily: "italic",
                fontSize: 16,
                text: ""
            },
            data: [{
                type: "pie",
                startAngle: 15,
                toolTipContent: "<b>{label}</b>: {y} เรื่อง",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 12,
                indexLabel: "{label} {y} เรื่อง",
                dataPoints: [
                    { y: var_member_dashboard_input_document_admission_all_work_inside_count_0_level_7, label: "เอกสารรับเข้ายังไม่อ่าน" },
                    { y: var_member_dashboard_input_document_admission_all_work_inside_count_1_level_7, label: "เอกสารรับเข้าอ่านแล้ว" }
                ]
            }]
        });
        var_chart_inside_level_7.render();
    }
}
//------------------------------------------------------------------------------------------
// member.dashboard
if($("#member_dashboard_input_calendar_reserve_numbers").val()){
    var var_member_dashboard_input_calendar_reserve_numbers = $("#member_dashboard_input_calendar_reserve_numbers").val();
    $(function() {
        function ini_events(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text())
                }
                $(this).data('eventObject', eventObject)
                $(this).draggable({
                    zIndex: 1070,
                    revert: true,
                    revertDuration: 0
                })

            })
        }

        ini_events($('#external-events div.external-event'))
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                        'background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                        'background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventLimit: true,
            defaultDate: new Date(),
            timezone: 'Asia/Bangkok',
            events: {
                url: "/calendarReserve/" + var_member_dashboard_input_calendar_reserve_numbers,
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();

                if (info.event.url) {
                    window.open(info.event.url, 'Page 1');
                }
            },

            loading: function(bool) {
                $('#loading').toggle(bool);
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                // right: 'dayGridMonth,timeGridWeek,timeGridDay'
                right: ''
            },
            themeSystem: 'bootstrap',

            editable: true,
            droppable: true,
            drop: function(info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        calendar.render();
        var currColor = '#3c8dbc'
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            currColor = $(this).css('color')
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        $('#add-new-event').click(function(e) {
            e.preventDefault()
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)
            ini_events(event)
            $('#new-event').val('')
        })
    })
}
//------------------------------------------------------------------------------------------

