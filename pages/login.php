<?php
session_start();
include_once(__DIR__ . '/../classes/db.php');
include_once(__DIR__ . '/../classes/User.php'); 

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($connect);
    
    if ($user->login($email, $password)) {
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['balance'] = $user->getBalance();
        
        header('Location: index.php');
        exit;
    } else {
        $error = "Wrong email or password.";
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