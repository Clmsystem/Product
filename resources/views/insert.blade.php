@include('header.menu')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');
    /* adjust font this page  */

    .newFont {
        font-family: 'Mitr', sans-serif;
        text-align: center;
    }

    .newFonts {
        font-family: 'Mitr', sans-serif;
        /* text-align: center; */
    }

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
        /* font-size: 9px !important; */
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
                <h3 class="newFont"> สถิติ ฝ่ายส่งเสริมการเรียนรู้และให้บริการการศึกษา ศูนย์บรรณสารและสื่อการศึกษา </h3>
            </div>

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="newFonts">บันทึกผลตามตัวชี้วัด</h3>
                            </div>
                            <div class="form-group col-md-2">
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
                                        <option>ตุลาคม</option>
                                        <option>พฤศจิกายน</option>
                                        <option>ธันวาคม</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <h3 class="newFonts"> ปี 2564</h3>
                            </div>
                        </div>
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
                                                <h7 class="newFont">จำนวน</h7>
                                            </th>
                                            <th class="col-sm-1" scope="col">
                                                <h7 class="newFont">หน่วยนับ</h7>
                                            </th>
                                            <th class="col-sm-3" scope="col">
                                                <h7 class="newFont">หมายเหตุ</h7>
                                            </th>
                                            <!-- <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">สถานะ</h7>
                                            </th> -->
                                            <th class="col-sm-2" scope="col">
                                                <h7 class="newFont">แก้ไข</h7>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="test">
                                        @foreach ($list_item as $i => $value)
                                            <tr class="d-flex newFont">
                                                <th class="col-sm-1"> {{ $i + 1 }} </th>
                                                <td class="col-sm-3 break"> {{ $value->name_item }} </td>
                                                <td class="col-sm-2">
                                                    <div><input style="border:none" type="text" class="form-control"
                                                            placeholder="จำนวน" required></div>
                                                </td>
                                                <th class="col-sm-1"> ครั้ง </th>
                                                <td class="col-sm-3">
                                                    <div><input style="border:none" type="text" class="form-control"
                                                            placeholder="หมายเหตุ" required></div>
                                                </td>
                                                <td class="col-sm-2">
                                                    <button class="btn btn-inverse-success btns" data-toggle="modal"
                                                        data-target="#modalAction{{ $i }}"><i
                                                            class="mdi mdi-grease-pencil launch-modal"></i></button>
                                                    <button type="submit" class="btn btn-inverse-info btns"><i
                                                            class="mdi mdi-content-save launch-modal"></i></button>

                                                    <div class="modal fade" id="modalAction{{ $i }}"
                                                        tabindex="-1" role="dialog" data-backdrop="static"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <br>
                                                                    <h2 class="modal-title newFont"
                                                                        id="exampleModalLabel">แก้ไข</h2>
                                                                    <form class="forms-sample">
                                                                        <hr><br>
                                                                        <div class="card-body">
                                                                            <div class="col-md-12">
                                                                                <table
                                                                                    class="table table-bordered newFont">
                                                                                    <thead>
                                                                                        <tr class="d-flex">
                                                                                            <th class="col-sm-5"
                                                                                                scope="col">
                                                                                                <h5 class="newFont">
                                                                                                    รายการ</h5>
                                                                                            </th>
                                                                                            <th class="col-sm-2"
                                                                                                scope="col">
                                                                                                <h7 class="newFont">
                                                                                                    จำนวน</h7>
                                                                                            </th>
                                                                                            <th class="col-sm-2"
                                                                                                scope="col">
                                                                                                <h7 class="newFont">
                                                                                                    หน่วยนับ</h7>
                                                                                            </th>
                                                                                            <th class="col-sm-3"
                                                                                                scope="col">
                                                                                                <h7 class="newFont">
                                                                                                    หมายเหตุ</h7>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr class="d-flex newFont">
                                                                                            <th class="col-sm-5 break">
                                                                                                {{ $value->name_item }}
                                                                                            </th>
                                                                                            <td class="col-sm-2">
                                                                                                <div><input type="text"
                                                                                                        class="form-control"
                                                                                                        placeholder="จำนวน"
                                                                                                        required></div>
                                                                                            </td>
                                                                                            <th class="col-sm-2"> ครั้ง
                                                                                            </th>
                                                                                            <td class="col-sm-3">
                                                                                                <div><input type="text"
                                                                                                        class="form-control"
                                                                                                        placeholder="หมายเหตุ"
                                                                                                        required></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    </thead>
                                                                                </table>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">
                                                                                        <h7 class="newFont">ยกเลิก</h7>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">
                                                                                        <h7 class="newFont">บันทึก</h7>
                                                                                    </button>
                                                                                </div>
                                                                                <!-- <div class="col-md-1"></div> -->
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 grid-margin stretch-card">
                                                            <div class="card">

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



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('partials.footer')
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
