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
                <h3 class="newFont"> ส่วนที่ 2 ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน (9 ข้อ) จาก ทมอ. </h3>
            </div>

            <!-- ------------------------------------------  ค้นหาตัวชี้วัด Start-  --------------------------------------------->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ยืนยันข้อมูล (ตัวชี้วัดรายปี) ประจำปีงบประมาณ
                            <?php echo $YearShow; ?></h3>
                        <hr>
                        <!-- <hr> -->

                        <div class="col-md-12">

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
                                    @foreach($indicator_year as $i => $item)
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

                        </div>
                        <div class="form-group col-md-12"></div>
                        <div class="form-group col-md-12">
                            <form action="{{route('unlogPart2Year')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="button-position">
                                    <input type="hidden" value="{{$year}}" name="yearselect" id="yearselect">
                                    <button type="submit" data-toggle="modal"
                                        class="btn btn-gradient-danger mr-4 newFont">ยกเลิก</button>
                                </div>
                            </form>
                            <form action="{{route('logPart2Year')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="button-position">
                                    <input type="hidden" value="{{$year}}" name="yearselect" id="yearselect">
                                    <button type="submit" data-toggle="modal"
                                        class="btn btn-gradient-primary mr-4 newFont">ยืนยันข้อมูล</button>
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