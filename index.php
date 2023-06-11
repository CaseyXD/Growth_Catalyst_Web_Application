<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growth Catalyst</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Employees</h2>
        <a class="btn btn-primary" href="/Growth_Catalyst_Web_Application/create.php" role="button">Input New Employee </a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Umur</th>
                    <th>Dibuat Pada</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "growth_catalyst";

                // Membuat koneksi ke database
                $connection = new mysqli($servername, $username, $password, $database);

                // Mengecek koneksi
                if($connection ->connect_error){
                    die("Connection failed: " . $connection ->connect_error);
                }

                // Membaca semua row dalam database table
                $sql ="SELECT * FROM clients";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }
                // Membaca data satu - persatu setiap row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[user_id]</td>
                    <td>$row[nama]</td>
                    <td>$row[email]</td>
                    <td>$row[telepon]</td>
                    <td>$row[alamat]</td>
                    <td>$row[umur]</td>
                    <td>$row[tanggal]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/Growth_Catalyst_Web_Application/update.php?id=$row[user_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/Growth_Catalyst_Web_Application/delete.php?id=$row[user_id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>