<?php
require_once "../connect-db.php";
class Customer extends Connection{
    public function getData($name, $phone){
        $sql = "SELECT * FROM customer " . ($name != null ? "WHERE cusName LIKE '%{$name}%'" . ($phone != null ? " AND cusPhone LIKE '%{$phone}%'" : ' ')
            : ($phone != null ? " WHERE cusPhone LIKE '%{$phone}%'" : ' '));
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function cusDetail($id){
        $sql = "SELECT * FROM customer WHERE cusId = '$id'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll()[0];
    }

    public function cusUpdate($data){
        $sql = "UPDATE customer SET cusName=:cusName,cusContact=:cusContact,
        cusPhone=:cusPhone,cusAddress=:cusAddress,cusGPP=:cusGPP,cusGPPDate=:cusGPPDate,
        cusGPPAddr=:cusGPPAddr, cusStatus=:cusStatus WHERE cusId=:cusId";
        $update = $this->prepareSQL($sql);
        $update->execute($data);
    }  
    public function cusDelete($cusId){
        $sql = "DELETE FROM customer WHERE cusId = '$cusId';";
        $sql = $sql."DELETE FROM cart WHERE cusId = '$cusId'; ";        
        $update = $this->prepareSQL($sql);
        $update->execute();
    }    
}
