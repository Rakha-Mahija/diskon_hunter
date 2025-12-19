<?php
include __DIR__ . '/../service/database.php';
if(isset($_POST['coba'])){
// ambil semua data scrap
$result = $db->query("
    SELECT id_scrap, id_user, link, harga, diskon 
    FROM scrap
");

while ($row = $result->fetch_assoc()) {

    $id_scrap = $row['id_scrap'];
    $link = $row['link'];
    $harga_lama = $row['harga'];
    $diskon_lama = $row['diskon'];

    // rapikan link
    if (!preg_match('/^https?:\/\//', $link)) {
        $link = "https://" . $link;
    }
    if (substr($link, -1) !== "/") {
        $link .= "/";
    }

    $jsonUrl = $link . "data/menu.json";

    // ambil data baru
    $ch = curl_init($jsonUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 10
    ]);

    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code !== 200 || !$response) {
        continue; // skip, JANGAN die
    }

    $data = json_decode($response, true);
    if (!$data) {
        continue;
    }

    $harga_baru  = $data['harga'];
    $diskon_baru = $data['diskon'];

    // 🔥 PERBANDINGAN
    if ($harga_baru != $harga_lama || $diskon_baru != $diskon_lama) {

        echo "ada perubahan";
        echo "<br>";
    }else{
        echo "tidak ada perubahan";
    }
}
}
