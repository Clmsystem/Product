@include('partials.header')
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
        word-break: break-all;
        white-space: normal;
    }


    th {
        text-align: center;
    }
</style>
<!-- ------------------------------------------  Link Script Jquery-  --------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<body>
    <!-- ------------------------------------------  include  --------------------------------------------->

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('partials.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('partials.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="container-fluid content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="page-header">
                                <h3 class="newFont">ส่วนที่ 4 ผลการดำเนินงานตามตัวชี้วัดยุทธศาสตร์ ประจำปีงบประมาณ {{$year}}</h3>
                            </div>
                        </div>

                        <!-- ค้นหาตัวชี้วัด -->
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <h3 class="newFont"> ค้นหาข้อมูลตัวชี้วัด </h3>
                                <br>
                                <div class="card-body">
                                    <form action="{{route('resultsearchmountsec4')}}" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <label class="newFont">ค้นหา</label>
                                            <div class="col-sm-3">
                                                <select id="client_id" type="dropdown-toggle" class="form-control" name="year">
                                                    <optgroup>
                                                        @foreach ($yearselect as $yearselect)
                                                        <option value="{{$yearselect->year}}" {{ $year == "{$yearselect->year}" ? 'selected' : '' }}>{{$yearselect->year}}</option>
                                                        @endforeach

                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">

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
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="submit" value="ค้นหา" class="btn btn-gradient-primary newFont">
                                            </div>

                                            <!-- <div class="col-sm-3">
                                            <select class="form-control">
                                                <optgroup class="newFont">
                                                    <option>เดือน</option>
                                                    <option>มกราคม</option>
                                                    <option>กุมภาพันธ์</option>
                                                    <option>มีนาคม</option>
                                                    <option>เมษายน</option>
                                                    <option>พฤษภาคม</option>
                                                    <option>มิถุนายน</option>
                                                    <option>กรกฎาคม</option>
                                                    <option>สิงหาคม</option>
                                                    <option>กันยายน</option>
                                                    <option>ตุลาคม </option>
                                                    <option>พฤศจิกายน</option>
                                                    <option>ธันวาคม</option>
                                                </optgroup>
                                            </select>
                                        </div> -->
                                            <!-- <div class="col-sm-3">
                                            <button class="btn btn-gradient-primary newFont" data-toggle="modal" data-target=""><i class="mdi mdi-account-search-outline"></i></button>
                                        </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ข้อมูลตัวชี้วัด -->
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <h3 class="newFont"> ข้อมูลผลการดำเนินงานย้อนหลัง ส่วนที่4 </h3>
                                    </div>
                                    <div class="button-position">
                                        <form action="{{route('downloadsec4')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="year" name="year" value="{{$year}}">
                                            <input type="hidden" id="mount" name="mount" value="{{$mount}}">
                                            <button type="submit" name="btn_download" id="btn_download" value="1" class="btn btn-inverse-danger btns2 ">ดาวน์โหลด csv</button>
                                        </form>
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
                                                        <th class="col-sm-4" scope="col">
                                                            <h7 class="newFont">ตัวชี้วัดตามคำรับรอง</h7>
                                                        </th>
                                                        <th class="col-sm-3" scope="col">
                                                            <h7 class="newFont">เป้าหมายตามคำรับรอง</h7>
                                                        </th>
                                                        <th class="col-sm-2" scope="col">
                                                            <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                                        </th>

                                                    </tr>
                                                </thead>


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
                                                        <td class="col-sm-4 break textleft">
                                                            {{$data->indicator_stratetegic_name}}
                                                        </td>
                                                        <td class="col-sm-3 break textleft"> ร้อยละ 85 </td>
                                                        <td class="col-sm-2"> อาภรณ์ </td>
                                                        <td class="col-sm-2">
                                                            <button class="btn btn-gradient-info newFont" data-toggle="modal" data-target="#infoindicator"><i class="mdi mdi-chart-areaspline"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                            <!-- <div class="col-md-1"></div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ------------------------------------------  แสดงตัวชี้วัด end-  --------------------------------------------->

                        <!-- ------------------------------------------  แสดงข้อมูลตัวชี้วัด ---------------------------------------------------->
                        <div class="modal fade" id="infoindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <br>
                                        <h2 class="modal-title newFont" id="exampleModalLabel">ข้อมูลตัวชี้วัด</h2>
                                        <form class="forms-sample">
                                            <hr><br>
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label class="newFont">ตัวชี้วัด</label>
                                                    <input type="text" class="form-control" placeholder="ตัวชี้วัด" value="" required>
                                                </div>
                                                <div class="form-group col-md-2">
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
                                                <div class="form-group col-md-2">
                                                    <label class="newFont">หน่วยนับ</label>
                                                    <input type="text" class="form-control" placeholder="หน่วยนับ" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            <h7 class="newFont">ยกเลิก</ย>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <h7 class="newFont">บันทึก</h7>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ดาวน์โหลดตัวชี้วัด -->
                        <div class="modal fade" id="downloadindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title newFont">ดาวน์โหลดตัวชี้วัด</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="newFont">ต้องการดาวน์โหลดตัวชี้วัดนี้หรือไม่</p>
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