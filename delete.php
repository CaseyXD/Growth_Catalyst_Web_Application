<?php
if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "growth_catalyst";

    // Membuat koneksi ke database
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clients WHERE user_id = $user_id";

    $connection->query($sql);
}

header("Location: /Growth_Catalyst_Web_Application/index.php");
exit;
?>
