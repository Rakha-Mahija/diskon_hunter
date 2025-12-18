<?php
include __DIR__ . '/../service/database.php';
session_start();

function getDataFromLink() {

//ini hasil dari submit
$link = $_POST["link"];
//

//ini jika ada yang submit cuma xxx.store
if (!preg_match('/^https?:\/\//', $link)) {
    $link = "https://" . $link;
}
//ini jika ada yang submit cuma xxx.store
if (substr($link, -1) !== "/") {
    $link .= "/";
}

$jsonUrl = $link . "data/menu.json";

$ch = curl_init($jsonUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($code !== 200) {
    die("Gagal: HTTP " . $code);
}

 return json_decode($response, true);
}

//ini eksekusi fungsinya tot
$data = getDataFromLink();

if(!$data){
    $_SESSION["hasil"] = "Gagal mengambil data!";
} else {
    $_SESSION["hasil"] = "Harga: " . $data["harga"];
}
$id_users = $_SESSION["id_user"];
$link = $_POST["link"];
$namas = $data["nama"];
$hargas = $data["harga"];
$diskon = $data["diskon"];
$validasi = true;
try{
    $datascrap = "INSERT INTO scrap (id_user,link, nama, harga, diskon) VALUES
    ('$id_users', '$link', '$namas', '$hargas', '$diskon')";

    if($db->query("$datascrap")){
        $pesan = "data berhasil disimpan";
    }else{
        $pesan = "data gagal disimpan ";
    }
    }catch(mysqli_sql_exception){
        $pesan ="link tidak boleh duplikat";
        header("Location: ../main/index.php");
        $validasi = false;
        $_SESSION["pesan"] = $pesan;
    }$db->close();
    
$_SESSION["pesan"] = $pesan;
if($validasi){
    header("Location: ../main/dashboard.php");
}

exit;