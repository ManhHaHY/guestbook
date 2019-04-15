<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Guestbook Login">
	<meta name="author" content="Ha Tran.">
	<title>Guestbook Admin Login</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
	<form class="form-signin" method="post" action="/?submit-login">
		<h1 class="h3 mb-3 font-weight-normal">Guestbook Admin</h1>
		<label for="email" class="sr-only">Email address</label>
		<input type="email" id="email" class="form-control" placeholder="Email address" name="email" required autofocus>
		<label for="password" class="sr-only">Password</label>
		<input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">Copyright &copy; <?php echo date('Y')?></p>
	</form>
</body>
</html>
