<?php
include __DIR__ . '/../service/database.php';
include __DIR__ . '/../service/mailer.php';
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    exit('Forbidden');
}

//if(isset($_POST['coba']))
$isCli = (php_sapi_name() === 'cli');
if ($isCli || isset($_POST['coba'])){
// ambil semua data scrap
$result = $db->query("
    SELECT 
        s.id_scrap,
        s.id_user,
        u.email,
        s.nama,
        s.link,
        s.harga,
        s.diskon
    FROM scrap s
    JOIN users u ON s.id_user = u.id
");

function updateScrap($db, $id_scrap, $harga_baru, $diskon_baru) {
    $stmt = $db->prepare("
        UPDATE scrap 
        SET harga = ?, diskon = ?, scrap_at = NOW()
        WHERE id_scrap = ?
    ");
    $stmt->bind_param("iii", $harga_baru, $diskon_baru, $id_scrap);
    $stmt->execute();
    $stmt->close();
}

function insertHistory($db, $id_scrap, $harga_lama, $diskon_lama, $harga_baru, $diskon_baru) {
    $stmt = $db->prepare("
        INSERT INTO history 
        (id_scraps, last_harga, last_diskon, new_harga, new_diskon, checked_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
        "iiiii",
        $id_scrap,
        $harga_lama,
        $diskon_lama,
        $harga_baru,
        $diskon_baru
    );
    $stmt->execute();
    $stmt->close();
}


while ($row = $result->fetch_assoc()) {

    $id_scrap = $row['id_scrap'];
    $link = $row['link'];
    $harga_lama = $row['harga'];
    $diskon_lama = $row['diskon'];
    $produk = $row['nama'];
    $gmail = $row['email'];

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

   
    if ($harga_baru < $harga_lama || $diskon_baru > $diskon_lama) {
    insertHistory($db,$id_scrap,$harga_lama,$diskon_lama,$harga_baru,$diskon_baru);
    updateScrap($db,$id_scrap,$harga_baru,$diskon_baru);
    sendDiskonMail($gmail,$produk,$harga_baru,$diskon_baru,$link);
    echo "ada diskon<br>";
    }else{
        echo "tidak ada perubahan<br>";
    }
}
}
