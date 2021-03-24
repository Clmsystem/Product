


<div class="container-fluid page-body-wrapper">
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src= "{{session()->get('user')['img']}}" class="sizeimg"  alt="profile">
            {{-- <span class="login-status online"></span> --}}
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2" style="text-align: center;">{{session()->get('user')['name_employee']}}</span>
            <span class="text-secondary text-small"
              style="word-wrap: break-word; white-space: normal; text-align: center; margin-left:1px;">{{session()->get('user')['name_position']}}</span>
          </div>
          {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
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
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <span class="menu-title">Member</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/createpart4">
          <span class="menu-title">จัดการตัวชี้วัด</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/submit">
          <span class="menu-title">บันทึกผลตามตัวชี้วัด</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/report">
          <span class="menu-title">การสืบค้นและออกรายงาน</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>

    </ul>
  </nav>

  <!-- partial -->

  <style>
    .sizeimg{
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