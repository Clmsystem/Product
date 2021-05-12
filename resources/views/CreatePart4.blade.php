@include('header.menu')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

    /* adjust font this page */
    .newFont {
        font-family: 'Mitr', sans-serif;
    }

    .newFonts {
        font-family: 'Mitr', sans-serif;
        font-size: 50px !important;
    }


    .dropdown .dropdown-menu .dropdown-item {
        font-size: 0.8rem;
        padding: 0;
    }

    /* adjust btn position */
    .button-position {
        float: right;
        margin: -8px;
    }



    td.break {
        word-wrap: break-word;
        /* word-break: break-all; */
        white-space: normal;
    }
    td.break1 {
        word-wrap: break-word;
        /* white-space: inherit;     */
    }

    td.break2 {
        word-wrap: break-word;
        /* word-break: break-all; */
        white-space: pre-line;

        display: block
    }

    /* adjust btn size */
    .btns {
        align-items: center;
        padding: 0.9rem 2em;
        font-size: 0.875rem;
      
    }
    table{

    }
    .text-t {
        margin: 0;
        padding: 0;
    }
</style>

<?php

use Illuminate\Support\Facades\Session;
?>

<body>
    <!-- ------------------------------------------  include  --------------------------------------------->

    @include('partials.navbar')
    @include('partials.sidebar')
    <!-- ------------------------------------------  include  --------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="newFont"> ฝ่ายส่งเสริมการเรียนรู้และให้บริการการศึกษา ศูนย์บรรณสารและสื่อการศึกษา </h3>
            </div>

            <!-- ------------------------------------------  สร้างตัวชี้วัด Start-  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">สร้างตัวชี้วัด</h3><br>
                        <hr><br>
                        <form class="forms-sample" action="/createpart4/store" method="post">
                            @csrf
                            <div class="row form-group">
                                <div class="form-group col-md-7">
                                    <label class="newFont">หัวข้อ</label>
                                    <input type="text" name="indicator_list" id="indicator_list" class="form-control" placeholder="หัวข้อตัวขี้วัด" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="newFont">หน่วยนับ</label>
                                    <select class="form-control" name="unit" id="unit">
                                        <optgroup class="newFont">
                                            @foreach ($units as $i => $value)
                                            <option value="{{ $value->id_unit }}">{{ $value->unit_name }}
                                            </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">เป้าหมาย</label>
                                    <input type="text" class="form-control" placeholder="จำนวน/หน่วยนับ" value="" required>
                                </div>
                                <div class="form-group col-md-9"></div>
                                <div class="form-group col-md-3">
                                    <div class="button-position">
                                        <button type="submit" class="btn btn-gradient-primary mr-2 newFont">เพิ่มตัวชี้วัด</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ------------------------------------------  สร้างตัวชี้วัด end-  --------------------------------------------->

            <!-- ------------------------------------------  แสดงตัวชี้วัด end-  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ตัวชี้วัดปัจจุบัน</h3><br>
                        <hr><br>
                        <div class="row">
                            <!-- <div class="col-md-1"></div> -->
                            <div class="table-responsive">
                            <div class="col-md-12">
                                <table class="table table-bordered newFont">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-1 break" scope="col">
                                                <h7 class="newFont  break">ลำดับ</h7>
                                            </th>
                                            <th class="col-sm-5 break" scope="col">
                                                <h7 class="newFont break">ตัวชี้วัด</h7>
                                            </th>
                                            <th class="col-sm-3 break" scope="col">
                                                <h7 class="newFont break">ผู้รับผิดชอบ</h7>
                                            </th>
                                            {{-- <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">จำนวน</h7>
                                            </th> --}}
                                            <th class="col-sm-1 break" scope="col">
                                                <h7 class="newFont break">หน่วยนับ</h7>
                                            </th>
                                            <th class="col-sm-2 break" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function spliteName($name)
                                        {
                                            $text = '';
                                            $texts = explode(",", $name);
                                            for ($i = 0; $i < count($texts); $i++) {
                                                $text .= '<p class="text-t">' . $texts[$i] . '</p>';
                                            }
                                            return $text;
                                        }
                                        ?>
                                        @foreach ($list_item as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-1 break">{{ $i + 1 }} </td>
                                            <td class="col-sm-5 break">{{ $value->name_item }} </td>
                                            <!-- <td class="col-sm-2 break2"> {{ $value->name_employee  }}</td> -->
                                            <td class="col-sm-3 break">
                                                <?= spliteName($value->name_employee) ?>
                                            </td>
                                            <td class="col-sm-1 "> {{ $value->unit_name }} </td>
                                            <td class="col-sm-2 break1">
                                                <button class="btn btn-inverse-success btns" data-toggle="modal" data-target="#modalAction{{ $i }}"><i class="mdi mdi-grease-pencil launch-modal"></i></button>
                                                <button class="btn btn-inverse-danger btns" data-toggle="modal" data-target="#modalDelete{{ $i }}"><i class="mdi mdi-delete"></i></button>

                                                <!--------------------------------------------  แสดงตัวชี้วัด end   --------------------------------------------------->

                                                <!--------------------------------------------  แก้ไขตัวชี้วัด Start ---------------------------------------------------->

                                                <div class="modal fade" id="modalDelete{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3 class="modal-title newFont" id="exampleModalLabel1">
                                                                    ลบตัวชี้วัด</h3>
                                                                <hr>
                                                                <h5 class="newFont">
                                                                    ยืนยันที่จะลบตัวชี้วัดหรือไม่ ?
                                                                </h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">Close</button>

                                                                <form class="forms-sample" action="/createpart4/delete" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-gradient-danger" name="del" id="del" value="{{ $value->id_item }}">Delete</button>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="modalAction{{ $i }}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <br>
                                                                <h2 class="modal-title newFont" id="exampleModalLabel">
                                                                    แก้ไขตัวชี้วัด</h2>
                                                                <!-- -------------------- FROM ------------------------- -->
                                                                <form class="forms-sample" action="{{ route('createpart4.update', $value->id_item) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <hr><br>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label class="newFont">หัวข้อ</label>
                                                                            <input name="value_of_item" id="value_of_item" type="text" value="{{ $value->id_item }}" hidden>
                                                                            <input type="text" class="form-control" name="indicator_list" id="indicator_list" placeholder="หัวข้อตัวขี้วัด" value="{{ $value->name_item }}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="newFont">ผู้รับผิดชอบ</label><br>
                                                                            <select name="employee[]" id="employee" class="selectpicker newFont" multiple data-live-search="true">
                                                                                <optgroup class="newFont" label="ทีมดูแลเพจ">
                                                                                    <?php
                                                                                    $empArr = explode(',', $value->name_employee);
                                                                                    ?>
                                                                                    @foreach ($employee as $i => $value)
                                                                                    <option value="{{ $value->id_employee }}" <?php foreach ($empArr as $data) {
                                                                                                                                    if ($data == $value->name_employee) {
                                                                                                                                        echo "selected";
                                                                                                                                    }
                                                                                                                                } ?>>{{ $value->name_employee }}</option>
                                                                                    @endforeach
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="newFont">หน่วยนับ</label><br>
                                                                            <div class="col-xs-2">
                                                                                <select class="form-control " name="unit" id="unit" style="width:auto;">
                                                                                    <optgroup class="newFont" label="หน่วยนับ">
                                                                                        @foreach ($units as $i => $value)
                                                                                        <option value="{{ $value->id_unit }}">{{ $value->unit_name }}</option>
                                                                                        @endforeach
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            <h7 class="newFont">ยกเลิก</h7>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <h7 class="newFont">บันทึก</h7>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                                <!-- ===================== END From  ======================== -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
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
            </div>



        </div>
        @include('partials.footer')
    </div>
    <!-- Div nav & side -->
    <!-- </div> -->
    <!-- </div>
    </div> -->

</body>

<script>
    $(() => {
        $('select').selectpicker();

        $('#empid').change(() => {
            console.log($('#empid').val());
        });

        $('#btn_test').click(() => {
            console.log("tet")
        });
        document.getElementById("value_of_item").style.visibility = "hidden";
    });

    var msg = '<?= Session::get('alert') ?>';
    var exist = '<?= Session::has('alert') ?>';
    if (exist) {
        alert(msg);
    }
</script>