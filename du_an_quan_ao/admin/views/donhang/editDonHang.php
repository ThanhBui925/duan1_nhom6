<!-- header -->
<?php require "./views/layout/header.php"; ?>
<!-- end header -->
  <!-- Navbar -->

 <?php include "./views/layout/navbar.php"; ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

<?php include "./views/layout/sidebar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý thông tin đơn hàng</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa thông tin đơn hàng : <?= $donHang['ma_don_hang'] ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN.'?act=edit-don-hang' ?>" method="post">
                <input type="text" name="id_don_hang" value="<?=$donHang['id']?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label >Tên người nhận</label>
                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập tên danh mục">
                    <?php if(isset($errors['ten_nguoi_nhan'])){?>
                      <p class="text-danger"><?=$errors['ten_nguoi_nhan']?></p>
                   <?php } ?>
                  </div>

                  <div class="form-group">
                    <label >Số điện thoại</label>
                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập tên danh mục">
                    <?php if(isset($errors['sdt_nguoi_nhan'])){?>
                      <p class="text-danger"><?=$errors['sdt_nguoi_nhan']?></p>
                   <?php } ?>
                  </div>

                  <div class="form-group">
                    <label >Email</label>
                    <input type="text" class="form-control" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập tên danh mục">
                    <?php if(isset($errors['email_nguoi_nhan'])){?>
                      <p class="text-danger"><?=$errors['email_nguoi_nhan']?></p>
                   <?php } ?>
                  </div>

                  <div class="form-group">
                    <label >Địa chỉ</label>
                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập tên danh mục">
                    <?php if(isset($errors['dia_chi_nguoi_nhan'])){?>
                      <p class="text-danger"><?=$errors['dia_chi_nguoi_nhan']?></p>
                   <?php } ?>
                  </div>
                  <div class="form-group">
                    <label >Ghi chú</label>
                    <textarea class="form-control" name="mo_ta" id="" placeholder="Nhập mô tả"><?= $donHang['ghi_chu'] ?></textarea>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="inputStatus"></label>
                    <select name="order_status_id" id="inputStatus" class="form-control custom-select">
                        <?php foreach($listTrangThaiDonHang as $key=>$trangThai): ?>
                        <option 
                            <?= $trangThai['id'] == $donHang['order_status_id'] ? 'selected':'' ?> 
                            <?php 
                              if($trangThai['id'] < $donHang['order_status_id'] 
                              || $donHang['order_status_id'] == 10 
                              || $donHang['order_status_id'] == 11 
                              || $donHang['order_status_id'] == 9)
                              {
                                echo 'disabled';
                              }
                            ?>
                            value="<?= $trangThai['id'] ?>">
                            <?= $trangThai['ten_trang_thai'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
<!-- footer -->
 <?php include "./views/layout/footer.php" ?>
<!-- end footer -->
<!-- Page specific script -->

<!-- Code injected by live-server -->
</body>
</html>