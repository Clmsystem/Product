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

    table th,
    table tr td {
        font-family: 'Mitr', sans-serif !important;
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
                <h3 class="newFont">จัดการภาพรวม</h3>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <form class="forms-sample" action="/manageted" method="post">
                            @csrf
                            <!-- @method('POST') -->
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <h4 class="newFont">เพิ่มปีงบประมาณ</h4>
                                </div>
                                <div class="form-group col-md-2">
                                    <input class="form-control newFont" readonly type="text" name="Addyear" value="<?= $yearSelected + 1 ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" name="btn_add" id="btn_add" value="1" class="btn btn-inverse-primary btns newFont">เพิ่ม</button>
                                </div>
                                <div class="form-group col-md-2">
                                    <h4 class="newFont">เลือกปีงบประมาณ</h4>
                                </div>
                                <div class="form-group col-md-2">
                                    <select id="yearSelect2" class="form-control" name="Flagyear">
                                        <optgroup class="newFont">
                                            <?php
                                            for ($i = 0; $i < count($currentYear); $i++) {
                                                $selected = ($currentYear[$i]->flag  == 1 ? 'selected' : '');
                                                echo '<option  value="' . $currentYear[$i]->year_id . '"' . $selected . '>' . $currentYear[$i]->year . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" name="btn_flag" id="btn_flag" value="1" class="btn btn-inverse-primary btns newFont">ยืนยัน</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>แผนก</th>
                                        <th>ตำแหน่ง</th>
                                        <th>สถานะ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emp as $i => $value)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $value->name_employee }}</td>
                                        <td>{{ $value->name_department }}</td>
                                        <td>{{ $value->name_position }}</td>
                                        <td>{{ $value->code_name }}</td>
                                        <td>
                                            <button class="btn btn-inverse-success btns" data-toggle="modal" data-target="#modalAction{{ $i }}"><i class="mdi mdi-grease-pencil launch-modal"></i></button>
                                            <button class="btn btn-inverse-danger btns" data-toggle="modal" data-target="#modalDelete{{ $i }}"><i class="mdi mdi-delete"></i></button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalDelete{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="modal-body">
                                                            <h3 class="modal-title newFont" id="exampleModalLabel1">
                                                                ลบบัญชีผู้ใช้</h3>
                                                            <hr>
                                                            <h5 class="newFont">
                                                                ยืนยันที่จะลบบัญชีผู้ใช้หรือไม่ ?
                                                            </h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">Close</button>

                                                            <form class="forms-sample" action="/manageted/delete" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-gradient-danger" name="del" id="del" value="{{ $value->id_employee }}">Delete</button>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalAction{{ $i }}" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <br>
                                                            <h2 class="modal-title newFont" id="exampleModalLabel">
                                                                แก้ไขบัญชี</h2>
                                                            <!-- -------------------- FROM ------------------------- -->
                                                            <form class="forms-sample" action="{{ route('management.update', $value->id_employee) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <hr><br>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label class="newFont">ชื่อ - นามสกุล</label>
                                                                        <input name="id_employee" type="text" value="{{ $value->id_employee }}" hidden>
                                                                        <input type="text" class="form-control" name="name_employee" placeholder="" value="{{ $value->name_employee }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label class="newFont">แผนก</label>
                                                                        <input name="value_of_item" type="text" value="{{ $value->id_employee }}" hidden>
                                                                        <input type="text" class="form-control" name="name_department" placeholder="" value="{{ $value->name_department }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label class="newFont">ตำแหน่ง</label>
                                                                        <input name="value_of_item" type="text" value="{{ $value->id_employee }}" hidden>
                                                                        <input type="text" class="form-control" name="name_position" placeholder="" value="{{ $value->name_position }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label class="newFont">สถานะผู้ใช้งาน</label>
                                                                        <input name="value_of_item" type="text" value="{{ $value->id_employee }}" hidden>
                                                                        <input type="text" class="form-control" name="code_name" placeholder="" value="{{ $value->code_name }}" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label class="newFont">password</label>
                                                                        <input name="value_of_item" type="text" value="{{ $value->id_employee }}" hidden>
                                                                        <input type="text" class="form-control" name="password" placeholder="" value="{{ $value->password }}" required>
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
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const yearsOfSearch = "<?php echo $years; ?>";
    $('#yearSelect2').find('option').each((i, e) => {
        if ($(e).val() == yearsOfSearch) {
            $('#yearSelect').prop('selectedIndex', i);
        }
    });


    var msg = '<?= Session::get('alert') ?>';
    if (msg) {
        alert(msg);
    }
</script>