@include('header.menu')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

    .newFont {
        font-family: 'Mitr', sans-serif;
    }

    .button-position {
        float: right;
        margin: -8px;
    }

    .btns {
        padding: 0.9rem 2em;
        font-size: 0.875rem;
    }

    td {
        text-align: center;
    }

    .textleft {
        text-align: left;
    }

    .textright {
        text-align: right;
    }

    td.break {
        word-wrap: break-word;
        /* word-break: break-all; */
        white-space: normal;
    }

    th {
        text-align: center;
    }
</style>
<!-- ------------------------------------------  Link Script Jquery-  --------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function ModalEditData(id, name, result, performance) {
        document.getElementById('result_ID_edit').value = id;
        document.getElementById('result_name_edit').value = name;
        document.getElementById('result_plan_edit').value = plan;
        document.getElementById('result_unit_edit').value = unit;
        document.getElementById('result_edit').value = result;
        document.getElementById('performance_result_edit').value = performance;
    };
</script>
<?php

use Illuminate\Support\Facades\Session;
?>

<body>
    <!-- ------------------------------------------  include  --------------------------------------------->

    @include('partials.navbar')
    @include('partials.sidebar')
    <!-- partial -->
    <div class="main-panel">
        <div class="container-fluid content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="page-header">
                        <h3 class="newFont">ส่วนที่ 3 ตัวชี้วัดผลการปฏิบัติงานตามภารกิจของหน่วยงาน ประจำปีงบประมาณ {{$years}}</h3>
                    </div>
                </div>

                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="from-group row">
                                    <h3 class="col-md-10 newFont"> ยืนยันตัวชี้วัด
                                    </h3>
                                    <div class="col-md-2 form-group">
                                        <form action="{{route('confirmresultmountsec3')}}" method="POST">
                                            @csrf
                                            <select id="client_id" type="dropdown-toggle" class="form-control" name="mount">
                                                <optgroup>
                                                    <option value="1" {{ $mount == 1 ? 'selected' : '' }}>มกราคม</option>
                                                    <option value="2" {{ $mount == 2 ? 'selected' : '' }}>กุมภาพันธ์</option>
                                                    <option value="3" {{ $mount == 3 ? 'selected' : '' }}>มีนาคม</option>
                                                    <option value="4" {{ $mount == 4 ? 'selected' : '' }}>เมษายน</option>
                                                    <option value="5" {{ $mount == 5 ? 'selected' : '' }}>พฤษภาคม</option>
                                                    <option value="6" {{ $mount == 6 ? 'selected' : '' }}>มิถุนายน</option>
                                                    <option value="7" {{ $mount == 7 ? 'selected' : '' }}>กรกฎาคม</option>
                                                    <option value="8" {{ $mount == 8 ? 'selected' : '' }}>สิงหาคม</option>
                                                    <option value="9" {{ $mount == 9 ? 'selected' : '' }}>กันยายน</option>
                                                    <option value="10" {{ $mount == 10 ? 'selected' : '' }}>ตุลาคม</option>
                                                    <option value="11" {{ $mount == 11 ? 'selected' : '' }}>พฤศจิกายน</option>
                                                    <option value="12" {{ $mount == 12 ? 'selected' : '' }}>ธันวาคม</option>
                                                </optgroup>
                                            </select>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <!-- <div class="col-md-1"></div> -->
                                <div class="col-md-12">
                                    <table class="table table-bordered newFont">
                                        <thead>
                                            <tr class="d-flex">
                                                <th class="col-sm-1" scope="col">
                                                    <h7 class="newFont">ลำดับ</h7>
                                                </th>
                                                <th class="col-sm-5" scope="col">
                                                    <h7 class="newFont">ตัวชี้วัด</h7>
                                                </th>
                                                <th class="col-sm-2" scope="col">
                                                    <h7 class="newFont">หน่วยนับ</h7>
                                                </th>
                                                <th class="col-sm-1" scope="col">
                                                    <h7 class="newFont">แผนตัวชี้วัด</h7>
                                                </th>
                                                <th class="col-sm-3" scope="col">
                                                    <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                                </th>
                                                <!-- <th class="col-sm-2" scope="col"></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            ?>
                                            @foreach ($ob as $data)
                                            <?php
                                            $i += 1;
                                            ?>
                                        <tbody>
                                            <tr class="d-flex">
                                                <td class="col-sm-1 "> <?php echo ($i); ?> </td>
                                                <td class="col-sm-5 break textleft">
                                                    {{$data->indicator_result_name}}
                                                </td>
                                                <td class="col-sm-2 break textleft"> {{$data->unit_name}} </td>
                                                <td class="col-sm-1 break"> {{$data->plan}} </td>
                                                <td class="col-sm-3 break textleft"> {{$data->name_employee}} </td>
                                                <!-- <td class="col-sm-2"><button
                                                                class="btn btn-gradient-success newFont"
                                                                data-toggle="modal" data-target="#confirmindicator"
                                                                onclick="addContentToModal('{{$data->indicator_result_ID}}','{{$data->indicator_result_name}}');">ยืนยัน</button> -->
                                            </tr>

                                            @endforeach
                                        </tbody>

                                    </table>
                                    <br>
                                    @if (count($status)>0)
                                    <form action="{{route('sec3confirmindicator')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="button-position">
                                            <input type="hidden" value="{{$mount}}" name="lockmount" id="lockmount">
                                            <button type="submit" data-toggle="modal" class="btn btn-gradient-primary mr-4 newFont">ยืนยัน</button>
                                        </div>
                                    </form>
                                    @else
                                    <form action="{{route('sec3unconfirmindicator')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="button-position">
                                            <input type="hidden" value="{{$mount}}" name="lockmount" id="lockmount">
                                            <button type="submit" data-toggle="modal" class="btn btn-gradient-secondary mr-4 newFont">ยกเลิก</button>
                                        </div>
                                    </form>
                                    @endif

                                    <!-- <div class="col-md-1"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ------------------------------------------  แสดงตัวชี้วัด end-  --------------------------------------------->

                <!-- ------------------------------------------  ยืนยันตัวชี้วัด  ---------------------------------------------------->
                <div class="modal fade" id="confirmindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <br>
                                <h2 class="modal-title newFont" id="exampleModalLabel">ยืนยันตัวชี้วัด</h2>
                                <form class="forms-sample">
                                    <hr><br>
                                    <h5 class="newFont" id="exampleModalLabel">
                                        หากทำการยืนยันแล้วจะไม่สามารถแก้ไขข้อมูลได้อีก</h5>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <label class="newFont">หัวข้อ</label>
                                        <input type="hidden" id="indicator_result_ID" name="id">
                                        <input type="text" id="indicator_result_name" class="form-control" placeholder="หัวข้อตัวขี้วัด" name="newresult" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            <h7 class="newFont">ยกเลิก</h7>
                                        </button>
                                        <input type="submit" value="บันทึก" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <br>
                                <h2 class="newFont">สร้างตัวชี้วัด</h2><br>
                                <hr><br>
                                <form class="forms-sample">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">หัวข้อ</label>
                                            <input type="text" class="form-control" placeholder="หัวข้อตัวขี้วัด" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">แผน</label>
                                            <input type="text" class="form-control" placeholder="แผนตัวชี้วัด" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="newFont">หน่วยนับ</label>

                                            <input type="text" class="form-control" placeholder="หน่วยนับ" required>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="newFont">ผู้รับผิดชอบ</label>
                                            <select class="form-control">
                                                <optgroup class="newFont">
                                                    <option>เลือกผู้รับผิดชอบ</option>
                                                    <option>ทีมดูแลเพจ</option>
                                                    <option>เกษมาพร</option>
                                                    <option>ปรีชา</option>
                                                    <option>อาภรณ์</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-9"></div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <h7 class="newFont">ยกเลิก</h7>
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                <h7 class="newFont">บันทึก</h7>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title newFont">ลบตัวชี้วัด</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="newFont">ต้องการลบตัวชี้วัดนี้หรือไม่</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary newFont" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" class="btn btn-primary newFont">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('partials.footer')
        </div>
    </div>

    </div>
    </div>
    <!-- Div nav & side -->
    </div>
</body>

<script type="text/javascript">
    var select = document.getElementById('client_id');
    select.addEventListener('change', function() {
        this.form.submit();
    }, false);
</script>
<script>
    function addIdToModal(id) {
        document.getElementById('indicator_result_id').value = id;
    };
    var msg = '<?= Session::get('alert') ?>';
    var exist = '<?= Session::has('alert') ?>';
    if (exist) {
        alert(msg);
    }
</script>