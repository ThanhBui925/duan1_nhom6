<?php 
class AdminTaiKhoanController{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;
    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }
    public function danhSachQuanTri(){
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        // var_dump($listQuanTri); die;
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }
  

    public function postAddQuanTri(){
        // hàm này xử lí thêm dữ liệu
        // Kiểm tra xem dữ liệu có phải được submit lên không
        if($_SERVER['REQUEST_METHOD'] == "POST"){
          // Lấy ra dữ liệu
          $ho_ten = $_POST['ho_ten'];
          $email = $_POST['email'];

          // Tạo 1 mảng trống chứa dữ liệu 
          $error = [];
          if(empty($ho_ten)){
            $error["ho_ten"] = "Họ tên không được bỏ trống !";
          }
          if(empty($email)){
            $error["email"] = "Email không được bỏ trống !";
          }
          $_SESSION["error"] = $error;
          // var_dump($error);die;
          // Nếu không có lỗi thì tiến hành thêm tài khoản
          if(empty($error)){
            // Nếu không có lỗi tiến hành thêm tài khoản
            // var_dump("đã nhận dc dữ liệu");
            // đặt pass mặc định  - 123@123ab
            $password = password_hash("123@123ab", PASSWORD_BCRYPT);
            // var_dump($password);die;
            // Khai báo chức vụ
            $position_id = 1;
            // var_dump($position_id);die;         
            $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $position_id);

            header("Location: " .BASE_URL_ADMIN. '?act=list-tai-khoan-quan-tri');
            exit();
          }else
            // Nếu có lỗi trả về form và lỗi
            $_SESSION['flash'] = true;
            header("Location: " .BASE_URL_ADMIN. '?act=form-them-quan-tri');
            exit();
        }
      } 

      public function formEditQuanTri(){
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }

    public function postEditQuanTri(){
      // Kiểm tra xem dữ liệu có phải được submit lên không
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Lấy ra dữ liệu
        // Lấy ra dữ liệu cũ của sản phẩm
        $quan_tri_id = $_POST['quan_tri_id'] ?? '';
        $ho_ten = $_POST['ho_ten'] ?? '';
        $email = $_POST['email'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
       

      // var_dump($_POST);die;
        // Tạo 1 mảng trống chứa dữ liệu 
        $error = [];
        if(empty($ho_ten)){
          $error["ho_ten"] = "Tên người dùng không được bỏ trống !";
        }
        if(empty($email)){
          $error["email"] = "Email người dùng không được bỏ trống !";
        }
        if(empty($trang_thai)){
          $error["trang_thai"] = "Vui lòng chọn trạng thái !";
        }
        $_SESSION['error'] = $error;
    
        if(empty($error)){
          $this->modelTaiKhoan->updateTaiKhoan(
                                            $quan_tri_id,
                                            $ho_ten,
                                            $email,
                                            $so_dien_thoai,
                                            $trang_thai 
                                          );
                                          // var_dump($trang_thai_id);die;
    
          header("Location: " .BASE_URL_ADMIN. '?act=list-tai-khoan-quan-tri');
          exit();
        }else
          // Nếu có lỗi trả về form và lỗi
          // Đặt chỉ tị và xóa session sau khi hiển thị from
          $_SESSION['flash'] = true;
          header("Location: " .BASE_URL_ADMIN. '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
          exit();
      }
    }

    public function resetPassword(){
      $tai_khoan_id = $_GET["id_quan_tri"];
      $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
       // đặt pass mặc định  - 123@123ab
       $password = password_hash("123@123ab", PASSWORD_BCRYPT);
      //  $password = "123@123ab";
      $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
      if($status && $tai_khoan["position_id"] == 1){
        header("Location: " .BASE_URL_ADMIN. '?act=list-tai-khoan-quan-tri');
        exit();
      }elseif($status && $tai_khoan["position_id"] == 2){
        header("Location: " .BASE_URL_ADMIN. '?act=list-tai-khoan-khach-hang');
        exit();
        
      }else{
        var_dump("Lỗi khi reset tài khoản"); die;
      }
    }
  public function danhSachKhachHang(){
      $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
      // var_dump($listQuanTri); die;
      require_once './views/taikhoan/khachhang/listKhachHang.php';
  }
  
  public function formEditKhachHang(){
    $id_khach_hang = $_GET['id_khach_hang'];
    $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
    // var_dump($quanTri);die;
    require_once './views/taikhoan/khachhang/editKhachHang.php';
    deleteSessionError();
  }



  public function postEditKhachHang(){
    // Kiểm tra xem dữ liệu có phải được submit lên không
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      // Lấy ra dữ liệu
      // Lấy ra dữ liệu cũ của sản phẩm
      $khach_hang_id = $_POST['khach_hang_id'] ?? '';
      $ho_ten = $_POST['ho_ten'] ?? '';
      $email = $_POST['email'] ?? '';
      $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
      $trang_thai = $_POST['trang_thai'] ?? '';
      $dia_chi = $_POST['dia_chi'] ?? '';
      $ngay_sinh = $_POST['ngay_sinh'] ?? '';
      $gioi_tinh = $_POST['gioi_tinh'] ?? '';
      // var_dump($_POST);die;
      

    // var_dump($_POST);die;
      // Tạo 1 mảng trống chứa dữ liệu 
      $error = [];
      if(empty($ho_ten)){
        $error["ho_ten"] = "Tên người dùng không được bỏ trống !";
      }
      if(empty($email)){
        $error["email"] = "Email người dùng không được bỏ trống !";
      }
      if(empty($trang_thai)){
        $error["trang_thai"] = "Vui lòng chọn trạng thái !";
      }
      if(empty($ngay_sinh)){
        $error["ngay_sinh"] = "Vui lòng chọn ngày sinh !";
      }
      if(empty($gioi_tinh)){
        $error["gioi_tinh"] = "Vui lòng chọn giới tính !";
      }
      // if(empty($dia_chi)){
      //   $error["dia_chi"] = "Địa chỉ không được bỏ trống !";
      // }
      $_SESSION['error'] = $error;
  
      if(empty($error)){
        $this->modelTaiKhoan->updateKhachHang($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $trang_thai, $ngay_sinh, $gioi_tinh, $dia_chi);
                                        // var_dump($gioi_tinh);die;
  
        header("Location: " .BASE_URL_ADMIN. '?act=list-tai-khoan-khach-hang');
        exit();
      }else
        // Nếu có lỗi trả về form và lỗi
        // Đặt chỉ tị và xóa session sau khi hiển thị from
        $_SESSION['flash'] = true;
        header("Location: " .BASE_URL_ADMIN. '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
        exit();
    }
  }


  public function detailKhachHang(){
    $id_khach_hang = $_GET["id_khach_hang"]; // lấy từ đường dẫn url
    $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

    $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);

    $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);
    require_once "./views/taikhoan/khachhang/detailKhachHang.php";

}


public function formLogin(){
  require_once "./views/auth/formLogin.php";
  deleteSessionError();
}
 public function login(){
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Lấy email và pass gửi lên từ form
    $email = $_POST['email'];
    $password = $_POST['password'];
    // var_dump($password);

    // Xử lí kiểm tra thông tin đăng nhập
    $user = $this->modelTaiKhoan->checkLogin($email, $password);

    if($user == $email){ // TH đăng nhập thành công
      // Lưu thông tin vào session
      $_SESSION["user_admin"] = $user;
      
      echo "<script>
            alert('Đăng nhập thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
            </script>";
            exit();
    }else{
      // Lỗi thì lưu lỗi vào SESSION
      $_SESSION["error"] = $user;
      // var_dump($_SESSION["error"]);die();
      // var_dump($_SESSION['error']);die();
      $_SESSION["flash"] = true;
      header("Location: " .BASE_URL_ADMIN. "?act=login-admin");
      exit();

    }
  }
 }
 public function logout(){
  if(isset($_SESSION["user_admin"])){
    unset($_SESSION['user_admin']);
    header("Location: ". BASE_URL_ADMIN . "?act=login-admin");
  }
}

public function formEditCaNhanQuanTri(){
  $email = $_SESSION['user_admin'];
  $thongTin = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
  // var_dump($thongTin);die;

  require_once "./views/taikhoan/canhan/editCaNhan.php";
  deleteSessionError();

}
 public function postEditMatKhauCaNhan(){
  // var_dump($_POST);die();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $old_pass = $_POST["old_pass"];
    $new_pass = $_POST["new_pass"];
    $confirm_pass = $_POST["confirm_pass"];

  

    $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION["user_admin"]);
    
    $checkPass = password_verify($old_pass, $user["mat_khau"]);
    
    $error = [];
    if(!$checkPass){
      $error["old_pass"] = "Mật khẩu người dùng không đúng !";
    }
    if($new_pass !== $confirm_pass){
      $error["confirm_pass"] = "Mật khẩu nhập lại không đúng !";
    }
    // Validate 
    if(empty($old_pass)){
      $error["old_pass"] = "Mật khẩu cũ không được bỏ trống !";
    }
    if(empty($new_pass)){
      $error["new_pass"] = "Nhập mật khẩu mới không được bỏ trống !";
    }
    if(empty($confirm_pass)){
      $error["confirm_pass"] = "Xác minh lại mật khẩu mới không được bỏ trống !";
    }
    $_SESSION ['error'] = $error;
    if(!$error){ // Nếu không có lỗi gì
      $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
      $status = $this->modelTaiKhoan->resetPassword($user["id"], $hashPass);// Thực hiện đổi mật khẩu
      if($status){
        $_SESSION['success'] = "Đã sửa thành công !";
        $_SESSION['flash'] = true;
        header("Location:" .BASE_URL_ADMIN. "?act=form-sua-thong-tin-ca-nhan-quan-tri");
      }
    }else{
       
      $_SESSION["flash"] = true;
      header("Location: " .BASE_URL_ADMIN. "?act=form-sua-thong-tin-ca-nhan-quan-tri");
      exit();

    }

 }

}



 }




?>