<?php 
class AdminSanPham{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham(){
        try{
            $sql = "SELECT products.*, categories.ten_danh_muc
        FROM products
        INNER JOIN categories ON products.category_id = categories.id";


            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    public function insertSanPham($ten_san_pham, $gia_san_pham, 
                                    $gia_khuyen_mai, $so_luong,
                                    $ngay_nhap, $danh_muc_id,
                                    $trang_thai, $mo_ta,
                                    $hinh_anh){
        try {
            $sql = "INSERT INTO products (ten_san_pham, gia_san_pham, 
                                            gia_khuyen_mai, so_luong,
                                            ngay_nhap, category_id,
                                            trang_thai, mo_ta,
                                            hinh_anh)
                                            VALUES (:ten_san_pham, :gia_san_pham, 
                                              :gia_khuyen_mai, :so_luong,
                                              :ngay_nhap, :category_id,
                                              :trang_thai, :mo_ta,
                                              :hinh_anh)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':category_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);

            return true;
        } catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    
}

?>