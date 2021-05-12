@include('header.menu')
<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

.newFont {
    font-family: 'Mitr', sans-serif;
}

.btns {
    padding: 0.9rem 2em;
    font-size: 0.875rem;
}

td {
    text-align: center;
}

.tdleft {
    text-align: left;
}

th {
    text-align: center;
}

.button-position {
    float: right;
    margin: -8px;
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

    @include('partials.navbar')
    @include('partials.sidebar')


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="newFont"> แบบฟอร์มประเมินของฝ่ายบริหารและธุรการทั่วไป </h3>

            </div>
            <!-- แบบฟอร์มส่วนที่ 2 start -->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ส่วนที่ 2 ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน (9 ข้อ) จาก ทมอ.
                            ประจำปี
                            <?php echo $YearShow; ?> </h3>
                        <br>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="newFont">เดือน</label>
                                <form action="{{route('search_month')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <select id="client_id" type="dropdown-toggle" class="form-control newFont"
                                        name="month">
                                        <optgroup class="newFont">
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
                                </form>
                            </div>

                        </div>

                        <hr>
                        <!-- <p class="card-description"> Basic form elements </p> -->

                        <div class="row">
                            <!-- <div class="col-md-1"></div> -->
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
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">ผล</h7><br><br>
                                            </th>
                                            <th class="col-sm-2 break" scope="col">
                                                <h7 class="newFont">ร้อยละผลสำเร็จ</h7>
                                            </th>
                                            <th class="col-sm-1 " scope="col">
                                                <h7 class="newFont">คะแนนที่ได้</h7>
                                            </th>
                                            <th class="col-sm-1 break" scope="col">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indicator_month as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-5 tdleft break"> {{$value->indicator_name}} </td>
                                            <td class="col-sm-1 break"> {{$value->full_score}} </td>
                                            <td class="col-sm-2 break">{{$value->result}}
                                                <!-- <input type="text" name="result" value="{{$value->result}}"
                                                        class="form-control" placeholder="ตัวเลข" required> -->
                                            </td>
                                            <td class="col-sm-2 break">{{$value->percent}}
                                                <!-- <input type="text" name="percent" value="{{$value->percent}}"
                                                        class="form-control" placeholder="ตัวเลข" required>
                                                    <input type="hidden" name="key"
                                                        value="{{$value->indicator_month_id}}" class="form-control"
                                                        placeholder="ตัวเลข"> -->
                                            </td>
                                            <td class="col-sm-1 break">{{$value->score}}
                                            </td>
                                            <td class="col-sm-1 break">
                                                @if (count($status_month)>0)
                                                <button class="btn btn-gradient-warning  btn-sm" data-toggle="modal"
                                                    data-target="#modalAction1{{ $i }}">
                                                    <i class="mdi mdi-grease-pencil launch-modal"></i></button>
                                                @else
                                                <button class="btn btn-gradient-danger  btn-sm"><i
                                                        class="mdi mdi-lock"></i></button>
                                                @endif


                                                <div class="modal fade" id="modalAction1{{ $i }}" tabindex="-1"
                                                    role="dialog" data-backdrop="static"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <br>
                                                                <h2 class="modal-title newFont" id="exampleModalLabel">
                                                                    แก้ไข</h2>
                                                                <!-- -------------------- FROM ------------------------- -->
                                                                <form method="post" action="{{route('updatemonth')}}">
                                                                    @csrf
                                                                    <hr><br>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-4 tdleft ">
                                                                            <label class="newFont">หัวข้อ</label>
                                                                            <input type="text"
                                                                                class="form-control newFont"
                                                                                id="indicator_name"
                                                                                name="indicator_name"
                                                                                value="{{$value->indicator_name}}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label class="newFont">คะแนนเต็ม</label>
                                                                            <input type="text"
                                                                                class="form-control newFont "
                                                                                id="full_score" name="full_score"
                                                                                value="{{$value->full_score}}" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label class="newFont">ผล</label>
                                                                            <input type="text" name="result" id="result"
                                                                                value="{{$value->result}}"
                                                                                class="form-control newFont"
                                                                                placeholder="ตัวเลข" required>
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label
                                                                                class="newFont">ร้อยละผลสำเร็จ</label>
                                                                            <input type="text" name="percent"
                                                                                id="percent" value="{{$value->percent}}"
                                                                                class="form-control newFont"
                                                                                placeholder="ตัวเลข" required>
                                                                            <input type="hidden" name="key"
                                                                                value="{{$value->indicator_month_id}}"
                                                                                class="form-control newFont"
                                                                                placeholder="ตัวเลข">
                                                                        </div>
                                                                        <div class="form-group col-md-2 tdleft">
                                                                            <label class="newFont">คะแนนที่ได้</label>
                                                                            <input type="text" name="score" id="score"
                                                                                value="{{$value->score}}"
                                                                                class="form-control newFont"
                                                                                placeholder="คะแนนทีไ่ด้" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary"
                                                                            data-dismiss="modal">
                                                                            <h7 class="newFont">ยกเลิก</h7>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">
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
                            </div>
                        </div>

                        <div class="form-group col-md-12"></div>
                        <div class="form-group col-md-8"></div>


                    </div>
                </div>
            </div>
            <!-- สร้างตัวชี้วัด end -->

        </div>
        @include('partials.footer')
    </div>
    <!-- Div nav & side -->
    </div>
    </div>
</body>

<script>
var select = document.getElementById('client_id');
select.addEventListener('change', function() {
    this.form.submit();
}, false);
</script>