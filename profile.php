<?php
require_once('db_connect.php');
require_once('common.php');
?>

<?php
if($_SESSION['login'] == true){
	$sql = 'SELECT * FROM `user` WHERE `email`=:email AND `password`=:password';
    $st = $conn->prepare($sql);
    $st->bindparam(':email',$_SESSION['email']);
    $st->bindparam(':password',$_SESSION['password']);
    $st->execute();
    $row = $st->fetchAll();
    foreach($row as $key_1){
        foreach($key_1 as $key_2=>$value){
            if($key_2 == 'id'){
                $id = $value;
            }
            if($key_2 == 'name'){
                $name = $value;
            }
             if($key_2 == 'email'){
                $email = $value;
            }
             if($key_2 == 'password'){
                $password = $value;
            }
             if($key_2 == 'phone_number'){
                $phone_number = $value;
            }
             if($key_2 == 'age'){
                $age = $value;
            }
             if($key_2 == 'region'){
                $region = $value;
            }
             if($key_2 == 'city'){
                $city = $value;
            }
            
        }
    }
}

else{
	header('Location: login.php');
}
?>

<?php
if(isset($_POST['log_out'])){
	session_destroy();
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>profile <?php echo($name); ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
        <br/>
		<section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-md-8 col-lg-8 col-xl-10">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <button type="submit" name="log_out" class="btn btn-danger"> log out </button>
                        </form>
                    </div>
                    <div class="col-sm-3 col-md-2 col-lg-2 col-xl-1"></div>
                   
                    <div class="col-sm-3 col-md-2 col-lg-2 col-xl-1"></div>
                </div>
            </div>
		</section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-md-2 col-lg-2 col-xl-1"></div>
                    <div class="col-sm-6 col-md-8 col-lg-8 col-xl-10">
                        <table class="table table-borderless">
                            <tr>
                                <th>personal information</th>
                            </tr>
                            <tr>
                                <td>name :&nbsp;<?=$name?></td>
                            </tr>
                            <tr>
                                <td>email :&nbsp;<?=$email?></td>

                            </tr>
                            <tr>
                                <td>password :&nbsp;<?=$password?></td>

                            </tr>
                            <tr>
                                <td>phone number :&nbsp; <?php if(!empty($password)){echo $phone_number ;}else{echo "unknow";} ?></td>
                            </tr>
                            <tr>
                                <td>age :&nbsp; <?php if(!empty($age)){echo $age ;}else{echo "unknow";} ?></td>
                            </tr>
                            <tr>
                                <td>region :&nbsp; <?php if(!empty($region)){echo $region ;}else{echo "unknow";} ?></td>
                            </tr>
                            <tr>
                                <td>city :&nbsp; <?php if(!empty($city)){echo $city ;}else{echo "unknow";} ?></td>
                            </tr>
                            
                        
                        </table>
                    
                    
                    </div>
                    <div class="col-sm-3 col-md-2 col-lg-2 col-xl-1"></div>
                
                </div>
            </div>   
        </section>
   
	</body>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</html>