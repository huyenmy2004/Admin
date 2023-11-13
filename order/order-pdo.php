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
}
?>