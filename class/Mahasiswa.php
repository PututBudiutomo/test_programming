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

    // Metode pencarian
    function search($keyword)
    {
        $sql = "SELECT * FROM mahasiswa WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR program_studi LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function input($nim, $nama, $prodi, $no_hp, $foto)
    {
        // Validasi jenis file yang diunggah
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpeg',]; // Tipe file yang diizinkan
        $file_type = $_FILES['foto']['type'];
        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Tipe file tidak didukung. Hanya gambar JPEG dan PNG yang diizinkan.')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        }

        // Validasi ukuran file yang diunggah
        $max_size = 5 * 1024 * 1024; // Ukuran maksimal 5MB
        $file_size = $_FILES['foto']['size'];
        if ($file_size > $max_size) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 5MB yang diizinkan.')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        }

        // Memeriksa apakah nim atau no_hp sudah terdaftar sebelumnya
        $sql = "SELECT * FROM mahasiswa WHERE nim = ? OR no_hp = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('ss', $nim, $no_hp);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['nim'] == $nim) {
            echo "<script>alert('Nim sudah terdaftar!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        } else if ($row['no_hp'] == $no_hp) {
            echo "<script>alert('No Hp sudah terdaftar!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        } else {
            // Simpan file foto ke direktori '../assets/img'
            $file_name = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            $file_destination = '../assets/img/mahasiswa/' . $file_name;
            move_uploaded_file($file_tmp, $file_destination);

            // Simpan data mahasiswa ke database termasuk nama file foto
            $sql_insert = "INSERT INTO mahasiswa (nim, nama, program_studi, no_hp, foto) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $this->koneksi->prepare($sql_insert);
            $stmt_insert->bind_param('issss', $nim, $nama, $prodi, $no_hp, $file_name);
            $stmt_insert->execute();
            echo "<script>alert('Data berhasil ditambahkan!')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
        }
    }

    function edit($nim)
    {
        $sql = "SELECT * FROM mahasiswa WHERE nim = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('s', $nim);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }

    function update($nim, $nama, $prodi, $no_hp, $foto)
    {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg',]; // Tipe file yang diizinkan
        $file_type = $_FILES['foto']['type'];
        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Tipe file tidak didukung. Hanya gambar JPEG dan PNG yang diizinkan.')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        }

        $max_size = 5 * 1024 * 1024; // Ukuran maksimal 5MB
        $file_size = $_FILES['foto']['size'];
        if ($file_size > $max_size) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 5MB yang diizinkan.')</script>";
            echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            exit();
        }

        $sql = "SELECT * FROM mahasiswa WHERE (nim = ? OR no_hp = ?) AND nim != ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('ssi', $nim, $no_hp, $nim);
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
            if ($foto == null) {
                $sql = "UPDATE mahasiswa SET nama = ?, program_studi = ?, no_hp = ? WHERE nim = ?";
                $stmt = $this->koneksi->prepare($sql);
                $stmt->bind_param('sssi', $nama, $prodi, $no_hp, $nim);
                $stmt->execute();
                echo "<script>alert('Data berhasil diupdate!')</script>";
                echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            } else {
                $sql_select = "SELECT * FROM mahasiswa WHERE nim = ?";
                $stmt_select = $this->koneksi->prepare($sql_select);
                $stmt_select->bind_param('s', $nim);
                $stmt_select->execute();
                $result_select = $stmt_select->get_result();
                $row_select = $result_select->fetch_assoc();
                unlink('../assets/img/mahasiswa/' . $row_select['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/mahasiswa/' . $_FILES['foto']['name']);
                $foto = $_FILES['foto']['name'];

                $sql_update = "UPDATE mahasiswa SET nama = ?, program_studi = ?, no_hp = ?, foto = ? WHERE nim = ?";
                $stmt_update = $this->koneksi->prepare($sql_update);
                $stmt_update->bind_param('ssssi', $nama, $prodi, $no_hp, $foto, $nim);
                $stmt_update->execute();
                echo "<script>alert('Data berhasil diupdate!')</script>";
                echo "<script>window.location.href = '../data_mahasiswa.php'</script>";
            }
        }
    }

    function delete($nim)
    {
        
        $sql_select = "SELECT * FROM mahasiswa WHERE nim = ?";
        $stmt_select = $this->koneksi->prepare($sql_select);
        $stmt_select->bind_param('s', $nim);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        $row_select = $result_select->fetch_assoc();
        unlink('../assets/img/mahasiswa/' . $row_select['foto']);

        $sql = "DELETE FROM mahasiswa WHERE nim = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param('s', $nim);
        $stmt->execute();
        echo "<script>alert('Data berhasil dihapus!')</script>";
        echo "<script>window.location.href = '../data_mahasiswa.php'</script>";

    }

}
?>