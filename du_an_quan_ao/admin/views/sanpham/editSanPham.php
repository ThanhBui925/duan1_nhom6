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
                    <h1>Sửa thông tin sản phẩm : <?= $sanPham['ten_san_pham'] ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin chung</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="product_id" value="<?= $sanPham['id'] ?>">
                
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?=$sanPham['ten_san_pham']?>">
                <?php if(isset($errors['ten_san_pham'])): ?>
                    <p class="text-danger"><?= $errors['ten_san_pham'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="gia_san_pham">Giá sản phẩm</label>
                <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?=$sanPham['gia_san_pham']?>">
                <?php if(isset($errors['gia_san_pham'])): ?>
                    <p class="text-danger"><?= $errors['gia_san_pham'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="gia_khuyen_mai">Giá khuyến mãi</label>
                <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?=$sanPham['gia_khuyen_mai']?>">
                <?php if(isset($errors['gia_khuyen_mai'])): ?>
                    <p class="text-danger"><?= $errors['gia_khuyen_mai'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="hinh_anh">Hình ảnh</label>
                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
              </div>

              <div class="form-group">
                <label for="so_luong">Số lượng</label>
                <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?=$sanPham['so_luong']?>">
                <?php if(isset($errors['so_luong'])): ?>
                    <p class="text-danger"><?= $errors['so_luong'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="ngay_nhap">Ngày nhập</label>
                <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?=$sanPham['ngay_nhap']?>">
                <?php if(isset($errors['ngay_nhap'])): ?>
                    <p class="text-danger"><?= $errors['ngay_nhap'] ?></p>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="inputStatus">Danh mục sản phẩm</label>
                <select id="inputStatus" name="category_id" class="form-control custom-select">
                  <?php foreach($listDanhMuc as $danhMuc): ?>
                    <option <?= $danhMuc['id'] == $sanPham['category_id'] ? 'selected' : '' ?> value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                  <?php endforeach ?>
                  
                </select>
                <?php if(isset($errors['category_id'])): ?>
                    <p class="text-danger"><?= $errors['category_id'] ?></p>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="trang_thai">Trạng thái sản phẩm</label>
                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                    <option <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn hàng</option>
                    <option <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Hết hàng</option>
                  
                </select>
                <?php if(isset($errors['category_id'])): ?>
                    <p class="text-danger"><?= $errors['category_id'] ?></p>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="mo_ta">Mô tả sản phẩm</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"><?= $sanPham['mo_ta'] ?></textarea>
              </div>
            </div>
            <!-- /.card-body -->
             <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Sửa thông tin</button>
             </div>
        </div>
    </form>
          <!-- /.card -->
        </div>
        <div class="col-md-4">
          
          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Album ảnh sản phẩm</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->

</div>

<!-- footer -->
<?php include "./views/layout/footer.php"; ?>
<!-- end footer -->

<!-- Page specific script -->
<script>
    // Focus on the first input with error if errors exist
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $key => $error): ?>
            <?php if ($key == array_key_first($errors)): ?>
                document.querySelector('[name="<?= $key ?>"]').focus();
                // break;
                exit();
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</script>
<script>
    // Set giá trị của input date thành ngày hôm nay
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date().toISOString().split('T')[0]; // Lấy ngày hiện tại và chuyển về định dạng YYYY-MM-DD
        document.getElementById("ngay_nhap").value = today; // Cập nhật giá trị cho input ngày
    });
</script>
</body>
</html>
