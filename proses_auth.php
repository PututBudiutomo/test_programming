<?php 
include 'Auth.php';
$auth = new Auth();

$aksi = $_GET['aksi'];

if($aksi == "login"){
    $email= $_POST['email'];
    $password = $_POST['password'];
    $auth->login($email, $password);
}else if($aksi == "register"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $auth->register($nama, $email, $password);
}else if($aksi == "logout"){
    $auth->logout();
}

?>