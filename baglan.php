<?php
$sunucu = "localhost";
$kullanici = "root";
$sifre = "Caner1207.";
$veritabani = "kayit_sistemi";
$baglanti = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani);
if (!$baglanti){

    die("veritabanı bağlantısı başarısız oldu:" . mysqli_connect_error());
}
?>