<?php
require_once "../connect-db.php";
class Brand extends Connection{
    public function getData() {
        $sql = "SELECT * FROM brand";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }

    public function createNewBrand($data) {
        // Giả sử bạn có tạo một table tên là 'brands' với các trường 'brandId', 'brandName', 'brandLogo', 'brandDescription'
        $sql = "INSERT INTO brand (brandName, brandLogo, brandDescription) VALUES (:brandName, :brandLogo, :brandDescription)";
        $stmt = $this->prepareSQL($sql);
        $stmt->execute($data);
    }


    public function updateBrand($brandId, $data) {
        $sql = "UPDATE brand SET brandName = :brandName, brandDescription = :brandDescription, brandLogo = :brandLogo WHERE brandId = :brandId";
        $update = $this->prepareSQL($sql);
        $data['brandId'] = $brandId;
        $update->execute($data);
    }

    public function deleteBrand($brandId) {
        $sql = "DELETE FROM brand WHERE brandId = :brandId";
        $delete = $this->prepareSQL($sql);
        $delete->execute(['brandId' => $brandId]);
    }

    public function getBrandById($brandId) {
        $sql = "SELECT * FROM brand WHERE brandId = :brandId";
        $select = $this->prepareSQL($sql);
        $select->execute(['brandId' => $brandId]);
        return $select->fetch();
    }
    
    public function searchBrandByContent($searchKeyword) {
        $sql = "SELECT * FROM brand WHERE brandName LIKE '%{$searchKeyword}%'";
        $select = $this->prepareSQL($sql);
        $select->execute(['searchKeyword' => '%' . $searchKeyword . '%']);
        return $select->fetchAll();
    }

}
?>


    
    