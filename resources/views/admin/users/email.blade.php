<p>Halo {{ $data['name'] }},</p>

<p>Selamat datang di <strong>{{ config('app.name') }}</strong>!</p>

<p>Akun Anda telah dibuat dengan rincian sebagai berikut:</p>

<ul>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Password sementara:</strong> {{ $data['password'] }}</li>
</ul>

<p>Silakan login dan segera ubah password Anda untuk menjaga keamanan akun Anda.</p>

<p>Jika Anda tidak mengenal email ini atau tidak merasa membuat akun, abaikan saja atau hubungi admin kami.</p>

<p>Salam,</p>
<p>Tim {{ config('app.name') }}</p>