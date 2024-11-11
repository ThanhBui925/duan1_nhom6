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
                    <h1>Quản lý sản phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data">
                            <?php if (!empty($errors)): ?>
                                <p class="text-danger"><?= $errors[0] ?></p>
                            <?php endif; ?>  
                            <div class="card-body row">
                                <div class="form-group col-12">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham" value="<?= $_POST['ten_san_pham'] ? $_POST['ten_san_pham'] : '' ?>" placeholder="Nhập tên sản phẩm">
                                    <?php if(isset($errors['ten_san_pham'])): ?>
                                        <p class="text-danger"><?= $errors['ten_san_pham'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="gia_san_pham" value="<?= $_POST['gia_san_pham'] ? $_POST['gia_san_pham'] : '' ?>" placeholder="Nhập giá sản phẩm">
                                    <?php if(isset($errors['gia_san_pham'])): ?>
                                        <p class="text-danger"><?= $errors['gia_san_pham'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá khuyến mãi</label>
                                    <input type="number" class="form-control" name="gia_khuyen_mai" value="<?= $_POST['gia_khuyen_mai'] ? $_POST['gia_khuyen_mai'] : '' ?>" placeholder="Nhập giá khuyến mãi">
                                    <?php if(isset($errors['gia_khuyen_mai'])): ?>
                                        <p class="text-danger"><?= $errors['gia_khuyen_mai'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh" placeholder="Nhập hình ảnh">
                                    <?php if(isset($errors['hinh_anh'])): ?>
                                        <p class="text-danger"><?= $errors['hinh_anh'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Album ảnh</label>
                                    <input type="file" class="form-control" name="img_array[]" multiple>
                                </div>

                                <div class="form-group col-6">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong" value="<?= $_POST['so_luong'] ? $_POST['so_luong'] : '' ?>" placeholder="Nhập số lượng">
                                    <?php if(isset($errors['so_luong'])): ?>
                                        <p class="text-danger"><?= $errors['so_luong'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Ngày nhập</label>
                                    <input type="date" id="ngay_nhap" class="form-control" name="ngay_nhap" value="<?= $_POST['ngay_nhap'] ? $_POST['ngay_nhap'] : '' ?>" placeholder="Nhập hình ảnh">
                                    <?php if(isset($errors['ngay_nhap'])): ?>
                                        <p class="text-danger"><?= $errors['ngay_nhap'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Chọn danh mục sản phẩm</option>
                                        <?php foreach($listDanhMuc as $danhMuc): ?>
                                            <option 
                                                value="<?= $danhMuc['id'] ?>" 
                                                <?= (isset($_POST['category_id']) && $_POST['category_id'] == $danhMuc['id']) ? 'selected' : '' ?>
                                            >
                                                <?= $danhMuc['ten_danh_muc'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>

                                    <?php if(isset($errors['category_id'])): ?>
                                        <p class="text-danger"><?= $errors['category_id'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                                        <option selected disabled>Chọn trạng thái sản phẩm</option>
                                        <option value="1" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == '1') ? 'selected' : '' ?>>Còn hàng</option>
                                        <option value="2" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == '2') ? 'selected' : '' ?>>Hết hàng</option>
                                    </select>

                                    <?php if(isset($errors['trang_thai'])): ?>
                                        <p class="text-danger"><?= $errors['trang_thai'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" placeholder="Nhập mô tả"><?= $_POST['mo_ta'] ? $_POST['mo_ta'] : '' ?></textarea>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="mx-auto">
                        <img style="width: 150px;" src= "<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt=""
                            onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'"
                            >
                        </form>
                        <div class="card-header">
                            <h3 class="card-title">Album sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form >
                        <img style="width: 60px" src= "<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt=""
                            onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'"
                            >
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
