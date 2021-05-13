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
</head>




<style>
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

    /* adjust font this page */
    .newFont {
        font-family: 'Mitr', sans-serif;
    }
</style>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            <div class="brand-logo" style="justify-content: center">
                                <img src="../../assets/images/logo1.png">
                                <br><hr>
                            </div>
                            <h5 class="font-weight-light newFont">ระบบผลการดำเนินงานศูนย์บรรณสารและสื่อการศึกษา</h5>
                            <h5 class="newFont"style="justify-content: center"> มหาวิทยาลัยวลัยลักษณ์</h5>

                            <form class="pt-3" action="/Valid" method="POST">
                                @csrf
                                <div class="form-group newFont">
                                    <input type="text" class="form-control form-control-lg" id="email" name="email"
                                        placeholder="Username">
                                </div>
                                <div class="form-group newFont">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <input
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit" value="SING IN">
                                </div>
      <br>
                             


                            </form>
                            <?php if(session()->has('status')){
                                $message = session()->get('status');
                              echo "<script type='text/javascript'>alert('$message');</script>";
                              session()->forget('status');
                            }?>
                            <?php if(session()->has('mes')){
                                $mess = session()->get('mes');
                              echo "<script type='text/javascript'>alert('$mess');</script>";
                              session()->forget('mes');
                            }?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
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
</body>

</html>