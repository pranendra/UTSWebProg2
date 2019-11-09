<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "config.php";
    // -------
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $cek      = mysqli_query($connect, "SELECT * from user where username='$username' and password='$password'");
    // $result   = mysqli_num_rows($cek);
    // $data = mysqli_fetch_array($cek);
     
    // if($result>0){
    //     if ($data['level'] == 'admin') {
    //         //session_start();
    //         $_SESSION['username'] = $data['username'];
    //         $_SESSION['user'] = $data['nama'];
    //         // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
    //         $_SESSION['level'] = $data['level'];
    //         echo "<script>document.location.href='../admin'</script>";
     
    //     }elseif($data['level'] == 'user'){
    //         //session_start();
    //         $_SESSION['id_user'] = $data['id_user'];
    //         $_SESSION['username'] = $data['username'];
    //         $_SESSION['user'] = $data['nama'];
    //         // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
    //         $_SESSION['level'] = $data['level'];
    //         echo "<script>document.location.href='../user'</script>";
    //     }
    // }else{
    //     $_SESSION['warning'] = "<div class=\"alert alert-danger\" role=\"alert\">Username atau Password salah</div>";
    // }

    $sql = "SELECT * from user where username='$username' and password= '" . md5($password) . "'";
    if ($query = $connection->query($sql)) {
        if ($query->num_rows) {
            session_start();
            while ($data = $query->fetch_array()) {
                if ($data['level'] == 'admin') {
                    //session_start();
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['email'] = $data['email'];
                    // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
                    $_SESSION['level'] = $data['level'];
                    echo "<script>document.location.href='./admin'</script>";
                
                }elseif($data['level'] == 'user'){
                    //session_start();
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['email'] = $data['email'];
                    // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
                    $_SESSION['level'] = $data['level'];
                    echo "<script>document.location.href='index.php'</script>";
                }
                // $_SESSION["pelanggan"]["is_logged"] = true;
                // $_SESSION["pelanggan"]["id"] = $data["id_pelanggan"];
                // $_SESSION["username"] = $data["username"];
                // $_SESSION["nama"] = $data["nama"];
                // $_SESSION["pelanggan"]["no_ktp"] = $data["no_ktp"];
                // $_SESSION["pelanggan"]["no_telp"] = $data["no_telp"];
                // $_SESSION["pelanggan"]["email"] = $data["email"];
                // $_SESSION["pelanggan"]["alamat"] = $data["alamat"];
              }
            //header('location: index.php');
        } else {
            echo alert("Username / Password tidak sesuai!", "login.php");
        }
    } else {
        echo "Query error!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3 class="text-center">LOGIN</h3></div>
                    <div class="panel-body">
                        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="username" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Login</button>
                            <a href="/rental-mobil" class="btn btn-info btn-block" role="button">Halaman Awal</a>
                        </form>
                    </div>
                    <div class="panel-footer">
                      Belum punya akun? <a href="index.php?page=daftar">daftar sekarang.</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>
