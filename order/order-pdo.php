<?php
require_once("../connect-db.php");
class Order extends Connection
{
    public function getData($name, $status)
    {
        $sql = "SELECT orders.*, cusName, cusPhone, cusAddress, SUM(prodNumber*prodOldPrice) AS total FROM
        product_order JOIN orders ON orders.orderId = product_order.orderId
        JOIN customer ON orders.cusId = customer.cusId " . ($name != null ? "WHERE customer.cusName LIKE '%{$name}%'" . ($status != null ? " AND orderStatus = '$status'" : ' ')
        : ($status != null ? "WHERE orders.orderStatus = $status" : ' ')) .
        " GROUP BY orderId
        ORDER BY orderDate desc";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function detail($order){
        $sql = "SELECT *, SUM(prodNumber) AS num, SUM(prodNumber*prodOldPrice) AS total FROM product INNER JOIN product_order ON product.SKU = product_order.SKU 
        INNER JOIN orders ON product_order.orderId = orders.orderId 
        INNER JOIN customer ON orders.cusId = customer.cusId
        INNER JOIN product_img ON product_img.SKU = product.SKU
        INNER JOIN brand ON brand.brandId = product.brandId WHERE orders.orderId  = '$order'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function brandInOrder($order){
        $sql = "SELECT brand.brandName FROM product INNER JOIN product_order ON product.SKU = product_order.SKU 
        INNER JOIN orders ON product_order.orderId = orders.orderId 
        INNER JOIN customer ON orders.cusId = customer.cusId
        INNER JOIN brand ON brand.brandId = product.brandId WHERE orders.orderId  = '$order' 
        GROUP BY brand.brandId;";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function updateOrder($status, $id){
        $sql = "UPDATE orders SET orderStatus = $status WHERE orderId = '$id'";
        $update = $this->prepareSQL($sql);
        $update->execute();
    }
    public function orderDelete($id){
        $sql = "DELETE FROM product_order WHERE orderId='$id';DELETE FROM orders WHERE orderId = '$id'";
        $select = $this->prepareSQL($sql);
        $select->execute();
    }
}
?>