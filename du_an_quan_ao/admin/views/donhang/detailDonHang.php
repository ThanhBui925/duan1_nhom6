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
          <div class="col-sm-8">
            <h1>Quản lý đơn hàng - Đơn hàng : <?= $donHang['ma_don_hang'] ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
   
    <!-- /.content -->
 
<!-- footer --><section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php if($donHang['order_status_id']==1){
                $colerAlert = 'primary';
            }elseif($donHang['order_status_id'] >= 2 && $donHang['order_status_id'] <= 9){
                $colerAlert = 'success';
            }elseif($donHang['order_status_id'] == 10){
                $colerAlert = 'warning';
            }else{
                $colerAlert = 'danger';
            } ?>
          <div class="alert alert-<?= $colerAlert; ?>" role="alert">
           Đơn hàng : <?= $donHang['ten_trang_thai'] ?>
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-store"></i> Shop Dự Án 1
                    <small class="float-right">Ngày đặt : <?= formatDate($donHang['ngay_dat']) ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Thông tin người đặt
                  <address>
                    <strong><?= $donHang['ho_ten'] ?></strong><br>
                    Email : <?= $donHang['email'] ?><br>
                    Số điện thoại : <?= $donHang['so_dien_thoai'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Người nhận
                  <address>
                    <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                    Email : <?= $donHang['email_nguoi_nhan'] ?><br>
                    Số điện thoại : <?= $donHang['sdt_nguoi_nhan'] ?><br>
                    Địa chỉ : <?= $donHang['dia_chi_nguoi_nhan'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  
                  <address>
                    <strong>Mã đơn hàng <?= $donHang['ma_don_hang'] ?></strong><br><br>
                    Tổng tiền : <?= $donHang['tong_tien'] ?><br>
                    Ghi chú : <?= $donHang['ghi_chu'] ?><br>
                    Thanh toán : <?= $donHang['ten_phuong_thuc'] ?>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $tong_tien = 0; ?>
                    <?php foreach($sanPhamDonHang as $key=>$sanPham): ?>
                    <tr>
                      <td><?= $key+1 ?></td>
                      <td><?= $sanPham['ten_san_pham'] ?></td>
                      <td><?= $sanPham['don_gia'] ?></td>
                      <td><?= $sanPham['so_luong'] ?></td>
                      <td><?= $sanPham['thanh_tien'] ?></td>
                      
                    </tr>
                    <?php $tong_tien += $sanPham['thanh_tien']; ?>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                
                <div class="col-6">
                  <p class="lead">Ngày đặt hàng : <?= formatDate($donHang['ngay_dat']) ?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Thành tiền:</th>
                        <td><?php echo $tong_tien ?></td>
                      </tr>
                      <tr>
                        <th>Phí vận chuyển :</th>
                        <td> 50.000 </td>
                      </tr>
                      <tr>
                        <th>Tổng tiền :</th>
                        <td><?= $tong_tien + 50000 ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <!-- <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div> -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 <?php include "./views/layout/footer.php" ?>
<!-- end footer -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>