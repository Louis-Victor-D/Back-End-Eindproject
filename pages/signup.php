<?php
    include_once(__DIR__ . '/../src/sys/db.php');

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $options = [
            'cost' => 13,
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);
       
        $query = $connect->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $password);

        $query -> execute();
        header("Location: login.php");
        exit();
        }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<header>
    <div class="logo">MangaVerse</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="product.php">Shop</a>
        <a href="orders.php">Bestellingen</a>
        <a href="profile.php">Profiel</a>
    </nav>
</header>

<body>
	<div class="MVLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign Up</h2>

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
					<input autocomplete="off" type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">	
				</div>
			</form>
		</div>
	</div>
</body>
</html>