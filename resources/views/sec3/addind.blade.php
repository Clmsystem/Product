@include('header.menu')
<html>
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
    function addContentToModal(id, name, plan, unit, employee) {
        document.getElementById('indicator_result_ID_edit').value = id;
        document.getElementById('indicator_result_name_edit').value = name;
        document.getElementById('plan_edit').value = plan;
        document.getElementById('unit_edit').value = unit;
        document.getElementById('employee_edit').value = employee;
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
                            <h3 class="newFont"> จัดการตัวชี้วัด </h3>
                            <div class="button-position">
                                <button type="submit" class="btn btn-gradient-primary mr-2 newFont" data-toggle="modal" data-target="#addindicator"><i class="mdi mdi-library-plus"></i> เพิ่มตัวชี้วัด</button>
                            </div>
                            <br>
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
                                                <th class="col-sm-3" scope="col">
                                                    <h7 class="newFont">ตัวชี้วัด</h7>
                                                </th>
                                                <th class="col-sm-2" scope="col">
                                                    <h7 class="newFont">หน่วยนับ</h7>
                                                </th>
                                                <th class="col-sm-1" scope="col">
                                                    <h7 class="newFont">แผนตัวชี้วัด</h7>
                                                </th>
                                                <th class="col-sm-2" scope="col">
                                                    <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                                </th>
                                                <th class="col-sm-3" scope="col">แก้ไข</th>
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
                                            <tr class="d-flex">
                                                <td class="col-sm-1"> <?php echo ($i); ?> </td>
                                                <td class="col-sm-3 break textleft">
                                                    {{$data->indicator_result_name}}
                                                </td>
                                                <td class="col-sm-2 break textleft"> {{$data->unit_name}} </td>
                                                <td class="col-sm-1 break"> {{$data->plan}} </td>
                                                <td class="col-sm-2 break textleft"> {{$data->name_employee}} </td>
                                                <td class="col-sm-3 break"><button class="btn btn-gradient-success newFont" data-toggle="modal" data-target="#editindicator" onclick="addContentToModal({{$data->indicator_result_ID}},'{{$data->indicator_result_name}}','{{$data->plan}}',{{$data->unit}},{{$data->id_employee}});"><i class="mdi mdi-grease-pencil launch-modal"></i></button>
                                                    <button class="btn btn-gradient-danger newFont" data-toggle="modal" data-target="#deleteindicator" onclick="addIdToModal({{$data->indicator_result_ID}});"><i class="mdi mdi-delete launch-modal"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <!-- <div class="col-md-1"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ------------------------------------------  แสดงตัวชี้วัด end-  --------------------------------------------->

                <!-- ------------------------------------------  แก้ไขตัวชี้วัด ---------------------------------------------------->
                <div class="modal fade" id="editindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <br>
                                <h2 class="modal-title newFont" id="exampleModalLabel">แก้ไขตัวชี้วัด</h2>
                                <form class="forms-sample" method="post" action="{{route('sec3updateInd')}}">
                                    @csrf
                                    <hr><br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">หัวข้อ</label>

                                            <input type="hidden" id="indicator_result_ID_edit" name="id">
                                            <input type="text" id="indicator_result_name_edit" class="form-control" placeholder="หัวข้อตัวขี้วัด" name="newresult" required>
                                            <!-- @foreach ($ob as $data)
                                                    <input type="hidden" name="id" value="{{$data->indicator_result_ID}}">
                                                    @endforeach -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">แผนตัวชี้วัด</label>
                                            <input type="text" class="form-control" placeholder="แผนตัวชี้วัด" name="newplan" required id="plan_edit">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="newFont">หน่วยนับ</label>

                                            <!-- <input type="text" class="form-control" placeholder="หน่วยนับ" required> -->
                                            <select class="form-control" name="newunit" id="unit_edit">
                                                <optgroup class="newFont">
                                                    <option value="">เลือกหน่วยนับ</option>
                                                    @foreach ($ob1 as $data1)
                                                    <option value="{{$data1->id_unit}}">{{$data1->unit_name}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="newFont">ผู้รับผิดชอบ</label>
                                            <select class="form-control" name="newemployee" id="employee_edit">
                                                <optgroup class="newFont">
                                                    <option value="">เลือกผู้รับผิดชอบ</option>
                                                    @foreach ($ob2 as $data2)
                                                    <option value="{{$data2->id_employee}}">{{$data2-> name_employee}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-9"></div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <h7 class="newFont">ยกเลิก</h7>
                                            </button>
                                            <input type="submit" value="บันทึก" class="btn btn-primary">
                                        </div>
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
                                <form class="forms-sample" action="{{route('sec3addInd')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">หัวข้อ</label>

                                            <input type="hidden" id="year" name="year" value="{{$yearid}}">

                                            <input type="text" class="form-control" placeholder="หัวข้อตัวขี้วัด" name="resultname" required>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="newFont">แผน</label>
                                            <input type="text" class="form-control" placeholder="แผนตัวชี้วัด" name="plan">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="newFont">หน่วยนับ</label>
                                            <select class="form-control" name="unit">
                                                <optgroup class="newFont">
                                                    <option value="">เลือกหน่วยนับ</option>
                                                    @foreach ($ob1 as $data1)
                                                    <option value="{{$data1->id_unit}}">{{$data1->unit_name}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>


                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="newFont">ผู้รับผิดชอบ</label>
                                            <select class="form-control" name="employee" id="employee">
                                                <optgroup class="newFont">
                                                    <option value="">เลือกผู้รับผิดชอบ</option>
                                                    @foreach ($ob2 as $data2)
                                                    <option value="{{$data2->id_employee}}">{{$data2-> name_employee}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-9"></div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <h7 class="newFont">ยกเลิก</h7>
                                            </button>
                                            <input type="submit" value="บันทึก" class="btn btn-primary">
                                            <!-- <button type="button" class="btn btn-primary" type="submit">
                                                        <h7 class="newFont">บันทึก</h7>
                                                    </button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form class="forms-sample" method="post" action="{{route('sec3deleteInd')}}">
                            <div class="modal-content">

                                @csrf
                                <div class="modal-header">
                                    <h2 class="modal-title newFont">ลบตัวชี้วัด</h2>
                                    <input type="hidden" class="form-control" name="id" id="indicator_result_id">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="newFont">ต้องการลบตัวชี้วัดนี้หรือไม่</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary newFont" data-dismiss="modal">ยกเลิก</button>
                                    <input type="submit" value="ยืนยัน" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
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