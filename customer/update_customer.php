<?php
require_once "../connect-db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $conn = connectDB();

    $cusId = $_POST['cusId'];

 
    $newCusName = $_POST['cusName'];
    $newCusContact = $_POST['cusContact'];
    $newCusPhone = $_POST['cusPhone'];
    $newcusAddress = $_POST['cusAddress'];
    $newcusGPP = $_POST['cusGPP'];
    $newcusGPPDate = $_POST['cusGPPDate'];
    $newcusGPPAddr = $_POST['cusGPPAddr'];
 

   
    $updateInfoQuery = "UPDATE customer SET cusName = '$newCusName', cusContact = '$newCusContact', cusPhone = '$newCusPhone', cusAddress ='$newcusAddress', cusGPP = '$newcusGPP', cusGPPDate ='$newcusGPPDate', cusGPPAddr='$newcusGPPAddr' WHERE cusId = '$cusId'";
    $resultUpdate = $conn->query($updateInfoQuery);

    if ($resultUpdate) {
        
        header("Location: Customer.php");
        exit();
    } else {
       
        echo "Cập nhật thông tin thất bại!";
    }
}
?>
