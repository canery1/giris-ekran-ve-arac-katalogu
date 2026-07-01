<?php
// Veritabanı bağlantımızı ve oturum yönetimini başlatıyoruz
include 'baglan.php'; 
session_start(); 

if (isset($_POST['kullanici_adi']) && isset($_POST['sifre'])) {
    
    $gelen_kullanici = mysqli_real_escape_string($baglanti, $_POST['kullanici_adi']);
    $gelen_sifre = $_POST['sifre']; 

    // Kullanıcıyı veritabanında arıyoruz
    $sorgu = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$gelen_kullanici'";
    $sonuc = mysqli_query($baglanti, $sorgu);

    // Eğer veritabanında 1 sonuç döndüyse kullanıcı adı doğrudur
    if (mysqli_num_rows($sonuc) == 1){
        
        $kullanici_veri = mysqli_fetch_assoc($sonuc);
        
        // Şifre karşılaştırmasını güvenli fonksiyonla yapıyoruz
        if(password_verify($gelen_sifre, $kullanici_veri['sifre'])){
            
            // Oturum değişkenlerini tanımlıyoruz
            $_SESSION['kullanici_adi'] = $kullanici_veri['kullanici_adi'];
            $_SESSION['id'] = $kullanici_veri['id'];
            
            // Giriş başarılıysa yönlendirilecek sayfa (Yönlendirmek istediğin sayfa adına göre değiştirebilirsin)
            header("Location: vitrin.html");
            exit();
        }
        else{
            // Kullanıcı adı doğru ama şifre yanlış ise
            echo "<script>alert('Şifre yanlış.'); window.location.href = 'giris.html';</script>";
        }
    }
    else{
        // Kullanıcı adı veritabanında hiç yoksa
        echo "<script>alert('Böyle bir kullanıcı bulunamadı.'); window.location.href = 'giris.html';</script>";
    }
} 
else {
    // Form doldurulmadan doğrudan bu PHP dosyasına erişilmeye çalışılırsa
    header("Location: giris.html");
    exit();
}
?>