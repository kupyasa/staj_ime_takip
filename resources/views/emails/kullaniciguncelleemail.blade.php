<h2>Merhaba {{$user['name']}} {{$user['surname']}} Staj-İME Takip Sistemi bilgilerinizde değişiklik yapılmıştır.</h2> <br><br>
Kullanıcı bilgileriniz: <br><br>

Öğrenci Numarası: {{ $user['ogrenci_sicil_no'] }} <br>
Fakülte: {{ $user['fakulte'] }} <br>
Bölüm: {{ $user['bolum']}} <br>
Sınıf: {{ $user['sinif']? $user['sinif'] : "Yok" }} <br>
Telefon Numarası: {{ $user['telefon'] }} <br>
Eposta: {{ $user['email']}} <br>
Rol : {{$user['rol']}} <br>

Teşekkürler.
