<?php
class AdminDanhMucController{
  
    public $modelDanhMuc;
    public function __construct()
    {
      $this->modelDanhMuc = new AdminDanhMuc();
    } 
        
    public function danhSachDanhMuc(){
        
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function formAddDanhMuc(){
      //Hiển thị form
      // echo "form";
      require_once './views/danhmuc/addDanhMuc.php';
    }
    public function AddDanhMuc(){
      // echo "Thêm";
      //Thêm dữ liệu
      // var_dump($_POST);
      // Kiểm tra dữ liệu có phải được gửi từ form hay k
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        $tenDanhMuc = $_POST['ten_danh_muc'];
        $moTa = $_POST['mo_ta'];
        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($tenDanhMuc)){
          $errors['ten_danh_muc'] = 'Tên danh mục không được bỏ trống';
        }
        //Nếu k có lỗi thì tiến hành thêm danh mục
        if(empty($errors)){
          $this->modelDanhMuc->insertDanhMuc($tenDanhMuc, $moTa);
          header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
          exit();
        }else{
          require_once './views/danhmuc/addDanhMuc.php';
          //trả lỗi về form
        }
      }
    }
    public function formEditDanhMuc(){
      //Hiển thị form
      // echo "form";
      //Lấy thông tin danh mục cần sửa
      $id = $_GET['id_danh_muc'];
      $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
      if($danhMuc){
        require_once './views/danhmuc/editDanhMuc.php';
      }else{
        header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
      }
    }
    public function editDanhMuc(){
      // echo "Thêm";
      //Thêm dữ liệu
      // var_dump($_POST);
      // Kiểm tra dữ liệu có phải được gửi từ form hay k
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        $id = $_POST['id'];
        $tenDanhMuc = $_POST['ten_danh_muc'];
        $moTa = $_POST['mo_ta'];
        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($tenDanhMuc)){
          $errors['ten_danh_muc'] = 'Tên danh mục không được bỏ trống';
        }
        //Nếu k có lỗi thì tiến hành thêm danh mục
        if(empty($errors)){
          $this->modelDanhMuc->updateDanhMuc($id, $tenDanhMuc, $moTa);
          header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
          exit();
        }else{
          //trả lỗi về form
          $danhMuc = ['id' => $id, 'ten_danh_muc' => $tenDanhMuc, 'mo_ta' => $moTa];
          require_once './views/danhmuc/editDanhMuc.php';
        }
      }
    }
}