<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';

// Route
$act = $_GET['act'] ?? '/';


match ($act) {
    '/' => (new AdminDanhMucController())->danhSachDanhMuc(),
    // route danh mục
    
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-create-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'create-danh-muc' => (new AdminDanhMucController())->AddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucController())->editDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),
    
    //route sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'create-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'edit-san-pham' => (new AdminSanPhamController())->formEditSanPham(),
    'sua-album-anh-san-pham' => (new AdminSanPhamController())->editAnhSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),

    //route đơn hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'form-sua-don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    // 'edit-don-hang' => (new AdminDonHangController())->formEditDonHang(),
    // 'xoa-don-hang' => (new AdminDonHangController())->deleteDonHang(),
    // 'chi-tiet-don-hang' => (new AdminDonHangController())->detailSanPham(),
    
};