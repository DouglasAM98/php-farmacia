<?php
$host="localhost";
$user="root";
$password="";
$db="sistemalogin";
$link = mysqli_connect($host, $user, $password);
mysqli_select_db($link, $db);

if(isset($_POST['usuario'])){
  $usu=$_POST['usuario'];
  $sen=$_POST['senha'];

  $sql="select * from usuarios where usuario='".$usu."'AND senha='".$sen."' limit 1";

 $result=mysqli_query($link ,$sql);

 if(mysqli_num_rows($result)==1){
      header("location:home.php");
  }
 else{
     echo "Usuario ou senha incorreto";
     exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" a href="css/login.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div class="container">
	<img src="img/logo.png"/>
		<form method="POST" action="#">
			<div class="form-input">
				<input type="text" name="usuario" placeholder="Digite o usuario"/>
			</div>
			<div class="form-input">
				<input type="password" name="senha" placeholder="Digite a senha"/>
			</div>
			<input type="submit" type="submit" value="ENTRAR" class="btn-login"/>
		</form>
	</div>
</body>
</html>
