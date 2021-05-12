<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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


    /* adjust btn size */
    .btns {
        padding: 0.9rem 2em;
        font-size: 0.875rem;
    }
</style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <h1 class="text-success mdi mdi-face newFont" > ยินดีต้อนรับคุณ Admin</h1>
          <div class="page-header">
            <h3 class="newFont"> เป้าหมายตามคำรับรองของ {{$objectName[0]->nameObject}}</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item newFont" aria-current="page"><a href="/section_one">Objective</a></li>
                <li class="breadcrumb-item active newFont">Key Results</li>
              </ol>
            </nav>
          </div>
          @if($flag == 0)
            <p class="mr-3" style="text-align:right"><button class="btn btn-lg btn-secondary mdi mdi-library-plus newFont" data-toggle="modal" data-target="#modalAddKR" disabled> เพิ่มเป้าหมายตามคำรับรอง</button></p>
          @else
            <p class="mr-3" style="text-align:right"><button class="btn btn-lg btn-gradient-primary mdi mdi-library-plus newFont" data-toggle="modal" data-target="#modalAddKR"> เพิ่มเป้าหมายตามคำรับรอง</button></p>
          @endif

          @foreach ($kr as $data)
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form method="post" action="{{route('updateKR')}}" id="multiple_select_form">
                  @csrf
                  <div class="form-group newFont">
                    <label for="keyResult ">เป้าหมายตามคำรับรอง</label>
                    <input type="text" class="form-control newFont" name="result" placeholder="เป้าหมายตามคำรับรอง" value="{{$data->nameKR}}" @if($flag == 0) disabled @endif>
                    <input type="hidden" name="id" value="{{$data->KR_idKR}}">
                    <p style="text-align:right"><a href="#" class="card-description"><i class="mdi mdi-clipboard-text"></i> ลิ้งสำหรับเอกสารที่เกี่ยวข้อง <br></a></p>
                  </div>
                  <div class="form-group">
                  <label for="emp2">เลือกผู้รับผิดชอบ</label>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <select name="employee[]" id="emp2" class="form-control selectpicker" data-live-search="true" multiple @if($flag == 0) disabled @endif>
                        @foreach ($employee as $data2)
                          @if($autrority->count()>0)
                            @foreach ($autrority as $data3)
                              @if($data->KR_idKR == $data3->KR_idKR)
                                  @if($data2->id_employee == $data3->Employee_id_employee)
                                    <option selected='selected' value="{{$data2->id_employee}}">{{$data2->name_employee}}</option>
                                    @break
                                  @elseif($data3->idautrority==$max)
                                    <option value="{{$data2->id_employee}}">{{$data2->name_employee}}</option>
                                  @endif
                              @elseif($data3->idautrority==$max)
                                <option value="{{$data2->id_employee}}">{{$data2->name_employee}}</option>
                              @endif
                            @endforeach
                          @else
                            <option value="{{$data2->id_employee}}">{{$data2->name_employee}}</option>
                          @endif
                        @endforeach  
                      </select >
                      </div>
                  </div>
                    <br/>
                    <br/>
                    <p style="text-align:right">
                      <button type="submit" class="btn btn-success btn-fw mr-2 mdi mdi-content-save-all newFont" @if($flag == 0) disabled @endif> บันทึก</button>
                      <button type="reset" class="btn btn-gradient-light newFont" @if($flag == 0) disabled @endif>ยกเลิก</button>
                      <button type="button" class="btn btn-danger ml-4 mdi mdi-delete-forever newFont" data-toggle="modal" data-target="#deletemodal" onclick="addIdToModal({{$data->KR_idKR}});" @if($flag == 0) disabled @endif> ลบ</button>
                    </p>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- content-wrapper ends -->
        <!-- Modal ADD -->
        <div class="modal fade" id="modalAddKR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <form class="forms-sample" action="{{route('addKR')}}" method="post">
                  @csrf
                  <hr><br>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <h3 class="modal-title newFont" id="exampleModalLabel">เพิ่มเป้าหมายตามคำรับรอง</h3>
                      <hr>
                      <input type="text" class="form-control" placeholder="หัวข้อตัวขี้วัด" name="keyobject" required>
                      <input type="hidden" class="form-control" placeholder="หัวข้อตัวขี้วัด" name="id" value="">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-primary newFont" data-dismiss="modal">ยกเลิก</button>
                    <input type="submit" value="บันทึก" class="btn btn-gradient-danger">
                  </div>
                </form>
              </div>

            </div>
        </div>
      </div>
      <!-- Modal DELETE -->
      <!-- Modal DELETE -->
      <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h3 class="modal-title newFont" id="exampleModalLabel1">ลบเป้าหมายตามคำรับรอง</h3>
              <hr>
              <h5 class="newFont"> ยืนยันที่จะลบ ตัวชี้วัดตามคำรับรอง นี้หรือไม่ ? </h5>
              <form class="forms-sample" action="{{route('deletekr')}}" method="post">
                @csrf
                <input id="object_delete_id" type="hidden" class="form-control" name="delete_keyobject">
                <div class="modal-footer">
                  <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">ปิด</button>
                  <button type="submit" class="btn btn-gradient-danger">ลบ</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:../../partials/_footer.html -->
      <footer class="footer">
        <div class="container-fluid clearfix">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- <script src="../../assets/vendors/js/vendor.bundle.base.js"></script> -->
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../../assets/js/file-upload.js"></script>
  <!-- End custom js for this page -->
  <script type="text/javascript">
    function addIdToModal(id) {
      document.getElementById('object_delete_id').value = id;
    };
  </script>
</body>

</html>