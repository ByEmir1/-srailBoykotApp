<?php
global $dbConfig;
global $pdo;
include 'config.php';
include 'connect-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urunAdi = $_POST['search'];

    $sql = "SELECT * FROM urunler WHERE urun_adi LIKE ?";
    $stmt = $pdo->prepare($sql);
    $likeUrunAdi = "%".$urunAdi."%";
    $stmt->bindParam(1, $likeUrunAdi, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
}

?>


<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Search</title>
</head>
<body>
<div class="container my-5">
    <form method="post" class="input-group mb-3">
        <input name="search" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-dark mx-2" id="basic-addon2">Ara</button>
        </div>
    </form>
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ürün</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td><?php
                if (count($result) > 0) {
                    foreach($result as $row) {
                        echo $row["urun_adi"];
                    }
                } else {
                    echo "Ürün bulunamadı";
                }
                ?></td>
            <td>Otto</td>
            <td class="">
                <?php
                if (count($result) > 0) {
                    foreach($result as $row) {
                        echo $row["bilgi"];
                    }
                } else {
                    echo "Ürün bulunamadı";
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
