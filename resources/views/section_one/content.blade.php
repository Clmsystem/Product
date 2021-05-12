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
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />

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
              <h3 class="newFont"> ส่วนที่ 1 ผลการดำเนินงานตามตัวชี้วัดคำรับรองการปฏิบัติงาน ตามนโยบายเร่งด่วนของอธิการบดี (OKRs) </h3>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="row">
                    <div class="col-6" style="float:none;margin:auto;">
                      @csrf
                      <select type="dropdown-toggle" class="form-control newFont" onchange="location = '/section_one/'+this.value;">
                          <optgroup class="newFont">
                          <option value="" disabled>เลือกปีงบประมาณ</option>
                          @foreach ($allyear as $years)
                              @if($currentyearid == $years->year_id)
                                <option value="{{$years->year}}" selected>{{$years->year}}</option>
                              @else
                                <option value="{{$years->year}}">{{$years->year}}</option>
                              @endif
                          @endforeach
                          </opgroup>
                      </select>
                    </div>
                    <div class="col-6" style="float:none;margin:auto;">
                        <a href="/section_five"><button class="btn btn-gradient-success btn-md m-3 mdi mdi-lock" > Admin</button>
                        <a href="/search"><button class="btn btn-gradient-info btn-md m-3 mdi mdi-elevation-decline" > Report</button></a>
                        @if ($flag==0)
                          <button class="btn btn-lg btn-secondary m-3 mdi mdi-library-plus  newFont"  onclick="addYearToModal({{$currentyearid}});" data-toggle="modal" data-target="#modalAction" disabled> เพิ่มตัวชี้วัดตามคำรับรอง</button>
                        @else
                          <button class="btn btn-lg btn-gradient-primary m-3 mdi mdi-library-plus  newFont"  onclick="addYearToModal({{$currentyearid}});" data-toggle="modal" data-target="#modalAction"> เพิ่มตัวชี้วัดตามคำรับรอง</button>
                        @endif
                    </div>
                  </div>
                  <table class="table">
                      <thead>
                        <th><h5 class = newFont>ตัวชี้วัดตามคำรับรอง</h5></th>
                        <th></th>
                        
                      </thead>
                      <tbody>
                        @foreach ($ob as $data)
                            @if ($flag==0)
                            <tr>
                              <td><a href="{{url('/section_one/'.$currentyear.'/'.$data->idobject)}}" class="text-dark newFont">{{$data->nameObject}}</a></td>
                              <td style="text-align:right">
                                <button class="btn btn-secondary btn-md" data-toggle="modal" data-target="#modalEditObj" onclick="addContentToModal({{$data->idobject}}, '{{$data->nameObject}})',{{$currentyearid}};" disabled> แก้ไข</button>
                                @if(count($obkr)>0)
                                  @foreach($obkr as $data2)
                                    @if ($data->idobject==$data2->object_idobject) 
                                      @break
                                    @elseif ($data2->idKR==$max) 
                                      <button class="btn btn-secondary btn-md ml-4" data-toggle="modal" data-target="#deletemodal" onclick="addIdToModal({{$data->idobject}},{{$currentyearid}});" disabled> ลบ</button>
                                    @endif     
                                  @endforeach
                                @else
                                  <button class="btn btn-secondary btn-md ml-4" data-toggle="modal" data-target="#deletemodal" onclick="addIdToModal({{$data->idobject}},{{$currentyearid}});" disabled> ลบ</button>
                                @endif
                              </td>
                            </tr>
                            @else
                            <tr>
                              <td><a href="{{url('/section_one/'.$currentyear.'/'.$data->idobject)}}" class="text-dark newFont">{{$data->nameObject}}</a></td>
                              <td style="text-align:right">
                                  <button class="btn btn-warning btn-md mdi mdi-lead-pencil" data-toggle="modal" data-target="#modalEditObj" onclick="addContentToModal({{$data->idobject}},'{{$data->nameObject}}',{{$currentyearid}});"> แก้ไข</button>
                                  @if(count($obkr)>0)
                                    @foreach($obkr as $data2)
                                      @if ($data->idobject==$data2->object_idobject) 
                                        @break
                                      @elseif ($data2->idKR==$max) 
                                        <button class="btn btn-danger btn-md ml-4 mdi mdi-delete-forever" data-toggle="modal" data-target="#deletemodal" onclick="addIdToModal({{$data->idobject}},{{$currentyearid}});"> ลบ</button>
                                      
                                      @endif     
                                    @endforeach
                                  @else
                                    <button class="btn btn-danger btn-md ml-4" data-toggle="modal" data-target="#deletemodal" onclick="addIdToModal({{$data->idobject}},{{$currentyearid}});"> ลบ</button>
                                  @endif
                              </td>
                            </tr>
                            @endif

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
      
            </div>
          </div>
          
            <!-- Modal ADD -->
            <div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <form class="forms-sample" action="{{route('addobject')}}" method="post">
                              @csrf
                                <hr><br>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <h3 class="modal-title newFont" id="exampleModalLabel">เพิ่มตัวชี้วัดตามคำรับรอง</h3>
                                    <hr>
                                        <input type="text" class="form-control" placeholder="หัวข้อตัวขี้วัด"  name="keyobject" required>
                                        <input id="object_year" type="hidden" class="form-control" placeholder="ปี"  name="yearobject">
                                    </div>                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">ยกเลิก</button>
                                    <input type="submit" value="บันทึก" class="btn btn-gradient-danger">
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
          <div class="modal fade" id="modalEditObj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 class="modal-title newFont" id="exampleModalLabel">แก้ไขตัวชี้วัดตามคำรับรอง</h3>
                            <hr>
                            <form class="forms-sample" action="{{route('editobject')}}" method="post">
                              @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input id="object_edit_id" type="hidden" class="form-control" placeholder="หัวข้อตัวขี้วัด"  name="keyobject">
                                        <input id="object_edit_year_id" type="hidden" class="form-control" placeholder="หัวข้อตัวขี้วัด"  name="yearobject">
                                        <input id="object_edit_name" type="text" class="form-control" placeholder="หัวข้อตัวขี้วัด"  name="nameobject" required>
                                    </div>                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">ปิด</button>
                                    <input type="submit" value="แก้ไข" class="btn btn-gradient-warning">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal DELETE -->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                              <h3 class="modal-title newFont" id="exampleModalLabel1">ลบเป้าหมายตามคำรับรอง</h3>
                              <hr>
                              <h5 class="newFont"> ยืนยันที่จะลบ ตัวชี้วัดตามคำรับรอง นี้หรือไม่ ? </h5>
                              <form class="forms-sample" action="{{route('deleteobject')}}" method="post">
                                @csrf
                                <input id="object_delete_id" type="hidden" class="form-control" name="delete_keyobject">
                                <input id="object_year_id" type="hidden" class="form-control" name="year_object">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-gradient-primary" data-dismiss="modal">ปิด</button>
                                  <button type="submit" class="btn btn-gradient-danger">ลบ</button>
                                </div>
                              </form>
                        </div>
                  </div>
              </div>
            </div>
          <!-- content-wrapper ends -->
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
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
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
      function addIdToModal(id,year){
        document.getElementById('object_delete_id').value = id;
        document.getElementById('object_year_id').value = year;    
      };
      function addYearToModal(year){
        document.getElementById('object_year').value = year;  
      };
      function addContentToModal(id,name,year){
        document.getElementById('object_edit_id').value = id;
        document.getElementById('object_edit_name').value = name;
        document.getElementById('object_edit_year_id').value = year;
      }; 
    </script>
  </body>
</html>