<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
// Route
$act = $_GET['act'] ?? '/';


match ($act) {
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
    
};