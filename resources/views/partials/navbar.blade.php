<style>
    a {
        text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

    /* adjust font this page */
    .newFont {
        font-family: 'Mitr', sans-serif;
    }

    .pp {
        margin-top: 17px;
        /* margin-left: 150px; */
        /* align-items: center; */
    }
</style>
<div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            {{-- <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" --}}
            <a class="navbar-brand brand-logo" href="/"><img src="../../assets/images/logo1.png" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch" style="justify-content: space-between;">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav">
                <p class="newFont pp"> ยินดีต้อนรับคุณ {{session()->get('user')['name_employee']}} เข้าสู่ระบบผลการดำเนินงานศูนย์บรรณสารและสื่อการศึกษา มหาวิทยาลัยวลัยลักษณ์ </p>
            </ul>
            <ul class="navbar-nav navbar-nav">
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>
                <a class="dropdown-item" href="/logout">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Sign out </a>
        </div>
    </nav>