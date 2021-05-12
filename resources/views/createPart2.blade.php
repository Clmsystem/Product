@include('header.menu')
<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

/* adjust font this page */
.newFont {
    font-family: 'Mitr', sans-serif;
}

/* adjust btn position */
.button-position {
    float: right;
    margin: -8px;
}

/* adjust btn size */
.btns {
    padding: 0.9rem 2em;
    font-size: 0.875rem;
}

/* adjust text position */
td {
    text-align: center;
}

.tdleft {
    text-align: left;
}

th {
    text-align: center;
}

td.break {
    word-wrap: break-word;
    word-break: break-all;
    white-space: normal;
}

th.break {
    word-wrap: break-word;
    word-break: break-all;
    white-space: normal;
}
</style>

<body>
    <!-- ------------------------------------------  include  --------------------------------------------->
    @include('partials.navbar')
    @include('partials.sidebar')
    <!-- ------------------------------------------  include  --------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="newFont"> ส่วนที่ 2 ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน (9 ข้อ) จาก ทมอ. </h3>
            </div>
            <!-- ------------------------------------------  สร้างตัวชี้วัด Start-  --------------------------------------------->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">สร้างตัวชี้วัด </h3>
                        <br>
                        <hr>
                        <br>
                        <form method="post" action="{{route('insert_indicator')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="newFont">หัวข้อ</label>
                                    @foreach($year as $year )
                                    <input type="hidden" name="year" value="{{$year->year_id}}">
                                    @endforeach
                                    <input type="text" name="indtcator_name" id="indtcator_name"
                                        class="form-control newFont" placeholder="หัวข้อตัวขี้วัด" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">คะแนนเต็ม</label>
                                    <input type="textnumber" name="fullscore" id="fullscore"
                                        class="form-control newFont" placeholder="ตัวเลข" value="" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="newFont" name="month">ประเภทการกรอก</label>
                                    <select class="form-control newFont" name="type" id="type">
                                        <optgroup class="newFont" label="เลือกประเภทการกรอก">
                                            <option disabled selected hidden>เลือกประเภทการกรอก</option>
                                            <option value="1">รายเดือน</option>
                                            <option value="0">รายปี</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="newFont">ผู้รับผิดชอบ</label>
                                    <select class="form-control newFont" name="employ" id="employ">
                                        <optgroup class="newFont" label="เลือกผู้รับผิดชอบ">
                                            <option disabled selected hidden>เลือกผู้รับผิดชอบ</option>
                                            @foreach($getEmployee as $i => $value)
                                            <option class="newFont" value="{{$value->id_employee}}">
                                                {{$value->name_employee}}
                                            </option>
                                            <!-- <option value="1">พัชรินทร์  ภาวิกานนท์ </option>
                                    <option value="5">เกษมาพร  ตัญบุญยกิจ</option>
                                    <option value="">จารุพันธุ์ พรุเพ็ชรแก้ว</option>
                                    <option value="">ธวัชชัย  ประดู่</option>
                                    <option value="">ชัชวาล  นาคพันธุ์</option>
                                    <option value="">ธันฐภัทร์  ดวงจันทร์</option>
                                    <option value="">อมราพร ชุมชนะ</option>
                                    <option value="">อาภรณ์ ไชยสุวรรณ</option> -->
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-9"></div>
                                <div class="form-group col-md-3">
                                    <div class="button-position">
                                        <button type="submit"
                                            class="btn btn-gradient-primary mr-2 newFont">เพิ่มตัวชี้วัด</button>
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
                        <h3 class="newFont">ตัวชี้วัดปีงบประมาณปัจจุบัน</h3>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <!-- <div class="col-md-1"></div> -->
                            <div class="col-md-12">
                                <table class="table table-bordered newFont break ">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-5 break" scope="col">
                                                <h7 class="newFont">ตัวชี้วัด</h7>
                                            </th>
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">คะแนนเต็ม</h7>
                                            </th>
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">ประเภทการกรอก</h7>
                                            </th>
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                            </th>
                                            <th class="col-sm-1 break" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <!-- ---------------------------------------------------------------------------------------------------------------------
                              --------------------------------------------- เดือน ------------------------------------------------------------------
                              --------------------------------------------------------------------------------------------------------------------- -->
                                    <tbody>
                                        @foreach($shindicator_month as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-5 tdleft break"> {{$value->indicator_name}} </td>
                                            <td class="col-sm-2 break"> {{$value->full_score}} </td>
                                            @if ($value->indicator_type == 0)
                                            <td class="col-sm-2 break">รายปี</td>
                                            @elseif ($value->indicator_type ==1 )
                                            <td class="col-sm-2 break">รายเดือน</td>
                                            @endif
                                            <td class="col-sm-2 tdleft break"> {{$value->name_employee}} </td>
                                            <!-- <td class="col-sm-1 break"><button class="btn btn-warning  btn-sm" data-toggle="modal" data-target="#modalAction"><i class="mdi mdi-grease-pencil launch-modal"></i></button>
                                    </td> -->
                                            <td class="col-sm-1 break">
                                                <button class="btn btn-gradient-warning  btn-sm" data-toggle="modal"
                                                    data-target="#modalAction1{{$i}}"><i
                                                        class="mdi mdi-grease-pencil launch-modal"></i></button>
                                                <div class="modal fade" id="modalAction1{{ $i }}" tabindex="-1"
                                                    role="dialog" data-backdrop="static"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <br>
                                                                <h2 class="modal-title newFont" id="exampleModalLabel">
                                                                    แก้ไขตัวชี้วัด
                                                                </h2>
                                                                <!-- -------------------- FROM ------------------------- -->
                                                                <form action="{{ route('updateCreate') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <!-- @method('PUT') -->
                                                                    <hr>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-5 tdleft ">
                                                                            <label class="newFont">หัวข้อ</label>
                                                                            <input type="text"
                                                                                class="form-control newFont"
                                                                                id="edit_indicator_name"
                                                                                name="edit_indicator_name"
                                                                                value="{{$value->indicator_name}}"
                                                                                required>
                                                                            <input type="hidden"
                                                                                name="edit_indicator_id"
                                                                                id="edit_indicator_id"
                                                                                value="{{$value->indicator_id}}">
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label class="newFont">คะแนนเต็ม</label>
                                                                            <input type="text"
                                                                                class="form-control newFont"
                                                                                id="edit_fullscore"
                                                                                name="edit_fullscore"
                                                                                value="{{$value->full_score}}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label class="newFont">ประเภทการกรอก</label>
                                                                            <select name="edit_indicator_type"
                                                                                id="edit_indicator_type"
                                                                                class="form-control newFont "
                                                                                value="{{$value->indicator_type}}"
                                                                                style="color:black" readonly>




                                                                                <optgroup class="newFont" readonly
                                                                                    label="เลือกประเภทการกรอก">
                                                                                    <option
                                                                                        value="{{$value->indicator_type}}">
                                                                                        @if ($value->indicator_type ==
                                                                                        0)
                                                                                        รายปี
                                                                                        @elseif ($value->indicator_type
                                                                                        ==1 )
                                                                                        รายเดือน
                                                                                        @endif</option>
                                                                                    <option value="1" disabled>รายเดือน
                                                                                    </option>
                                                                                    <option value="0" disabled>รายปี
                                                                                    </option>
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-3 tdleft ">
                                                                            <label class="newFont">ผู้รับผิดชอบ</label>
                                                                            <select name="edit_employ" id="edit_employ"
                                                                                class="form-control newFont"
                                                                                style="color:black">
                                                                                <optgroup class="newFont"
                                                                                    label="เลือกผู้รับผิดชอบ">
                                                                                    <option
                                                                                        value="{{$value->id_employee}}">
                                                                                        {{$value->name_employee}}
                                                                                    </option>
                                                                                    @foreach($getEmployee as $i =>
                                                                                    $value)
                                                                                    <option
                                                                                        value="{{$value->id_employee}}">
                                                                                        {{$value->name_employee}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-gradient-danger newFont  "
                                                                            data-dismiss="modal">
                                                                            <h7 class="newFont">
                                                                                ยกเลิก</ย>
                                                                        </button>
                                                                        <button type="submit"
                                                                            class="btn btn-gradient-primary newFont ">
                                                                            <h7 class="newFont">บันทึก</h7>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
            <!--------------------------------------------  แสดงตัวชี้วัด end   --------------------------------------------------->
            <!--------------------------------------------  แก้ไขตัวชี้วัด Start ---------------------------------------------------->
        </div>
    </div>
    </div>
    </div>
</body>