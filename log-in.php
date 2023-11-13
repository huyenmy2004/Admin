<?php
require_once "../connect-db.php";
class Login extends Connection {
    public function login($username, $password){
        $sql = "SELECT account.*, customer.*, cart.* FROM account 
        JOIN customer ON account.username = customer.username
        JOIN cart ON cart.cusId = customer.cusId
        WHERE account.username = '$username' AND account.password = '$password'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
};
session_start();
$logIn = new Login();
$user = $logIn->login($_POST['username'], $_POST['pass']);
if(count($user) == 1 ){
    $_SESSION['username'] = $user[0]['username'];
    $_SESSION['cusId'] = $user[0]['cusId'];
    $_SESSION['cartId'] = $user[0]['cartId'];
    $_SESSION['role'] = $user[0]['role'];
    if ($_SESSION['role']==0){
        header("Location: http://localhost/PharmaDI-Enduser/home/home.php");
    }
    if ($_SESSION['role']==1){
        header("Location: http://localhost/PharmaDI-Admin/product/product-list.php");
    }
}
else{
    header("Location: http://localhost/PharmaDI-Enduser/home/home-guest.php");
}