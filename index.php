<?php
require_once('db_connect.php');
require_once('common.php');

?>

<?php
if(isset($_POST['send'])){
	if($_POST['password'] == $_POST['rep_password']){
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$sql = 'SELECT COUNT(*) FROM `user` WHERE `email`=:email ';
			$st = $conn->prepare($sql);
			$st->bindparam(':email',$_POST['email']);
			$st->execute();
			$rows = $st->fetchColumn();
			if(!$rows){
				$sql = 'INSERT INTO `user`(name,email,password,phone_number) VALUES(:name,:email,:password,:phone_number)';
				$stm = $conn->prepare($sql);
				$stm->bindparam(':name',$_POST['name']);
				$stm->bindparam(':email',$_POST['email']);
				$stm->bindparam(':password',$_POST['password']);
				$stm->bindparam(':phone_number',$_POST['phone_number']);
				$stm->execute();
				$_SESSION['login'] = true;
				$_SESSION['user_access'] = 2;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
				header('Location: profile.php');
			}
			else{
				$error = 'you already subscribe click log in button to log in your pannel';
			}
		}
		else{
			$error = 'enter a valid email';
		}
	}
	else{
		$error = 'your password repeating is wrong';
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width scale-initial=1.0">
	<title>register form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Chango&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<p class="form-title"> register form</p>
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form" >
						<span><?php if(!empty($error)){echo $error;} ?></span><br/>
						<div class="form-group">
							<label for="name" class="label">name :</label>
							<input type="text" name="name" placeholder="name" id="name" required class="form-control text_input ">
						</div>
						<div class="form-group">
							<label for="email" class="label">e-mail :</label>
							<input type="email" name="email" placeholder="e-mail" id="email" required class="form-control text_input">
						</div>
						<div class="form-group">
							<label for="phone_number" class="label">phone number :</label>
							<input type="    text" name="phone_number" placeholder="phone number" id="phone_number" class="form-control text_input ">
						</div>
						<div class="form-group">
							<label for="password" class="label">password :</label>
							<input type="text" name="password" placeholder="password" id="password" required class="form-control text_input ">
						</div>
						<div class="form-group">
							<label for="re_password" class="label">repeat password :</label>
							<input type="text" name="rep_password" placeholder="repeat password" id="rep_password" required class="form-control text_input ">
						</div>
						<button type="submit" name="send" class="btn btn-primary button ">send</button>	
					</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</section>
	
</body>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</html>
