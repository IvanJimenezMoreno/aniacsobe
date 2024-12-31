<!-- filepath: /c:/xampp/htdocs/aniacso/aniacsobe/resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Verificación de Correo Electrónico</title>
</head>
<body>
    <h1>Verifica tu dirección de correo electrónico</h1>
    <p>Se ha enviado un enlace de verificación a tu dirección de correo electrónico. Por favor, revisa tu correo y haz clic en el enlace para verificar tu cuenta.</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Reenviar enlace de verificación</button>
    </form>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>