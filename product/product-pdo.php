<?php
require_once "../connect-db.php";
class Product extends Connection{
    public function getData($name, $status){
        $sql = "SELECT * FROM product " . ($name != null ? "WHERE prodName LIKE '%{$name}%'" . ($status != null ? " AND prodStatus = '$status'" : ' ')
            : ($status != null ? "WHERE prodStatus = $status" : ' ')) . " ORDER BY prodCreatedDate desc";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function createNewProduct($data){
        $sql = "INSERT INTO product VALUES (:prodId, :prodTagId, :prodBrandId, :prodCateId, :prodName, :prodCountry, :prodStatus, null, null, null, null, :prodIngredient, :prodDosageForms, :prodUnit, :prodDescript, :prodDosage, :prodPrice, :prodPriceSale, :prodSellNumber);";
        $create = $this->prepareSQL($sql);
        $create->execute($data);
    }
    public function insertImg($listImg, $prodId){
        $sql = "INSERT INTO product_img VALUES ";
        foreach($listImg as $img){
            $sql = $sql."('', '$prodId', '$img'),";
        }
        $sql = rtrim($sql,',').";";
        $create = $this->prepareSQL($sql);
        $create->execute();
    }
    public function prodDetail($id){
        $sql = "SELECT * FROM product WHERE SKU = '$id'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll()[0];
    }
    public function prodDetailImg($id){
        $sql = "SELECT * FROM product_img WHERE SKU = '$id'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }

    public function prodUpdate($data){
        $sql = "UPDATE `product` SET `tagId`=:prodTagId,`brandId`=:prodBrandId,`cateId`=:prodCateId,`prodName`=:prodName,`prodCountry`=:prodCountry,`prodStatus`=:prodStatus,`prodIngredient`=:prodIngredient,`prodDosageForms`=:prodDosageForms,`prodUnit`=:prodUnit,`prodDescrip`=:prodDescript,`prodDosage`=:prodDosage,`prodPrice`=:prodPrice,`prodPriceSale`=:prodPriceSale,`prodSellNumber`=:prodSellNumber WHERE product.SKU = :prodId";
        $update = $this->prepareSQL($sql);
        $update->execute($data);
    }  
    public function prodUpdateImg($listImg, $prodId){
        $sql = "DELETE FROM `product_img` WHERE SKU = '$prodId';";
        $sql = $sql."INSERT INTO product_img VALUES ";
        foreach($listImg as $img){
            $sql = $sql."('', '$prodId', '$img'),";
        }
        $sql = rtrim($sql,',').";";
        $update = $this->prepareSQL($sql);
        $update->execute();
    } 
    public function prodDelete($prodId){
        $sql = "DELETE FROM `product_img` WHERE SKU = '$prodId';";
        $sql = $sql."DELETE FROM product WHERE SKU = '$prodId'; ";        
        $update = $this->prepareSQL($sql);
        $update->execute();
    }    
}

class Brand extends Connection{
    public function getData(){
        $sql = "SELECT * FROM brand";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
}
class Tag extends Connection{
    public function getData(){
        $sql = "SELECT * FROM tag";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
}
class Category extends Connection{
    public function getData(){
        $sql = "SELECT * FROM category";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
}