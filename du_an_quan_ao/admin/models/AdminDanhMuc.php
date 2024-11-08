<?php 
class AdminDanhMuc{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc(){
        try{
            $sql = "SELECT * FROM categories";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    public function insertDanhMuc($tenDanhMuc, $moTa){
        try {
            $sql = "INSERT INTO categories (ten_danh_muc, mo_ta)
                    VALUE (:tenDanhMuc, :moTa)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tenDanhMuc' => $tenDanhMuc,
                ':moTa' => $moTa
            ]);

            return $stmt->fetchAll();
        } catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    public function getDetailDanhMuc($id){
        try {
            $sql = "SELECT * FROM categories WHERE id = :id" ;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
    public function updateDanhMuc($id, $tenDanhMuc, $moTa){
        try {
            $sql = "UPDATE categories SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tenDanhMuc' => $tenDanhMuc,
                ':moTa' => $moTa,
                ':id' => $id
            ]);

            return true;
        } catch(Exception $e){
            echo "Lỗi".      $e->getMessage();
        }
    }
}

?>