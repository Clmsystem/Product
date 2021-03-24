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
        padding: 1rem 3.3rem;
        font-size: 0.875rem;
    }

    .btns2 {
        padding: 1rem 2.7rem;
        font-size: 0.875rem;
    }

    .btn {
        font-size: 0.875rem;
        line-height: 1;
        font-family: "ubuntu-bold", sans-serif;

    }

    .Pbtn {
        margin-left: 0px;
        padding: 1rem;
        align-items: end;
        justify-content: end;
    }

    .btn-lg {
        padding: 1rem 8rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.1875rem;
    }

    /* adjust text position */
    td {
        text-align: center;
    }

    th {
        text-align: center;
    }

    td.break {
        word-wrap: break-word;
        /* word-break: break-all; */
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
                <h3 class="newFont"> แผนสถิติ</h3>
            </div>

            <!-- ------------------------------------------  การสืบค้นและะออกรายงาน  --------------------------------------------->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h3 class="newFont" for=""> แผนสถิติประจำปี 2564</h3> <!-- ปีต้องดึงมาโชว์ -->
                        </div>
                        <hr><br>
                        <form class="forms-sample">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <select class="form-control">
                                        <optgroup class="newFont">
                                            <option>ปี</option>
                                            <option>2563</option>
                                            <option>2562</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control">
                                        <optgroup class="newFont">
                                            <option>ไตรมาส</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control">
                                        <optgroup class="newFont">
                                            <option>เดือน</option>
                                            <option>มกราคม</option>
                                            <optidon>กุมภาพันธ์</optidon>
                                            <option>มีนาคม</option>
                                            <option>เมษายน</option>
                                            <option>พฤษภาคม</option>
                                            <option>มิถุนายน</option>
                                            <option>กรกฎาคม</option>
                                            <option>สิงหาคม</option>
                                            <option>กันยายน</option>
                                            <option>ตุลาคม</option>
                                            <option>พฤศจิกายน</option>
                                            <option>ธันวาคม</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <form class="forms-sample">
                            <div class="row">


                                <div class="form-group col-md-8">
                                    <!-- <button type="button" class="btn btn-primary btns ">กราฟ</button> -->
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-gradient-primary btns2 ">ดาวน์โหลด</button>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-gradient-primary btns ">ค้นหา</button>
                                </div>


                            </div>
                        </form>
                        <hr><br>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <table class="table table-bordered newFont">
                                    <thead>
                                        <tr class="d-flex">
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">ลำดับ</h7>
                                            </th>
                                            <th class="col-sm-3" scope="col">
                                                <h7 class="newFont">รายการ</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">จำนวน</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">หน่วย</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">หมายเหตุ</h7>
                                            </th>
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">ผู้รับผิดชอบ</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">กราฟ</h7>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_item as $i => $value)
                                        <tr class="d-flex">
                                            <td class="col-sm-1"> {{$i+1}} </td>
                                            <td class="col-sm-3 break"> {{$value->name_item}}</td>
                                            <td class="col-sm-2"> </td>
                                            <td class="col-sm-1"> {{$value->unit_name}} </td>
                                            <td class="col-sm-2"> </td>
                                            <td class="col-sm-2"> ทีมดูแลเพจ </td>
                                            <td class="col-sm-1"><a target = '_blank' href=graph><button type="button" class="Pbtn btn btn-inverse-success"><i class="mdi mdi-chart-bar"></i></button></a></td>
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
        @include('partials.footer')
    </div>
    <!-- Div nav & side -->
    </div>
    </div>
    </div>

</body>