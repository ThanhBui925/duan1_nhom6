  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link text-center">
      <!-- <img src="./assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Trang quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block text-center">Bùi Trung Thành</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <p><i class="nav-icon fas fa-tachometer-alt"></i>
              Dashboard
              
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN.'?act=danh-muc' ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh mục sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN.'?act=san-pham' ?>" class="nav-link">
              <!-- <i class="nav-icon fas fa-th"></i> -->
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Quản lý sản phẩm
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>