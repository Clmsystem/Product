<?php
$dp = session()->get('user')['id_department'];
$p = session()->get('user')['id_position'];
$role = session()->get('user')['status'];
?>
<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="/" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="{{session()->get('user')['img']}}" class="sizeimg" alt="profile">
                        {{-- <span class="login-status online"></span> --}}
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2"
                            style="text-align: center;">{{session()->get('user')['name_employee']}}</span>
                        <span class="text-secondary text-small"
                            style="word-wrap: break-word; white-space: normal; text-align: center; margin-left:1px;">{{session()->get('user')['name_position']}}</span>
                    </div>
                    {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
                </a>
            </li>
            <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">ALL Topic</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Topic 1</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Topic 2</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Topic 3</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Topic 4</a></li>
            <li class="nav-item"> <a class="nav-link" href="/createpart4">Add</a></li>
          </ul>
        </div>
      </li> -->

            <li class="nav-item">
                <a class="nav-link" href="/userObject/{{session()->get('user')['id_employee']}}">
                    <span class="menu-title">ส่วนที่ 1</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/section_one">
                    <span class="menu-title">Admin ส่วนที่ 1</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php if ($dp == 2 && $p == 3) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/createpart4">
                    <span class="menu-title">จัดการตัวชี้วัด</span>
                    <!-- d2 p3 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <?php if ($dp == 2 && ($p != 1 && $p != 2)) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/submit">
                    <span class="menu-title">บันทึกผลตามตัวชี้วัด</span>
                    <!-- d2 p!1 !2 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <?php if ($dp == 1 || $dp == 2) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/report">
                    <span class="menu-title">การสืบค้นและออกรายงาน</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <?php if ($dp == 2 && $p == 3) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/approve">
                    <span class="menu-title">Admin Confirm</span>
                    <!-- d2 p3 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <?php if ($dp == 4 && $role == 2) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/createPart2">
                    <span class="menu-title">ส่วนที่ 2 เพิ่มตัวชี้วัด</span>
                    <!-- d2 s2 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <?php if ($role == 3) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/management">
                    <span class="menu-title">การจัดการภาพรวม</span>
                    <!-- d2 s2 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
            <li class="nav-item">
                <a class="nav-link" href="/contentPart2">
                    <span class="menu-title">ส่วนที่ 2 ตัวชี้วัด(รายเดือน)</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contentPart2Year">
                    <span class="menu-title">ส่วนที่ 2 ตัวชี้วัด(รายปี)</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/searchPart2">
                    <span class="menu-title">ค้นหาข้อมูลย้อนหลัง</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php if ($dp == 4 && $role == 2) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/confirmPart2">
                    <span class="menu-title">ยืนยันข้อมูลตัวชี้วัด(รายเดือน)</span>
                    <!-- s2  d4 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/confirmPart2Year">
                    <span class="menu-title">ยืนยันข้อมูลตัวชี้วัด(รายปี)</span>
                    <!-- s2  d4 -->
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
            </li>
            <?php endif ?>
        </ul>
    </nav>
    <!-- partial -->

    <style>
    .sizeimg {
        /* width: 70px;
      height: 70px; */
        border-radius: 100%;
        object-fit: cover;
        margin-top: -13px;
        margin-left: -20px
    }

    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-image img {
        width: 70px;
        height: 70px;
        border-radius: 100%;
    }
    </style>