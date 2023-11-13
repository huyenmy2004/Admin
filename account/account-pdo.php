<?php
require_once("../connect-db.php");
class Account extends Connection
{
    public function getData($name)
    {
        $sql = "SELECT * FROM account JOIN customer ON customer.username = account.username" . ($name != null ? " WHERE cusName LIKE '%{$name}%'" : '');
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function delete($username, $id){
        $sql =  "DELETE FROM customer WHERE cusId = '$username';" . "DELETE FROM account WHERE username = '$username';"
        . "DELETE FROM cart WHERE cusId = '$id';";
        $delete = $this->prepareSQL($sql);
        $delete->execute();
    }
    public function check($cusId){
        $sql ="SELECT orderId FROM orders WHERE cusId = '$cusId'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
}