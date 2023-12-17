<?php 

    include 'Database.php';

    Class Auth extends Database{

        function __construct(){
            parent::__construct();
        }

        function login($email, $password)
        {
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

       
    
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['status'] = 'login';
                    header("location: ../dashboard.php"); 
                    exit;
                } else {
                    header("location: ../index.php?pesan=gagal"); 
                    exit;
                }
            } else {
                header("location: ../index.php?pesan=gagal");
                exit;
            }
        }
    

        function register($nama, $email, $password){
            // cek email sudah terdaftar atau belum
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $query = mysqli_query($this->koneksi, $sql);
            $cek = mysqli_num_rows($query);

            if($cek > 0){
                header("location: ../register.php?pesan=gagal");
                exit;
            }

            // password hash
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO user (nama, email,  password) VALUES ('$nama', '$email', '$password')";
            $query = mysqli_query($this->koneksi, $sql);
            if($query){
                header("location: ../index.php?pesan=berhasil");
            }else{
                header("location: ../register.php?pesan=gagal");
            }
        }

        function logout(){
            session_start();
            session_destroy();
            header("location: ../index.php");
        }

    }

 ?>