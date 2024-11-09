<?php
class AdminSanPhamController{
  
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
      $this->modelSanPham = new AdminSanPham();
      $this->modelDanhMuc = new AdminDanhMuc();
    } 
        
    public function danhSachSanPham(){
        
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }
    public function formAddSanPham(){
  
      $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

      // echo "Thêm";
      //Thêm dữ liệu
      // var_dump($_POST);
      // Kiểm tra dữ liệu có phải được gửi từ form hay k
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        $ten_san_pham = $_POST['ten_san_pham'];
        $gia_san_pham = $_POST['gia_san_pham'];
        $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
        $so_luong = $_POST['so_luong'];
        $ngay_nhap = $_POST['ngay_nhap'];
        $category_id = $_POST['danh_muc_id'];
        $trang_thai = $_POST['trang_thai'];
        $mo_ta = $_POST['mo_ta'];
        $hinh_anh = $_FILES['hinh_anh'];

        //Lưu hình ảnh vào
        $file_thumb = uploadFile($hinh_anh, './uploads/');
        //Mảng hình ảnh
        $img_array = $_FILES['img_array'];
        
        $moTa = $_POST['mo_ta'];
        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($ten_san_pham)){
          $errors['ten_san_pham'] = 'Tên sản phẩm không được bỏ trống';
          // return;
        }
        if(empty($gia_san_pham)){
          $errors['gia_san_pham'] = 'Giá sản phẩm không được bỏ trống';
        }
        if(empty($gia_khuyen_mai)){
          $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được bỏ trống';
        }
        if(empty($so_luong)){
          $errors['so_luong'] = 'Số lượng không được bỏ trống';
        }
        if(empty($ngay_nhap)){
          $errors['ngay_nhap'] = 'Ngày nhập không được bỏ trống';
        }
        if(empty($category_id)){
          $errors['danh_muc_id'] = 'Danh mục sản phẩm phải được chọn';
        }
        if(empty($trang_thai)){
          $errors['trang_thai'] = 'Trạng thái phải được chọn';
        }
        //Nếu k có lỗi thì tiến hành thêm sản phẩm
        if(empty($errors)){
          $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, 
                                              $gia_khuyen_mai, $so_luong,
                                              $ngay_nhap, $category_id,
                                              $trang_thai, $mo_ta,
                                              $file_thumb);
            echo "<script>
            alert('Thêm sản phẩm thành công thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
            </script>";
            exit();
          // header("location: " . BASE_URL_ADMIN . '?act=san-pham');
          // exit();
        }else{
          require_once './views/sanpham/addSanPham.php';
          //trả lỗi về form
        }

      } else {
      require_once './views/sanpham/addSanPham.php';
      }

    }
    // public function formEditDanhMuc(){
    //   //Hiển thị form
    //   // echo "form";
    //   //Lấy thông tin danh mục cần sửa
    //   $id = $_GET['id_danh_muc'];
    //   $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
    //   if($danhMuc){
    //     require_once './views/danhmuc/editDanhMuc.php';
    //   }else{
    //     header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
    //     exit();
    //   }
    // }
    // public function editDanhMuc(){
    //   // echo "Thêm";
    //   //Thêm dữ liệu
    //   // var_dump($_POST);
    //   // Kiểm tra dữ liệu có phải được gửi từ form hay k
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     //Lấy dữ liệu
    //     $id = $_POST['id'];
    //     $tenDanhMuc = $_POST['ten_danh_muc'];
    //     $moTa = $_POST['mo_ta'];
    //     // tạo 1 mảng rỗng chứa dữ liệu
    //     $errors = [];
    //     if(empty($tenDanhMuc)){
    //       $errors['ten_danh_muc'] = 'Tên danh mục không được bỏ trống';
    //     }
    //     //Nếu k có lỗi thì tiến hành thêm danh mục
    //     if(empty($errors)){
    //       $this->modelDanhMuc->updateDanhMuc($id, $tenDanhMuc, $moTa);
    //       header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
    //       exit();
    //     }else{
    //       //trả lỗi về form
    //       $danhMuc = ['id' => $id, 'ten_danh_muc' => $tenDanhMuc, 'mo_ta' => $moTa];
    //       require_once './views/danhmuc/editDanhMuc.php';
    //     }
    //   }
    // }
}