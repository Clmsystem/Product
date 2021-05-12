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

            <!-- ------------------------------------------  ค้นหาตัวชี้วัด Start-  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ค้นหาข้อมูล</h3><br>
                        <hr><br>
                        <form class="forms-sample" action="/searchPart2" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="newFont">ปี</label>
                                    <select class="form-control newFont" id="yearSelect" name="year"
                                        onchange="getSelectValue()">
                                        <optgroup class="newFont">
                                            @foreach ($years as $i => $value)
                                            <option value="{{ $value->year_id }}">{{ $value->year }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="newFont">เดือน</label>
                                    <select class="form-control newFont" id="month" name="month">
                                        <optgroup class="newFont">
                                            <!-- <option>ทุกเดือน</option> -->

                                            <option value="1" {{ $month == 1 ? 'selected' : '' }}>มกราคม</option>
                                            <option value="2" {{ $month == 2 ? 'selected' : '' }}>กุมภาพันธ์</option>
                                            <option value="3" {{ $month == 3 ? 'selected' : '' }}>มีนาคม</option>
                                            <option value="4" {{ $month == 4 ? 'selected' : '' }}>เมษายน</option>
                                            <option value="5" {{ $month == 5 ? 'selected' : '' }}>พฤษภาคม</option>
                                            <option value="6" {{ $month == 6 ? 'selected' : '' }}>มิถุนายน</option>
                                            <option value="7" {{ $month == 7 ? 'selected' : '' }}>กรกฎาคม</option>
                                            <option value="8" {{ $month == 8 ? 'selected' : '' }}>สิงหาคม</option>
                                            <option value="9" {{ $month == 9 ? 'selected' : '' }}>กันยายน</option>
                                            <option value="10" {{ $month == 10 ? 'selected' : '' }}>ตุลาคม</option>
                                            <option value="11" {{ $month == 11 ? 'selected' : '' }}>พฤศจิกายน</option>
                                            <option value="12" {{ $month == 12 ? 'selected' : '' }}>ธันวาคม</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="button-position">
                                        <button type="submit" name="search" value="search"
                                            class="btn btn-gradient-primary mr-2 newFont">ค้นหา</button>
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div>

            <!-- ------------------------------------------  ค้นหาตัวชี้วัด end-  --------------------------------------------->
            <!-- ------------------------------------------  แสดงตัวชี้วัด end-  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group col-md-12">

                        </div>
                        <div class="form-group col-md-12">
                            <h3 class="newFont">ตัวชี้วัดปัจจุบัน</h3><br>

                            <div class="button-position">
                                <button type="submit" name="download" value="download"
                                    class="btn btn-gradient-primary mr-2 newFont">ดาวน์โหลด</button>


                            </div>
                            <br>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12"></div>
                            <div class="col-md-12">
                                <table class="table table-bordered newFont">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-6" scope="col">
                                                <h7 class="newFont">ตัวชี้วัด</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">คะแนนเต็ม</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">คะแนนที่ได้</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($showindicator as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-6 tdleft break">{{$value->indicator_name}}</td>
                                            <td class="col-sm-1 break">{{$value->full_score}}</td>
                                            <td class="col-sm-1 break">{{$value->score}}</td>
                                            <td class="col-sm-2 tdleft break"> {{$value->name_employee}}</td>
                                            <td class="col-sm-2"><a target='_blank'
                                                    href="graphPart2?id={{$value->indicator_id}}&years={{$year}}"><button
                                                        type="button" class="btn btn-gradient-warning mr-2 newFont"><i
                                                            class="mdi mdi-chart-bar"></i></button></a></td>
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

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group col-md-12">

                        </div>
                        <div class="form-group col-md-12">
                            <h3 class="newFont">ตัวชี้วัดปัจจุบัน (รายปี)</h3><br>
                            <div class="button-position">
                                <button type="submit" name="download2" value="download2"
                                    class="btn btn-gradient-primary mr-2 newFont">ดาวน์โหลด</button>

                            </div>

                            <br>
                        </div>
                        </form>
                        <div class="row">
                            <div class="form-group col-md-12"></div>
                            <div class="col-md-12">
                                <table class="table table-bordered newFont">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-6" scope="col">
                                                <h7 class="newFont">ตัวชี้วัด</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">คะแนนเต็ม</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">คะแนนที่ได้</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($showyear as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-6 tdleft break">{{$value->indicator_name}}</td>
                                            <td class="col-sm-1 break">{{$value->full_score}}</td>
                                            <td class="col-sm-1 break">{{$value->score}}</td>
                                            <td class="col-sm-2 tdleft break"> {{$value->name_employee}}</td>
                                            <td class="col-sm-2"><a target='_blank'
                                                    href="graphPart2Year?years={{$year}}"><button type="button"
                                                        class="btn btn-gradient-warning mr-2 newFont"><i
                                                            class="mdi mdi-chart-bar"></i></button></a></td>
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



        </div>
        @include('partials.footer')
    </div>
    <!-- Div nav & side -->
    </div>
    </div>
    </div>


</body>
<script type="text/javascript">
const yearsOfSearch = "<?php echo $year; ?>";
$('#yearSelect').find('option').each((i, e) => {
    if ($(e).val() == yearsOfSearch) {
        $('#yearSelect').prop('selectedIndex', i);
    }
});

function getSelectValue() {
    var getText = $("#yearSelect option:selected").text();
    $("#showyear").text(getText);
    console.log(getText);
};
getSelectValue();
</script>