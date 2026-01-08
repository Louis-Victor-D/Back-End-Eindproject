<?php
        include_once(__DIR__ . '/../src/sys/db.php');
        function canLogin($p_email, $p_password) {
	    global $connect;
		$query = $connect->prepare("SELECT * FROM users WHERE email = :email");
		$query->bindValue(":email", $p_email);
		$query->execute();
		$user = $query->fetch(PDO::FETCH_ASSOC);
		if ($user && password_verify($p_password, $user['password'])){
        return true;
        } else {
        return false;
         }
		}

	if(!empty($_POST)) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if( canLogin($email, $password)) {
			if(canLogin($email, $password)) {
        session_start(); 
        $_SESSION['user_id'] = $email; 
			header('Location: index.php');
		} else {
			$error = "Wrong email or password.";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<title>Document</title>
	
</head>
<body>
	<div class="MVLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 class="form__title">Sign In</h2>

				<?php if(isset($error)): ?>
				<div class="form__error">
					<p>
						<?php echo $error ?>
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input autocomplete="off" type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">	
				</div>
			</form>
		</div>
	</div>
</body>
</html>