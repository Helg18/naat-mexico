<h1>GENIUS</h1>
<h5>Recuperación de contraseña</h5>
<p>De click aqui para recuperar su password: </p>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
