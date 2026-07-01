<?php
include("baglan.php");
$user = $_POST['kullanici_adi'];
$email = $_POST['email'];
$pass = $_POST['sifre'];
$sifreli_pass = password_hash($pass, PASSWORD_DEFAULT);
$sql = "INSERT INTO kullanicilar (kullanici_adi, eposta, sifre) VALUES ('$user', '$email', '$sifreli_pass')";
if(mysqli_query($baglanti, $sql)){
    echo "<h3 style='color:green; text-align:center;'>Kayıt başarıyla veritabanına eklendi!</h3>";
}
else{
    echo "<h3 style='color:red; text-align:center;'> Hata:" . mysqli_error($baglanti) . "</h3>";
}
mysqli_close($baglanti);

header("Location: giris.html");
exit();
?>