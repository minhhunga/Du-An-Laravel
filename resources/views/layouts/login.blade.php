<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="POST" action="">
		@csrf
		Username: <input type="text" name="username">
		Password: <input type="password" name="password">
		<button	type="submit">Gửi</button>
	</form>
	
</body>
</html>