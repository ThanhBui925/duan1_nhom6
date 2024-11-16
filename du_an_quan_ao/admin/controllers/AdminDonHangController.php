<?php
class AdminDonHangController{
  
    public $modelDonHang;
    public function __construct()
    {
      $this->modelDonHang = new AdminDonHang();
    } 
        
    public function danhSachDonHang(){
        
        $listDonHang = $this->modelDonHang->getAllDonHang();
        // var_dump($listDonHang); die();
        require_once './views/donhang/listDonHang.php';
    }
    public function detailDonHang(){
        $order_id = $_GET['id_don_hang'];
        // var_dump($order_id);die;
        $donHang = $this->modelDonHang->getDetailDonHang($order_id);

        //lấy danh sách sản phẩm của đơn hàng đăth ở bảng oder_details
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($order_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        // var_dump($sanPhamDonHang);die;
        require_once './views/donhang/detailDonHang.php';
    }
    public function formEditDonHang(){
        $order_id = $_GET['id_don_hang'];
        // var_dump($order_id);die;
        $donHang = $this->modelDonHang->getDetailDonHang($order_id);
        // var_dump($donHang);die;
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if($donHang){
            require_once  './views/donhang/editDonHang.php';
        }else{
            echo "<script>
            window.location.href = '" . BASE_URL_ADMIN . "?act=don-hang';
             </script>";
             exit();
        }
    }
    
    public function editDonHang(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Lấy dữ liệu
        //Lấy dữ liệu cũ của sản phẩm
        $order_id = $_POST['id_don_hang'] ?? '';
        //truy vấn

        $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
        $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
        $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
        $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
        $ghi_chu = $_POST['ghi_chu'] ?? '';
        $trang_thai_id = $_POST['order_status_id'] ?? '';
        

        // tạo 1 mảng rỗng chứa dữ liệu
        $errors = [];
        if(empty($ten_nguoi_nhan)){
          $errors['$ten_nguoi_nhan'] = 'Tên người nhận không được bỏ trống';
          // return;
        }
        if(empty($sdt_nguoi_nhan)){
          $errors['sdt_nguoi_nhan'] = 'Số điện thoại không được bỏ trống';
        }
        if(empty($email_nguoi_nhan)){
          $errors['email_nguoi_nhan'] = 'Email không được bỏ trống';
        }
        if(empty($dia_chi_nguoi_nhan)){
          $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ người nhận không được bỏ trống';
        }
        
        if(empty($trang_thai_id)){
          $errors['order_status_id'] = 'Trạng thái phải được chọn';
        }
        
        $_SESSION['error'] = $errors;
        if(empty($errors)){
           $result = $this->modelDonHang->updateDonHang($order_id,$ten_nguoi_nhan,$sdt_nguoi_nhan, $email_nguoi_nhan, 
                                              $dia_chi_nguoi_nhan, $ghi_chu,
                                              $trang_thai_id);

            // var_dump($result);die();
            echo "<script>
            alert('Sửa đơn hàng thành công thành công');
            window.location.href = '" . BASE_URL_ADMIN . "?act=don-hang';
            </script>";
            exit();
        }else{
          $_SESSION['flash'] = true;
          header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $order_id);
            exit();
          //trả lỗi về form
        }
      }

    }
//     public function editAnhSanPham(){
//       if($_SERVER['REQUEST_METHOD'] == 'POST'){
//           $product_id = $_POST['product_id'] ?? '';
//           //Lấy danh sách ảnh sản phẩm hiện tại
//           $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($product_id);
          
//           //Xử lý các ảnh được gửi từ form
//           $img_array = $_FILES['img_array'];
//           $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
//           $current_img_ids = $_POST['current_img_ids'] ?? [];
          
//           //Khai báo mảng để lưu ảnh thêm mới hoăc thay thế
//           $upload_file = [];
//           foreach($img_array['name'] as $key=>$value){
//             if($img_array['error'][$key] == UPLOAD_ERR_OK){
//               $new_file = uploadFileAlbum($img_array, './uploads/', $key);
//               if($new_file){
//                 $upload_file[] = [
//                   'id' => $current_img_ids[$key] ?? null,
//                   'file' => $new_file
//                 ];
//               }
//             }
//           }
//           //Lưu ảnh mới vào db và xóa ảnh cũ
//           // var_dump($upload_file);die();
//           foreach($upload_file as $file_info){
//             if($file_info['id']){
//               $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
//               //Cập nhật ảnh cũ
//               $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
//               //Xóa ảnh cũ
//               deleteFile($old_file);
//             }else{
//               //thêm ảnh mới
//               $this->modelSanPham->insertAlbumAnhSanPham($product_id, $file_info['file']);
//             }
//           }
//           //xử lý xóa ảnh
//           foreach($listAnhSanPhamCurrent as $anhSanPham){
//             $anh_id = $anhSanPham['id'];
//             if(in_array($anh_id, $img_delete)){
//               //Xóa ảnh
//               $this->modelSanPham->destroyAnhSanPham($anh_id);
//               //xóa file
//               deleteFile($anhSanPham['link_hinh_anh']);
//             }
//           }
//           echo "<script>
//             alert('Sửa album ảnh thành công');
//             window.location.href = '" . BASE_URL_ADMIN . "?act=edit-san-pham&id_san_pham=". $product_id ."';
//             </script>";
//             exit();
//       }
//   }
//   public function deleteSanPham(){
//     $id = $_GET['id_san_pham'];
//     $sanPham = $this->modelSanPham->getDetailSanPham($id);
//     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    
//     if ($sanPham) {
//         // Kiểm tra và xóa ảnh sản phẩm trong bảng product_images trước
//         if ($listAnhSanPham) {
//             foreach ($listAnhSanPham as $key => $anhSP) {
//                 deleteFile($anhSP['link_hinh_anh']); // Xóa file ảnh vật lý (nếu cần)
//                 $this->modelSanPham->destroyAnhSanPham($anhSP['id']); // Xóa ảnh trong db
//             }
//         }

//         // Sau khi xóa ảnh xong, xóa sản phẩm
//         deleteFile($sanPham['hinh_anh']); // Xóa file ảnh chính của sản phẩm (nếu cần)
//         $this->modelSanPham->destroySanPham($id);

//         // Xác nhận xóa thành công
//         echo "<script>
//                 alert('Xóa thành công sản phẩm');
//                 window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
//               </script>";
//         exit();
//     }
// }
// public function detailSanPham(){
//   $id = $_GET['id_san_pham'];
//   $sanPham = $this->modelSanPham->getDetailSanPham($id);
//   $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
// // var_dump($listAnhSanPham);die();
//   $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
//   if($sanPham){
//     require_once './views/sanpham/detailSanPham.php';
//   }else{
//     echo "<script>
//     window.location.href = '" . BASE_URL_ADMIN . "?act=san-pham';
//     </script>";
//     exit();
//   }

// }
    //sửa album ảnh

    //k sửa ảnh cũ
    // xóa ảnh cũ
    
    
}