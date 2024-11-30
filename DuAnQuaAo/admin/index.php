<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';


// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';
// Route
$act = $_GET['act'] ?? '/';
if($act !== "login-admin" && $act !== "check-login-admin" && $act !== "logout-admin"){
checkLoginAdmin();
}

match ($act) {
    // route
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(), //Phương thức hiển thị form
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(), //Xử lí nhận và post vào CSDL
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(), //Phương thức hiển thị form sửa
    'sua-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc(), //Xử lí nhận và cập nhật vào CSDL 
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(), //Xử lí nhận và cập nhật vào CSDL 
    // end route danh mục

    //route sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'create-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'edit-san-pham' => (new AdminSanPhamController())->formEditSanPham(),
    'sua-album-anh-san-pham' => (new AdminSanPhamController())->editAnhSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),

    // route bình luận (update ẩn bỏ ẩn)
    'update-trang-thai-binh-luan'=> (new AdminSanPhamController())->updateTrangThaiBinhLuan(),



    // route quản lý đơn hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(), //Phương thức hiển thị form sửa
    'sua-don-hang' => (new AdminDonHangController())->postEditDonHang(), //Xử lí nhận và cập nhật vào CSDL  
    'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang(), //Phương thức hiển thị form sửa

    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),

    // route quản lí tài khoản
        // quản lí tài khoản quản trị
        'list-tai-khoan-quan-tri' =>(new AdminTaiKhoanController())->danhSachQuanTri(),
        'form-them-quan-tri' =>(new AdminTaiKhoanController())->formAddQuanTri(),
        'them-quan-tri' =>(new AdminTaiKhoanController())->postAddQuanTri(),
        'form-sua-quan-tri'=>(new AdminTaiKhoanController())->formEditQuanTri(),
        'sua-quan-tri'=>(new AdminTaiKhoanController())->postEditQuanTri(),

        // route reset password tài khoản 
        'reset-password'=>(new AdminTaiKhoanController())->resetPassword(),

        // Quản lý tài khoản khách hàng
        'list-tai-khoan-khach-hang' =>(new AdminTaiKhoanController())->danhSachKhachHang(),
        'form-sua-khach-hang'=>(new AdminTaiKhoanController())->formEditKhachHang(),
        'sua-khach-hang'=>(new AdminTaiKhoanController())->postEditKhachHang(),
        'chi-tiet-khach-hang' =>(new AdminTaiKhoanController())->detailKhachHang(),

        // Quản lí thông tin cá nhân (Quản trị)
        'form-sua-thong-tin-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
        // 'sua-thong-tin-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->postEditCaNhanQuanTri(),
    

        'sua-mat-khau-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->postEditMatKhauCaNhan(),

    //Route auth
    'login-admin' => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin' => (new AdminTaiKhoanController())->logout(),
};