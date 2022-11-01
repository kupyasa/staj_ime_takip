<h2>Merhaba {{$user['name']}} {{$user['surname']}} Staj-İME Takip Sistemine {{$user['rol']}} olarak kaydınız yapılmıştır.</h2> <br><br>
Kullanıcı bilgileriniz: <br><br>

Öğrenci Numarası: {{ $user['ogrenci_sicil_no'] }} <br>
Fakülte: {{ $user['fakulte'] }} <br>
Bölüm: {{ $user['bolum']}} <br>
Sınıf: {{ $user['sinif']? $user['sinif'] : "Yok" }} <br>
Telefon Numarası: {{ $user['telefon'] }} <br>
Eposta: {{ $user['email']}} <br>
Şifre: {{ $user['password'] }} <br>

Giriş yaptığınızda şifrenizi değiştirmeniz önerilir.<br>

Teşekkürler.


