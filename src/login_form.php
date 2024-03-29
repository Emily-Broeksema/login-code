<?php
	
	require_once "../vendor/autoload.php";

	use LoginOpdracht\classes\User;

// by conn $this-> voor zetten



	// Is de login button aangeklikt?
	if(isset($_POST['login-btn']) ){


		$user = new User();

		$user->username = $_POST['username'];
		$user->SetPassword($_POST['password']);

		$user->ShowUser();

		// Validatie gegevens
		$errors = $user->ValidateUser();

		if($cnt = 0)
		{
			$row = $query->fetch();

			session_start();
			$_SESSION['user'] = $row['username'];
		}

		// Indien geen fouten dan inloggen
		if(count($errors)== 0){
			//Inlogen
			if ($user->LoginUser()){
				$row = $query->fetch();

				session_start();
				$SESSION['user'] = $row['username'];
				
				echo "Login ok";
				// Ga naar pagina??
				header("location: index.php");
			} else
			{
				array_push($errors, "Login mislukt");
				echo "Login NOT ok";
			}
		}

		if(count($errors) > 0){
			$message = "";
			foreach ($errors as $error) {
				$message .= $error . "\\n";
			}
			
			echo "
			<script>alert('" . $message . "')</script>
			<script>window.location = 'login_form.php'</script>";
		
		}
		
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	</head>
<body>

	<h3>PHP - PDO Login and Registration</h3>
	<hr/>
	
	<form action="" method="POST">	
		<h4>Login here...</h4>
		<hr>
		
		<label>Username</label>
		<input type="text" name="username" />
		<br>
		<label>Password</label>
		<input type="password" name="password" />
		<br>
		<button type="submit" name="login-btn">Login</button>
		<br>
		<a href="register_form.php">Registration</a>
	</form>
		
</body>
</html>