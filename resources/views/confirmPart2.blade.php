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

th {
    text-align: center;
}

.tdleft {
    text-align: left;
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
                <h3 class="newFont"><i class="mdi mdi-arrow-right-drop-circle-outline"></i> ส่วนที่ 2
                    ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน (9 ข้อ) จาก ทมอ. </h3>
            </div>

            <!-- ------------------------------------------  ค้นหาตัวชี้วัด Start-  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ยืนยันข้อมูล (ตัวชี้วัดรายเดือน) ประจำปีงบประมาณ {{$YearShow}}</h3>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <!-- <label class="newFont">เดือน</label> -->
                                <label class="newFont">เดือน</label>
                                <form action="{{route('confirm_month')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <select id="client_id" type="dropdown-toggle" class="form-control newFont"
                                        name="month">
                                        <optgroup class="newFont">
                                            <option disabled selected hidden>เลือกเดือน</option>
                                            <option value="10" {{ $month == 10 ? 'selected' : '' }}>ตุลาคม</option>
                                            <option value="11" {{ $month == 11 ? 'selected' : '' }}>พฤศจิกายน</option>
                                            <option value="12" {{ $month == 12 ? 'selected' : '' }}>ธันวาคม</option>
                                            <option value="1" {{ $month == 1 ? 'selected' : '' }}>มกราคม</option>
                                            <option value="2" {{ $month == 2 ? 'selected' : '' }}>กุมภาพันธ์</option>
                                            <option value="3" {{ $month == 3 ? 'selected' : '' }}>มีนาคม</option>
                                            <option value="4" {{ $month == 4 ? 'selected' : '' }}>เมษายน</option>
                                            <option value="5" {{ $month == 5 ? 'selected' : '' }}>พฤษภาคม</option>
                                            <option value="6" {{ $month == 6 ? 'selected' : '' }}>มิถุนายน</option>
                                            <option value="7" {{ $month == 7 ? 'selected' : '' }}>กรกฎาคม</option>
                                            <option value="8" {{ $month == 8 ? 'selected' : '' }}>สิงหาคม</option>
                                            <option value="9" {{ $month == 9 ? 'selected' : '' }}>กันยายน</option>
                                        </optgroup>
                                    </select>
                            </div>
                            </form>
                            <hr>

                            <div class="col-md-12">
                                <hr>
                                <table class="table table-bordered newFont">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-5 break" scope="col">
                                                <h7 class="newFont">หัวข้อ</h7>
                                            </th>

                                            <th class="col-sm-1 " scope="col">
                                                <h7 class="newFont">คะแนนเต็ม</h7>
                                            </th>
                                            <th class="col-sm-1 break" scope="col">
                                                <h7 class="newFont">ผล</h7><br><br>
                                            </th>
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">ร้อยละผลสำเร็จ</h7>
                                            </th>
                                            <th class="col-sm-1 " scope="col">
                                                <h7 class="newFont">คะแนนที่ได้</h7>
                                            </th>
                                            <th class="col-sm-2 " scope="col">
                                                <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indicator_month as $i => $item)
                                        <tr class="d-flex">
                                            <td class="col-sm-5 tdleft break"> {{$item->indicator_name}} </td>
                                            <td class="col-sm-1"> {{$item->full_score}} </td>
                                            <td class="col-sm-1 break">{{$item->result}}</td>
                                            <td class="col-sm-2"> {{$item->percent}} </td>
                                            <td class="col-sm-1"> {{$item->score}}</td>
                                            <td class="col-sm-2 tdleft"> {{$item->name_employee}} </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- <div class="col-md-1"></div> -->
                            </div>
                            <div class="form-group col-md-12"></div>
                            <div class="form-group col-md-12">
                                <form action="{{route('unlogPart2')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="button-position">
                                        <input type="hidden" value="{{$month}}" name="monthselect" id="monthselect">
                                        <button type="submit" data-toggle="modal"
                                            class="btn btn-gradient-danger mr-4 newFont"><i
                                                class="mdi mdi-lock-open-outline"></i> ยกเลิก</button>
                                    </div>
                                </form>
                                <form action="{{route('logPart2')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="button-position">
                                        <input type="hidden" value="{{$month}}" name="monthselect" id="monthselect">
                                        <button type="submit" data-toggle="modal"
                                            class="btn btn-gradient-primary mr-4 newFont"><i
                                                class="mdi mdi-lock-outline"></i> ยืนยันข้อมูล</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
        <!-- Div nav & side -->
    </div>
    </div>
    </div>

</body>
<script>
var select = document.getElementById('client_id');
select.addEventListener('change', function() {
    this.form.submit();
}, false);
</script>