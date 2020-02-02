<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Schedule</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/simple-sidebar.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
                <a href="{{ url('viewSchedule') }}"  class="list-group-item list-group-item-action bg-light">Management Schedule</a>
                <div class="list-group-item list-group-item-action bg-light font-weight-bold">Management people</div>
                <a href="{{ url('viewAdd') }}" class="list-group-item list-group-item-action bg-light sub-manage pl-5">Add people</a>
                <a href="{{ url('viewEdit') }}" class="list-group-item list-group-item-action bg-light sub-manage pl-5">Edit people</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="card border-primary mb-3 add-patient">
                <div class="card-header text-primary">
                    Edit Patient
                </div>
                <div class="card-body">
                    <form id="editPatientForm" action="{{url('/editPatient')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="namePatient">Name</label>
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
                                <label for="time">Appointment time</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <div>
                                            <div class="input-group date" id="datePatient" data-target-input="nearest">
                                                <input id="txtDatePatient" name="txtDatePatient" type="text" class="form-control" data-target="#datePatient" required />
                                                <div class="input-group-append" data-target="#datePatient" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="des">Description</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <textarea class="form-control" required placeholder="Disease details..." rows="5" id="des" name="des"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <button type="submit" class="btn btn-outline-warning ml-2 float-right">Update</button>
                        <button type="button" id="delPa" class="btn btn-outline-danger float-right">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card border-primary mb-3 add-patient">
                <div class="card-header text-primary">
                    Edit Doctor
                </div>
                <div class="card-body">
                    <form id="editDocForm" action="{{url('/editDoc')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="nameDoc">Name</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <select class="form-control" name="nameDoc" id="nameDoc">
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
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"></div>
                                    <label class="font-weight-bold" for="nameDoc">Working Time</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="fTimeStart">Fist time start - end</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <div>
                                            <div class="input-group date" id="fTimeStart" data-target-input="nearest">
                                                <input type="text" name="txtFTimeStart" id="txtFTimeStart" class="form-control datetimepicker-input" data-target="#fTimeStart" required />
                                                <div class="input-group-append" data-target="#fTimeStart" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <div>
                                            <div class="input-group date" id="fTimeEnd" data-target-input="nearest">
                                                <input name="txtFTimeEnd" id="txtFTimeEnd" type="text" class="form-control datetimepicker-input" data-target="#fTimeEnd" required />
                                                <div class="input-group-append" data-target="#fTimeEnd" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 field-label-responsive">
                                <label for="sTimeStart">Second time start - end</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <div>
                                            <div class="input-group date" id="sTimeStart" data-target-input="nearest">
                                                <input name="txtSTimeStart" id="txtSTimeStart" type="text" class="form-control datetimepicker-input" data-target="#sTimeStart" required />
                                                <div class="input-group-append" data-target="#sTimeStart" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"></div>
                                        <div>
                                            <div class="input-group date" id="sTimeEnd" data-target-input="nearest">
                                                <input name="txtSTimeEnd" id="txtSTimeEnd" type="text" class="form-control datetimepicker-input" data-target="#sTimeEnd" required />
                                                <div class="input-group-append" data-target="#sTimeEnd" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="editDoc" class="btn btn-outline-warning float-right ml-2">Update</button>
                        <button type="button" id="delDoc" class="btn btn-outline-danger float-right">Delete</button>
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datePatient').datetimepicker({
            stepping: 30
        })
        $('#fTimeStart').datetimepicker({
            format: 'HH:00'
        })
        $('#fTimeEnd').datetimepicker({
            format: 'HH:00',
        })
        $('#sTimeStart').datetimepicker({
            format: 'HH:00'
        })
        $('#sTimeEnd').datetimepicker({
            format: 'HH:00'
        })

        $('#validTime').on('shown.bs.modal', function() {
            $('#validTime').trigger('focus')
        })

        $("#editPatientForm").submit(function() {
            if ($("#namePatient").val() == 0) {
                $('#msgErr').html('Valid! please select patient.')
                $('#validTime').modal('show')
                return false
            }
        })

        $("#editDocForm").submit(function() {

            let fts = $("#txtFTimeStart").val()
            let fte = $("#txtFTimeEnd").val()
            let sts = $("#txtSTimeStart").val()
            let ste = $("#txtSTimeEnd").val()

            fts = Number((fts.split(':'))[0])
            fte = Number((fte.split(':'))[0])
            sts = Number((sts.split(':'))[0])
            ste = Number((ste.split(':'))[0])

            sumF = fte - fts
            sumS = ste - sts

            if ($("#nameDoc").val() == 0) {
                $('#msgErr').html('Valid! please select doctor.')
                $('#validTime').modal('show')
                return false
            } else if (ste < fts || ste < fte || ste < sts || sts < fte || sts < fts || fte < fts) {
                $('#msgErr').html('Valid! format time.')
                $('#validTime').modal('show')
                return false
            } else if (sumF != 4) {
                $('#msgErr').html('Valid! sum first time equal 4 hour.')
                $('#validTime').modal('show')
                return false
            } else if (sumS != 4) {
                $('#msgErr').html('Valid! sum second time equal 4 hour.')
                $('#validTime').modal('show')
                return false
            } else if ((sumF + sumS) != 8) {
                $('#msgErr').html('Valid! sum time equal 8 hour.')
                $('#validTime').modal('show')
                return false
            }
        })

        $("#namePatient").change(function() {
            if ($(this).val() != "0") {
                $.ajax({
                    type: 'POST',
                    url: '/getInfoPatient',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        message: $(this).val()
                    },
                    success: function(res) {
                        let result = res.msg
                        $("#txtDatePatient").val(result[0].pa_time)
                        $("#des").val(result[0].pa_des)
                    }
                })
            } else {
                $("#txtDatePatient").val('')
                $("#des").val('')
            }
        })

        $("#nameDoc").change(function() {
            if ($(this).val() != "0") {
                $.ajax({
                    type: 'POST',
                    url: '/getInfoDoc',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        message: $(this).val()
                    },
                    success: function(res) {
                        let result = res.msg
                        $("#txtFTimeStart").val(result[0].doc_fts)
                        $("#txtFTimeEnd").val(result[0].doc_fte)
                        $("#txtSTimeStart").val(result[0].doc_sts)
                        $("#txtSTimeEnd").val(result[0].doc_ste)
                    }
                })
            } else {
                $("#txtFTimeStart").val('')
                $("#txtFTimeEnd").val('')
                $("#txtSTimeStart").val('')
                $("#txtSTimeEnd").val('')
            }
        })

        $("#delPa").click(function() {
            if ($("#namePatient").val() == 0) {
                $('#msgErr').html('Valid! please select patient.')
                $('#validTime').modal('show')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/delPatient',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        message: $("#namePatient").val()
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            location.reload()
                        }
                    }
                })
            }
        })

        $("#delDoc").click(function() {
            if ($("#nameDoc").val() == 0) {
                $('#msgErr').html('Valid! please select doctor.')
                $('#validTime').modal('show')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/delDoc',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        message: $("#nameDoc").val()
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            location.reload()
                        }
                    }
                })
            }
        })
    })
</script>

</html>