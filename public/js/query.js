//ดึงข้อมูล ด้วย ajax ตาม path
if(window.location.pathname == '/documents_admission_all/all'){
        var table = $('.table').DataTable({
            // processing: true,
            // language: {
            //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
            // },    
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }
            ],
            order: [
                [0, "asc"]
            ],
            ajax: {
                url: window.location.pathname +'/query',
                dataSrc: ''
            },
            columns: [
                { 
                    data: 'doc_id' 
                },
                { 
                    data: 'doc_origin' 
                },
                { 
                    data: 'doc_recnum' 
                },
                {   
                    data: 'doc_docnum' 
                },
                {   
                    data: 'doc_date' ,
                    render: function ( data) {
                        var year = data.toString().substring(0, 4);
                        var month = data.toString().substring(5, 7);
                        var day = data.toString().substring(8, 10);
                        var date = [day, month, year].join('-');
                        return (`<span class="badge bg-secondary">`+ date +`</span>`)
                    }
                },
                { 
                    data: 'doc_date_2' ,
                    render: function ( data) {
                        var year = data.toString().substring(0, 4);
                        var month = data.toString().substring(5, 7);
                        var day = data.toString().substring(8, 10);
                        var date = [day, month, year].join('-');
                        return (`<span class="badge bg-secondary">`+ date +`</span>`)
                    }
                },
                {
                    data: 'doc_title' 
                },
                {
                    data: 'doc_speed' ,
                    render: function ( data) {
                        if(data == '0'){
                            txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                        }else if(data == '1'){
                            txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                        }else if(data == '2'){
                            txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                        }else if(data == '3'){
                            txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                        }
                        return (txt_doc_speed)
                    }
                },
                {
                    data: 'doc_status' ,
                    render: function ( data) {
                        if(data == 'waiting'){
                            txt_status = '<span class="badge bg-warning">รอพิจารณา</span>';
                        }else if(data == 'success'){
                            txt_status = '<span class="badge bg-success">พิจารณาแล้ว</span>';
                        }else{
                            txt_status = "ไม่ถูกนิยาม";
                        }
                        return (txt_status)
                    }
                },
                {
                    data: 'doc_id' ,
                    render: function ( data) {
                        return (` <a href="/documents_admission_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                    }
                }
            ]
            
        }).on( 'processing.dt', function ( e, settings, processing ) {
            $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
        });

        table.on('order.dt search.dt', function () {
            let i = 1;
     
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
 
        setInterval( function () {
            table.ajax.reload(null, false);
        }, 3000 );

}else if(window.location.pathname == '/documents_pending/all'){

    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_pending/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_division_all/all/0'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // },
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_division_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_division_all/all/1'){
    // alert(window.location.pathname);
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // },
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_division_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_division_retrun/all'){
    // alert(window.location.pathname);
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // },
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'sub3d_government' 
            },
            { 
                data: 'sub3d_draft' 
            },
            {   
                data: 'sub3d_date'
            },
            {
                data: 'sub3d_topic' 
            },
            {
                data: 'sub3d_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_sub3d_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_sub3d_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_sub3d_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_sub3d_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_sub3d_speed)
                }
            },
            {
                data: 'sub3_status' ,
                render: function ( data) {
                    if(data == 'waiting'){
                        txt_sub3_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้าฝ่าย</span>';
                    }else if(data == 'success'){
                        txt_sub3_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้ากอง</span>';
                    }else{
                        txt_sub3_status = "ไม่ถูกนิยาม";
                    }
                    return (txt_sub3_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_division_retrun/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );
}else if(window.location.pathname == '/documents_admission_division_inside_all/all/0'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_division_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_division_inside_all/all/1'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_division_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_department_all/all/0'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // },    
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_department_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_department_all/all/1'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // },    
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_department_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_department_retrun/all'){
   // alert(window.location.pathname);
   var table = $('.table').DataTable({
    // processing: true,
    // language: {
    //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
    // },
    columnDefs: [
        {
            searchable: false,
            orderable: false,
            targets: 0,
        }
    ],
    order: [
        [0, "asc"]
    ],
    ajax: {
        url: window.location.pathname +'/query',
        dataSrc: ''
    },
    columns: [
        { 
            data: 'doc_id' 
        },
        { 
            data: 'sub3d_government' 
        },
        { 
            data: 'sub3d_draft' 
        },
        {   
            data: 'sub3d_date'
        },
        {
            data: 'sub3d_topic' 
        },
        {
            data: 'sub3d_speed' ,
            render: function ( data) {
                if(data == '0'){
                    txt_sub3d_speed = '<span class="badge bg-primary">ปกติ</span>';
                }else if(data == '1'){
                    txt_sub3d_speed = '<span class="badge bg-success">ด่วน</span>';
                }else if(data == '2'){
                    txt_sub3d_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                }else if(data == '3'){
                    txt_sub3d_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                }
                return (txt_sub3d_speed)
            }
        },
        {
            data: 'sub3_status' ,
            render: function ( data) {
                if(data == 'waiting'){
                    txt_sub3_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้าฝ่าย</span>';
                }else if(data == 'success'){
                    txt_sub3_status = '<span class="badge bg-warning">อยู่ระหว่างพิจารณาหัวหน้ากอง</span>';
                }else{
                    txt_sub3_status = "ไม่ถูกนิยาม";
                }
                return (txt_sub3_status)
            }
        },
        {
            data: 'doc_id' ,
            render: function ( data) {
                return (` <a href="/documents_admission_department_retrun/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
            }
        }
    ]
    
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

}else if(window.location.pathname == '/documents_admission_department_inside_all/all/0'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_department_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_department_inside_all/all/1'){

    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_department_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );
}else if(window.location.pathname == '/documents_admission_group/all/0'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_group/all/1'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_group/all/2'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_group_inside/all/0'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group_inside/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_group_inside/all/1'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group_inside/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_group_inside/all/2'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ใหม่</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้าฝ่ายพิจารณา</span>';
                    }else if(data == '2'){
                        txt_status = '<span class="badge bg-warning">รอหัวหน้ากองงานพิจารณา</span>';
                    }else if(data == '3'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '4'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '5'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '6'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '7'){
                        txt_status = '<span class="badge bg-warning">กำลังดำเนินการ</span>';
                    }else if(data == '8'){
                        txt_status = '<span class="badge bg-success">สำเร็จ</span>';
                    }else{
                        return "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_group_inside/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_work_all/all/0'){
//    alert('test');
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub2_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ยังไม่อ่าน</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-success">อ่านแล้ว</span>';
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_work_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_work_all/all/1'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_origin' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub2_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ยังไม่อ่าน</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-success">อ่านแล้ว</span>';
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_work_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_work_inside_all/all/0'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub2_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ยังไม่อ่าน</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-success">อ่านแล้ว</span>';
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_work_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );


}else if(window.location.pathname == '/documents_admission_work_inside_all/all/1'){
   
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'sub2_status' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_status = '<span class="badge bg-danger">ยังไม่อ่าน</span>';
                    }else if(data == '1'){
                        txt_status = '<span class="badge bg-success">อ่านแล้ว</span>';
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_work_inside_all/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );

}else if(window.location.pathname == '/documents_admission_all_inside/all'){
    var table = $('.table').DataTable({
        // processing: true,
        // language: {
        //     processing: '<i class="spinner-border"></i><span class="sr-only">Loading...</span><br><p class="text-muted">โหลดแปป</p>'
        // }, 
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            }
        ],
        order: [
            [0, "asc"]
        ],
        ajax: {
            url: window.location.pathname +'/query',
            dataSrc: ''
        },
        columns: [
            { 
                data: 'doc_id' 
            },
            { 
                data: 'doc_template' ,
                render: function ( data) {
                    if(data == 'A'){
                        txt_status = 'หนังสือรับ';
                    }else if(data == 'B'){
                        txt_status = 'หนังสือส่ง';
                    }else if(data == 'C'){
                        txt_status = 'หนังสือเลขประกาศ';
                    }else if(data == 'D'){
                        txt_status = 'หนังสือเลขคำสั่ง';
                    }else if(data == 'E'){
                        txt_status = 'หนังสือรับรอง';
                    }
                    return (txt_status)
                } 
            },
            { 
                data: 'doc_recnum' 
            },
            {   
                data: 'doc_docnum' 
            },
            {   
                data: 'doc_date' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            { 
                data: 'doc_date_2' ,
                render: function ( data) {
                    var year = data.toString().substring(0, 4);
                    var month = data.toString().substring(5, 7);
                    var day = data.toString().substring(8, 10);
                    var date = [day, month, year].join('-');
                    return (`<span class="badge bg-secondary">`+ date +`</span>`)
                }
            },
            {
                data: 'doc_title' 
            },
            {
                data: 'doc_speed' ,
                render: function ( data) {
                    if(data == '0'){
                        txt_doc_speed = '<span class="badge bg-primary">ปกติ</span>';
                    }else if(data == '1'){
                        txt_doc_speed = '<span class="badge bg-success">ด่วน</span>';
                    }else if(data == '2'){
                        txt_doc_speed = '<span class="badge bg-warning">ด่วนมาก</span>';
                    }else if(data == '3'){
                        txt_doc_speed = '<span class="badge bg-danger">ด่วนที่สุด!</span>';
                    }
                    return (txt_doc_speed)
                }
            },
            {
                data: 'doc_status' ,
                render: function ( data) {
                    if(data == 'waiting'){
                        txt_status = '<span class="badge bg-warning">รอพิจารณา</span>';
                    }else if(data == 'success'){
                        txt_status = '<span class="badge bg-success">พิจารณาแล้ว</span>';
                    }else{
                        txt_status = "ไม่ถูกนิยาม";
                    }
                    return (txt_status)
                }
            },
            {
                data: 'doc_id' ,
                render: function ( data) {
                    return (` <a href="/documents_admission_all_inside/detail/`+ data +`"><i class="far fa-file-alt"></i></a>`)
                }
            }
        ]
        
    }).on( 'processing.dt', function ( e, settings, processing ) {
        $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
    });

    table.on('order.dt search.dt', function () {
        let i = 1;
 
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    setInterval( function () {
        table.ajax.reload(null, false);
    }, 3000 );
}