<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Schedule</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('css/font-google.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/bootsrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/simple-sidebar.css') }}" />


    <link rel="stylesheet" href="{{ URL::asset('css/tempusdominus-bootstrap-4.min.css') }}" />
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <style>
        .navbar {
            border-bottom: 1px solid #0275d8;
        }

        #page-content-wrapper {
            background-color: rgb(219, 223, 227);
        }

        div.card {
            margin: 2%;
        }

        .add-patient {
            color: #0275d8;
        }

        .modal {
            color: red;
        }

        .sub-manage {
            font-size: 13px;
        }

        @media(min-width: 768px) {
            .field-label-responsive {
                padding-top: .5rem;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand text-primary">Patient / Doctor Scheduler</span>
        </nav>
    </header>
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <a href="{{ url('viewSchedule') }}" class="list-group-item list-group-item-action bg-light">Management Schedule</a>
                <div class="list-group-item list-group-item-action bg-light font-weight-bold">Management people</div>
                <a href="{{ url('viewAdd') }}" class="list-group-item list-group-item-action bg-light sub-manage pl-5">Add people</a>
                <a href="{{ url('viewEdit') }}" class="list-group-item list-group-item-action bg-light sub-manage pl-5">Edit people</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="card border-primary mb-3 add-patient">
                <div class="card-header text-primary">
                    Management Schedule
                </div>
                <div class="card-body">
                    <form id="editPatientForm" action="{{url('/editPatient')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="namePatient">Patient</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <select class="form-control" name="namePatient" id="namePatient">
                                            <option value="0">--- please select ---</option>
                                            @if (count($infoP) != 0)
                                            @foreach($infoP as $value)
                                            <option value="{{$value->pa_id}}">{{$value->pa_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"></div>
                                    <label class="font-weight-bold" for="nameDoc">Appointment time</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="datePa">Date</label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <input type="text" disabled class="form-control" id="datePa">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 field-label-responsive">
                                <label for="timePa">Time</label>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <input type="text" disabled class="form-control" id="timePa">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="nameDoc">Doctor</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <select class="form-control" name="nameDoc" id="nameDoc">
                                            <option value="0">--- please select ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 field-label-responsive text-left">
                                <label style="color:black;"><span style="color:red">*</span> Please select patient before doctor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="add" class="btn btn-outline-primary align-right ml-2 float-right">Add</button>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"></div>
                                    <label class="font-weight-bold" for="nameDoc">Search schedule</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="nameDocSearch">Doctor</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <select class="form-control" name="nameDocSearch" id="nameDocSearch">
                                            <option value="0">--- please select ---</option>
                                            @if (count($infoD) != 0)
                                            @foreach($infoD as $value)
                                            <option value="{{$value->doc_id}}">{{$value->doc_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="searchDate">Search date</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <select class="form-control" name="searchDate" id="searchDate">
                                            <option value="0">--- please select ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="search" class="btn btn-outline-primary align-right ml-2 float-right">Search</button>
                            </div>
                        </div>
                        <div class="show-table row" style="display:none;">
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <label class="font-weight-bold">Table time of doctor : <span id="tDocName"></sapn> Date :<span id="tDocDate"></sapn></label>
                                </div>
                            </div>
                        </div>
                        <div class="show-table row" id="table">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="validTime" tabindex="-1" role="dialog" aria-labelledby="validTimeTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
                    </div>
                    <div class="modal-body">
                        <sapn id="msgErr"></sapn>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="checkRemove" tabindex="-1" role="dialog" aria-labelledby="checkRemove" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
                    </div>
                    <div class="modal-body">
                        Confirm! remove patient from schedule?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="confirmRemove" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('js/popper.min.js') }}" crossorigin="anonymous"></script>

<script src="{{ URL::asset('js/bootstrap.min.js') }}"  crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ URL::asset('js/moment.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#namePatient,#nameDoc").change(function() {
            if ($(this).attr('id') == "namePatient") {
                $("#datePa").val('')
                $("#timePa").val('')
                $("#nameDoc").val(0)
            }
            validAdd()
        })

        setHeadTable = (name, date) => {
            $("#tDocName").text(name + ". Date : " + date)
        }

        resetHeadTable = () => {
            $("#tDocName").text('')
            $("#tDocDate").text('')
        }

        validAdd = () => {
            let namePatient = $("#namePatient").val()
            let nameDoc = $("#nameDoc").val()
            if (namePatient != 0 && nameDoc == 0) {
                $.ajax({
                    type: 'POST',
                    url: '/getInfoPatient',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        message: namePatient
                    },
                    success: function(res) {
                        $("#nameDoc > option").each(function(index, ele) {
                            if ($(ele).val() != 0) {
                                $(ele).remove()
                            }
                        })
                        let formatTime = changeFormatTime(res.msg[0].pa_time)
                        $("#datePa").val(formatTime.date)
                        $("#timePa").val(formatTime.time)
                        for (let i = 0; i < (res.list).length; i++) {
                            $('#nameDoc').append(new Option((res.list)[i]['doc_name'], (res.list)[i]['doc_id']))
                        }
                        $(".show-table").hide()
                        $("#table").html('')
                        resetHeadTable()
                    }
                })
            } else if (namePatient == 0 && nameDoc != 0) {
                $("#nameDoc > option").each(function(index, ele) {
                    if ($(ele).val() != 0) {
                        $(ele).remove()
                    }
                })
                $("#datePa").val('')
                $("#timePa").val('')
                $(".show-table").hide()
                $("#table").html('')
                resetHeadTable()
            } else if (namePatient == 0 && nameDoc == 0) {
                $("#nameDoc > option").each(function(index, ele) {
                    if ($(ele).val() != 0) {
                        $(ele).remove()
                    }
                })
                $("#datePa").val('')
                $("#timePa").val('')
                $(".show-table").hide()
                $("#table").html('')
                resetHeadTable()
            } else if (namePatient != 0 && nameDoc != 0) {
                $("#datePa").prop("disabled", false)
                $("#timePa").prop("disabled", false)
                $.ajax({
                    type: 'POST',
                    url: '/changeDoc',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        doc_id: $("#nameDoc").val(),
                        pa_id: $("#namePatient").val(),
                        date: $("#datePa").val(),
                        time: $("#timePa").val(),
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let result = res
                            setHeadTable($("#nameDoc :selected").text(), $("#datePa").val())
                            changeTable(res)
                            $("#datePa").prop("disabled", true)
                            $("#timePa").prop("disabled", true)
                        }
                    }
                })
            }
        }

        changeFormatTime = (time) => {
            let res = {}
            let sptSpace = time.split(" ")
            res['date'] = sptSpace[0]
            let sptColon = (sptSpace[1]).split(":")
            let formatTime = sptSpace[2] == "AM" ? Number(sptColon[0]) : Number(sptColon[0]) + 12
            formatTime = (formatTime.toString()).length == 1 ? "0" + formatTime.toString() : formatTime.toString()
            res['time'] = formatTime + ":" + sptColon[1]
            return res
        }

        $("#add").click(function() {
            let chkAdd = true
            if ($("#namePatient").val() == 0) {
                $('#msgErr').html('Valid! please select patient.')
                $('#validTime').modal('show')
                chkAdd = false
                return false
            } else if ($("#nameDoc").val() == 0) {
                $('#msgErr').html('Valid! please select doctor.')
                $('#validTime').modal('show')
                chkAdd = false
                return false
            }


            let time = $('#timePa').val()
            let chk = false
            $('table > thead > tr > th').each(function(index, ele) {
                if ((($(ele).html()).split(":"))[0] == (time.split(":"))[0]) {
                    chk = true
                }
            })

            if (!chk) {
                $('#msgErr').html('Valid! time is out in table.')
                $('#validTime').modal('show')
                chkAdd = false
                return false
            }

            $('table > thead > tr > th').each(function(index, ele) {
                if ((($(ele).html()).split(":"))[0] == (time.split(":"))[0]) {
                    if ($('table > tbody > tr:nth-child(1) > td:nth-child(' + (index + 1) + ')').text() != "" && $('table > tbody > tr:nth-child(2) > td:nth-child(' + (index + 1) + ')').text() != "") {
                        $('#msgErr').html('Valid! time period is full.')
                        $('#validTime').modal('show')
                        chkAdd = false
                        return false
                    }
                }
            })

            $('table > thead > tr > th').each(function(index, ele) {
                if ((($(ele).html()).split(":"))[0] == (time.split(":"))[0]) {
                    if (($('table > tbody > tr:nth-child(1) > td:nth-child(' + (index + 1) + ')').text()).includes(time) == true || ($('table > tbody > tr:nth-child(2) > td:nth-child(' + (index + 1) + ')').text()).includes(time) == true) {
                        $('#msgErr').html('Valid! time is same.')
                        $('#validTime').modal('show')
                        chkAdd = false
                        return false
                    }
                }
            })

            $("#datePa").prop("disabled", false)
            $("#timePa").prop("disabled", false)
            if (chkAdd) {
                $.ajax({
                    type: 'POST',
                    url: '/addSchedule',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        doc_id: $("#nameDoc").val(),
                        pa_id: $("#namePatient").val(),
                        date: $("#datePa").val(),
                        time: $("#timePa").val(),
                    },
                    success: function(res) {
                        $("#datePa").prop("disabled", true)
                        $("#timePa").prop("disabled", true)
                        if (res.status == 'success') {
                            let result = res
                            $("#namePatient option[value='" + $("#namePatient").val() + "']").remove()
                            $("#datePa").val('')
                            $("#timePa").val('')
                            $("#nameDoc").val("0")
                            changeTable(res)
                        }
                    }
                })
            } else {
                $("#datePa").prop("disabled", true)
                $("#timePa").prop("disabled", true)
            }
        })

        $("#search").click(function() {
            if ($("#nameDocSearch").val() != 0 && $("#searchDate").val() != 0) {
                $.ajax({
                    type: 'POST',
                    url: '/changeDoc',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        doc_id: $("#nameDocSearch").val(),
                        date: $("#searchDate").val()
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let result = res
                            setHeadTable($("#nameDocSearch :selected").text(), $("#searchDate").val())
                            changeTable(res)
                        }
                    }
                })
            } else {
                resetHeadTable()
                $('#msgErr').html('Valid! please select doctor and date.')
                $('#validTime').modal('show')
            }
        })

        $("#nameDocSearch").change(function() {
            if ($(this).val() != 0) {
                $("#searchDate > option").each(function(index, ele) {
                    if ($(ele).val() != 0) {
                        $(ele).remove()
                    }
                })
                $.ajax({
                    type: 'POST',
                    url: '/getPatientOfDoc',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        doc_id: $("#nameDocSearch").val(),
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let result = res.listD
                            result = [...new Set(result.map(a => a.sc_date))]
                            result.sort()
                            for (let i = 0; i < result.length; i++) {
                                $('#searchDate').append(new Option(result[i], result[i]))
                            }
                        }
                    }
                })
            } else {
                $("#searchDate").val(0)
                $("#searchDate > option").each(function(index, ele) {
                    if ($(ele).val() != 0) {
                        $(ele).remove()
                    }
                })
            }
        })

        changeTable = (result) => {
            $(".show-table").show()
            let docTime = result.docTime[0]
            let listPatient = result.schedule
            let table = '<table class="table table-bordered text-center">'
            table += '<thead>'
            table += '<tr>'
            for (let i = Number((docTime.doc_fts).split(":")[0]); i < Number((docTime.doc_fte).split(":")[0]); i++) {
                let head = '<th scope="col">' + ((i.toString()).length == 1 ? "0" + (i.toString()) : i.toString()) + ":00" + '</th>'
                table += head
            }
            for (let i = Number((docTime.doc_sts).split(":")[0]); i < Number((docTime.doc_ste).split(":")[0]); i++) {
                let head = '<th scope="col">' + ((i.toString()).length == 1 ? "0" + (i.toString()) : i.toString()) + ":00" + '</th>'
                table += head
            }
            table += '</tr>'
            table += '</thead>'
            table += '<tbody class="text-left">'
            for (let j = 0; j < 2; j++) {
                table += '<tr>'
                for (let i = 0; i < 8; i++) {
                    table += '<td></td>'
                }
                table += '</tr>'
            }
            table += '</tbody>'
            table += '</table>'
            $("#table").html(table)
            $('table > tbody > tr > td').css("background-color", "#f0fff1")
            $('table > thead > tr > th').each(function(index, ele) {
                let chk = 1
                for (let i = 0; i < listPatient.length; i++) {
                    if (((listPatient[i]['sc_time']).split(":"))[0] == (($(ele).html()).split(":"))[0]) {
                        $('table > tbody > tr:nth-child(' + chk + ') > td:nth-child(' + (index + 1) + ')').append(listPatient[i]['pa_name'] + "(" + listPatient[i]['sc_time'] + ")" + '<button type="button" data-id="' + listPatient[i]['sc_id'] + '" class="btn btn-outline-danger btn-sm float-right" onclick="removePatient(this)">X</button>')
                        $('table > tbody > tr:nth-child(' + chk + ') > td:nth-child(' + (index + 1) + ')').css("background-color", "#FFF1F2");
                        chk++
                    }
                }
            })
        }
    })
    removePatient = (ele) => {
        let id = $(ele).data('id')
        $("#checkRemove").modal('show')
        $("#confirmRemove").click(function() {
            $("#checkRemove").modal('hide')
            $.ajax({
                type: 'POST',
                url: '/delPatientSchedule',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        location.reload()
                    }
                }
            })
        })
    }
</script>

</html>