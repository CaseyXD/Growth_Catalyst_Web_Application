<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "growth_catalyst";

// Membuat koneksi ke database
$connection = new mysqli($servername, $username, $password, $database);

$user_id = "";
$nama = "";
$email = "";
$telepon = "";
$alamat = "";
$umur = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    // GET method : memperlihatkan data di client

    if (!isset($_GET["user_id"])){
        header("location: /Growth_Catalyst_Web_Application/index.php");
        exit;
    }

    $user_id = $_GET["user_id"];

    // Membaca row tertentu client yang dipilih dalam database
    $sql ="SELECT * FROM clients WHERE id=$user_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /Growth_Catalyst_Web_Application/index.php");
        exit;
    }

    $nama = $row ["nama"];
    $email = $row  ["email"];
    $telepon = $row ["telepon"];
    $alamat = $row  ["alamat"];
    $umur = $row  ["umur"]; 

}
else { 
    // POST method : update data pada client
    $nama = $_POST ["nama"];
    $email = $_POST ["email"];
    $telepon = $_POST ["telepon"];
    $alamat = $_POST ["alamat"];
    $umur = $_POST ["umur"]; 

    do{
        if ( empty($user_id) || empty($nama) || empty($email) || empty($telepon) || empty($alamat) || empty($umur)) {
            $errorMessage = "All the fields are required";
            break;
        } 
        $sql = "UPDATE clients " .
            "SET nama = '$nama', email = '$email', telepon = '$telepon', alamat = '$alamat', umur = '$umur' " .
            "WHERE user_id = $user_id";
            
            $result = $connection->query($sql);
            if (!$result) {
                $errorMessage = "invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Selamat, data berhasil tersimpan";
            header("location: /Growth_Catalyst_Web_Application/index.php");
            exit;

    } while (false);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growth Catalyst</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class = 'alert alert-warning alert-dismissable fade show' role = 'alert'>
                <strong>$errorMessage</strong>
                <button type = 'button' class = 'btn-close' data-bs-dismiss = 'alert' aria-label = 'close'></button>
            </div>
            ";
        }
        ?>

        <h2>List of Employees</h2>
        <form method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


            <!-- Kolom nama -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                </div>
            </div>

          <!-- Kolom email-->
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>

          <!-- Kolom no telepon-->
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Telepon</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="telepon" value="<?php echo $telepon; ?>">
            </div>
        </div>

          <!-- Kolom alamat-->
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
            </div>
        </div>

          <!-- Kolom umur-->
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Umur</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="umur" value="<?php echo $umur; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class = 'alert alert-warning alert-dismissable fade show' role = 'alert'>
                        <strong>$successMessage</strong>
                        <button type = 'button' class = 'btn-close' data-bs-dissmiss = 'alert' aria-label = 'close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

          <!-- Kolom submit-->
          <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-online-primary" href="/index.php" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
</html>