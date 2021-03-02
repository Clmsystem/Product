<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ระบบรายงานผลการดำเนินงาน</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <style>
.container {
    height: 200px;
    display: flex;
    /* align-items: ; */
    margin-left: 25%;
    margin-top: 10% ;
    /* justify-content: center; */
}
  </style>
  <body>
    <div>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <h4 class="page-title">
            ระบบรายงานผลการดำเนินงาน
          </h4>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
            </form>
          </div>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid content-wrapper">
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">

              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> ระบบรายงานผลการดำเนินงาน
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">

                </ul>
              </nav>
            </div> 
            <!-- <a href="#" > -->
            <div class="row container">
          
              <div class="col-md-4 stretch-card grid-margin" onclick="pad()"> 
           
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                    </h4>
                    <h2 class="mb-5">ฝ่ายบริหารทั่วไปและธุรการ</h2>
                    <h6 class="card-text">คลิกเพื่อเข้าสู่ระบบ</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin " onclick="pad2()">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> 
                    </h4>
                    <h2 class="mb-5">ฝ่ายส่งเสริมการเรียนรู้และให้บริการการศึกษา </h2>
                    <h6 class="card-text">คลิกเพื่อเข้าสู่ระบบ</h6>
                  </div>
                </div>
              </div>

            </div>
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->

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
<script>
    pad = () =>{
      // alert("dsd");
      window.location.href = '/login1';
    }
    pad2 = () =>{
      window.location.href = '/login2';
    }
</script>