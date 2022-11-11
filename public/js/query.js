$('#chart_level_0').each(function () {
    
    var dataPoints = [];
    var dataLength = 20;
    var var_chart_level_0 = new CanvasJS.Chart("chart_level_0", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
            fontFamily: "italic",
            fontSize: 16,
            text: ""
        },
        axisY: {
            lineThickness: 1
        },
        data: [{
            toolTipContent: "<b>{label}</b>: จำนวนเอกสาร {y} เรื่อง",
            dataPoints: dataPoints,
            type: "line"
        }]
    });

    var updateChart = function () {
        $.ajax({
            type: "GET",
            url: "/dashboard/count/sub2_docs/query",
            data: '',
            success: function(data) {
                jQuery.each(data, function(index, item) {
                    // console.log(item);
                    dataPoints.push({label: item['doc_date'], y: item['sub2_id']});
                });
                var_chart_level_0.render();
                dataPoints = [];
            },
            error: function(request, status, error) {
                document.getElementById('chart_level_0').innerHTML = '<center><i class="spinner-border" style="width: 200px;height: 200px;"></i><span class="sr-only">Loading...</span></center>';
                console.log(error);
            }
        });
    }
    updateChart();
    setInterval(function(){updateChart()}, 3000);
    // console.log(dataPoints);
});
$('#funtion_query_dashboard_count_sites_level_0').each(function () {
    document.getElementById('funtion_query_dashboard_count_sites_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_query_dashboard_count_sites_level_0() {
        $.ajax({
            type: "GET",
            url: "/dashboard/count/sites/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_query_dashboard_count_sites_level_0').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_query_dashboard_count_sites_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_query_dashboard_count_sites_level_0();
    setInterval( function () {
        funtion_query_dashboard_count_sites_level_0();
    }, 3000 );
});

$('#funtion_query_dashboard_count_groupmem_level_0').each(function () {
    document.getElementById('funtion_query_dashboard_count_groupmem_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_query_dashboard_count_groupmem_level_0() {
        $.ajax({
            type: "GET",
            url: "/dashboard/count/groupmem/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_query_dashboard_count_groupmem_level_0').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_query_dashboard_count_groupmem_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_query_dashboard_count_groupmem_level_0();
    setInterval( function () {
        funtion_query_dashboard_count_groupmem_level_0();
    }, 3000 );
});

$('#funtion_query_dashboard_count_cottons_level_0').each(function () {
    document.getElementById('funtion_query_dashboard_count_cottons_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_query_dashboard_count_cottons_level_0() {
        $.ajax({
            type: "GET",
            url: "/dashboard/count/cottons/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_query_dashboard_count_cottons_level_0').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_query_dashboard_count_cottons_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_query_dashboard_count_cottons_level_0();
    setInterval( function () {
        funtion_query_dashboard_count_cottons_level_0();
    }, 3000 );
});

$('#funtion_query_dashboard_count_member_level_0').each(function () {
    document.getElementById('funtion_query_dashboard_count_member_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_query_dashboard_count_member_level_0() {
        $.ajax({
            type: "GET",
            url: "/dashboard/count/member/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_query_dashboard_count_member_level_0').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_query_dashboard_count_member_level_0').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_query_dashboard_count_member_level_0();
    setInterval( function () {
        funtion_query_dashboard_count_member_level_0();
    }, 3000 );
});

//ถ้าพบ element ตัวไหนใน views ไหนให้ ดึงข้อมูล ด้วย ajax นะครับบบ
$('#chart_level_3').each(function () {
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
});

$('#chart_level_4').each(function () {
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
});

$('#chart_inside_level_4').each(function () {
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
});

$('#chart_level_5').each(function () {
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
});

$('#chart_inside_level_5').each(function () {
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
});

$('#chart_level_6').each(function () {
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
});

$('#chart_inside_level_6').each(function () {
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
});

$('#chart_level_7').each(function () {
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
});

$('#chart_inside_level_7').each(function () {
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
});

$('#member_dashboard_input_calendar_reserve_numbers').each(function () {
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

        calendar.render();
        setInterval( function () {
            calendar.refetchEvents();
        }, 3000 );
    });
    // console.log(var_member_dashboard_input_calendar_reserve_numbers);
});
$('#funtion_document_admission_division_all_count_0_level_4').each(function () {
    document.getElementById('funtion_document_admission_division_all_count_0_level_4').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_division_all_count_0_level_4() {
        $.ajax({
            type: "GET",
            url: "/document_admission_division/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_division_all_count_0_level_4').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_division_all_count_0_level_4').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_division_all_count_0_level_4();
    setInterval( function () {
        funtion_document_admission_division_all_count_0_level_4();
    }, 3000 );
});
$('#funtion_document_admission_division_inside_all_count_0_level_4').each(function () {
    document.getElementById('funtion_document_admission_division_inside_all_count_0_level_4').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_division_inside_all_count_0_level_4() {
        $.ajax({
            type: "GET",
            url: "/document_admission_division_inside/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_division_inside_all_count_0_level_4').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_division_inside_all_count_0_level_4').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_division_inside_all_count_0_level_4();
    setInterval( function () {
        funtion_document_admission_division_inside_all_count_0_level_4();
    }, 3000 );
});
$('#funtion_document_admission_department_inside_all_count_0_level_5').each(function () {
    document.getElementById('funtion_document_admission_department_inside_all_count_0_level_5').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_department_inside_all_count_0_level_5() {
        $.ajax({
            type: "GET",
            url: "/document_admission_department_inside/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_department_inside_all_count_0_level_5').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_department_inside_all_count_0_level_5').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_department_inside_all_count_0_level_5();
    setInterval( function () {
        funtion_document_admission_department_inside_all_count_0_level_5();
    }, 3000 );
});
$('#funtion_document_admission_department_all_count_0_level_5').each(function () {
    document.getElementById('funtion_document_admission_department_all_count_0_level_5').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_department_all_count_0_level_5() {
        $.ajax({
            type: "GET",
            url: "/document_admission_department/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_department_all_count_0_level_5').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_department_all_count_0_level_5').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_department_all_count_0_level_5();
    setInterval( function () {
        funtion_document_admission_department_all_count_0_level_5();
    }, 3000 );
});
$('#funtion_document_admission_all_group_count_0_level_6').each(function () {
    document.getElementById('funtion_document_admission_all_group_count_0_level_6').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_all_group_count_0_level_6() {
        $.ajax({
            type: "GET",
            url: "/document_admission_all_group/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_all_group_count_0_level_6').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_all_group_count_0_level_6').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_all_group_count_0_level_6();
    setInterval( function () {
        funtion_document_admission_all_group_count_0_level_6();
    }, 3000 );
});
$('#funtion_document_admission_all_group_inside_count_0_level_6').each(function () {
    document.getElementById('funtion_document_admission_all_group_inside_count_0_level_6').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_all_group_inside_count_0_level_6() {
        $.ajax({
            type: "GET",
            url: "/document_admission_all_group_inside/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_all_group_inside_count_0_level_6').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_all_group_inside_count_0_level_6').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_all_group_inside_count_0_level_6();
    setInterval( function () {
        funtion_document_admission_all_group_inside_count_0_level_6();
    }, 3000 );
});
$('#funtion_document_admission_all_work_count_0_level_7').each(function () {
    document.getElementById('funtion_document_admission_all_work_count_0_level_7').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_all_work_count_0_level_7() {
        $.ajax({
            type: "GET",
            url: "/document_admission_all_work/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_all_work_count_0_level_7').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_all_work_count_0_level_7').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_all_work_count_0_level_7();
    setInterval( function () {
        funtion_document_admission_all_work_count_0_level_7();
    }, 3000 );
});
$('#funtion_document_admission_all_work_inside_count_0_level_7').each(function () {
    document.getElementById('funtion_document_admission_all_work_inside_count_0_level_7').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
    function funtion_document_admission_all_work_inside_count_0_level_7() {
        $.ajax({
            type: "GET",
            url: "/document_admission_all_work_inside/count/0/query",
            data: '',
            success: function(data) {
                document.getElementById('funtion_document_admission_all_work_inside_count_0_level_7').innerHTML = data;
                // console.log(data);
            },
            error: function(request, status, error) {
                document.getElementById('funtion_document_admission_all_work_inside_count_0_level_7').innerHTML = '<i class="spinner-border" style="width: 10px;height: 10px;"></i><span class="sr-only">Loading...</span>';
                console.log(error);
            }
        });
    }
    funtion_document_admission_all_work_inside_count_0_level_7();
    setInterval( function () {
        funtion_document_admission_all_work_inside_count_0_level_7();
    }, 3000 );
});
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
                [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
        [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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
            [0, "DESC"]
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