<?php
require_once('db_connect.php');
require_once('common.php');

?>

<?php
if(isset($_POST['send'])){
	$sql = 'SELECT COUNT(*) FROM `user` WHERE `email`=:email AND `password`=:password';
	$stm = $conn->prepare($sql);
	$stm->bindparam(':email',$_POST['email']);
	$stm->bindparam(':password',$_POST['password']);
	$stm->execute();
	$row = $stm->fetchColumn();
	if($row == true){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
		$_SESSION['login'] = true;
		header('Location: profile.php');
		
	}
	else{
		$error = 'your password/email is wrong please try again ';
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width scale-initial=1.0">
	<title>log in form</title>
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
					<p class="form-title"> log in form</p>
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form" >
						<span><?php if(!empty($error)){echo $error;} ?></span><br/>
						<div class="form-group">
							<label for="email" class="label">e-mail :</label>
							<input type="email" name="email" placeholder="e-mail" id="email" required class="form-control text_input">
						</div>
						<div class="form-group">
							<label for="password" class="label">password :</label>
							<input type="text" name="password" placeholder="password" id="password" required class="form-control text_input ">
						</div>
						<button type="submit" name="send" class="btn btn-primary button ">send</button>	
					</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</section>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
