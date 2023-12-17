<?php

include 'Database.php';

class Mahasiswa extends Database
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $sql = "SELECT * FROM mahasiswa";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // search 
    function search($keyword)
    {
        $sql = "SELECT * FROM mahasiswa WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR program_studi LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function input($nim, $nama, $prodi, $no_hp)
    {
        // cek nim dan no_hp sudah ada atau belum
        $sql = "SELECT * FROM mahasiswa WHERE nim = ? OR no_hp = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('ss', $nim, $no_hp);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['nim'] == $nim) {
            echo "<script>alert('Nim sudah terdaftar!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
        } else if ($row['no_hp'] == $no_hp) {
            echo "<script>alert('No Hp sudah terdaftar!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
        } else {
            $sql = "INSERT INTO mahasiswa (nim, nama, program_studi, no_hp) VALUES (?, ?, ?, ?)";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bind_param('isss', $nim, $nama, $prodi, $no_hp);
            $stmt->execute();
            echo "<script>alert('Data berhasil ditambahkan!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
        }
    }

    function edit($nim)
    {
        $sql = "SELECT * FROM mahasiswa WHERE nim = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('s', $nim); // Karena nim mungkin berupa string, gunakan 's' untuk bind_param
        $stmt->execute();
        $result = $stmt->get_result();

        // Ambil data dari hasil eksekusi query
        $data = $result->fetch_assoc();

        return $data; // Kembalikan data dalam bentuk array asosiatif
    }

    function update($nim, $nama, $prodi, $no_hp)
    {
        $sql = "UPDATE mahasiswa SET nama = ?, program_studi = ?, no_hp = ? WHERE nim = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('sssi', $nama, $prodi, $no_hp, $nim);
        $stmt->execute();
        echo "<script>alert('Data berhasil diupdate!')</script>";
        echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
    }
    


    function delete($nim)
    {
        $sql = "DELETE FROM mahasiswa WHERE nim = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('i', $nim);
        $stmt->execute();
    }
}

?>