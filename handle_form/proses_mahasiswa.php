<?php 

include '../class/Mahasiswa.php';

$mahasiswa = new Mahasiswa();

$aksi = $_GET['aksi'];

if($aksi == "tambah"){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $no_hp = $_POST['no_hp'];
    $mahasiswa->input($nim, $nama, $prodi, $no_hp);
    
}else if($aksi == "cari"){
    $keyword = $_POST['keyword'];
    $mahasiswa->search($keyword);

    header("location: ../data_mahasiswa.php");
}else if($aksi == "edit"){
    $nim = $_POST['nim'];
    $mahasiswa->edit($nim);
}else if($aksi == "update"){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $no_hp = $_POST['no_hp'];
    $mahasiswa->update($nim, $nama, $prodi, $no_hp);
}else if($aksi == "hapus"){
    $nim = $_GET['nim'];
    $mahasiswa->delete($nim);
}


?>