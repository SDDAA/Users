<html>
<head>
	<title>Добавление</title>
	
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<?php

require "php/db.php";
$data = $_POST;
$errors = array();
if(isset($data['enter']))
{

	if(R::count('users', "login = ?", array($data['email'])) > 0)
		$errors[] = 'Пользователь с таким email существует';

	if(empty($errors))
	{
		$user = R::dispense('users');
		$user->name = $data['name'];
		$user->surname = $data['surname'];
		$user->login = $data['email'];
		$user->password = password_hash($data['psw'], PASSWORD_DEFAULT);
		R::store($user);
		$mss = 'Пользователь добавлен';
		
	}
	else
		$mss='';
}
?>
<style>
.login form 
{	
	position: relative;
	width: 300px;
	margin: 3px 50px 0px 50px;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.login input 
{
	width: 30%;
	margin: 0px 0px 10px 0px;
	height: 30px;
	padding-left: 10px;
	border: 2px solid #ab80c8;
	border-radius: 5px;
	outline: none;
	background: white;
	color: #9E9C9C;
}
.button {
    background-color: #ab80c8; 
    border: none;
    color: white;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}

.button:hover { background: green; }

</style>
<body bgcolor="f6f6f6" background="images/bg.jpg">
<div id="container">
	<div id="header"> <!-- шапка -->
	<!--Горизонтальная навигация-->

	</div>
		 
	<div id="sidebar">
		<div class="vertical" style="float: left;">
			<h3 class="category-wrap h3">Управление пользователями</h3>
				<ul class="category-wrap ul">
				<li><a href="../index.php">Добавить нового пользователя</a></li>
				<li><a href="../table.php">Просмотр пользователей</a></li>
			</ul>
		</div>
	</div>
		 
	<div id="content">




<form action="index.php" method="POST" onsubmit="zaluption(this)">
  <div class="login">
    <h1 style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>Добавление нового пользователя</h1>
    

    <label for="email"><b>Логин</b></label><br>
    <input autocomplete="off" type="email" placeholder="Введите Email" size="30" name="email" value="<?php echo @$data['name'];?>" required><br>
    <label for="psw"><b>Пароль</b></label><br>
    <input type="password" placeholder="Введите пароль" name="psw" value="<?php echo @$data['psw'];?>" required><br>

	<label for="psw-repeat"><b>Повторите пароль</b></label><br>
    <input type="password" placeholder="Повторите пароль" name="psw-repeat" value="<?php echo @$data['psw-repeat'];?>" required><br>

    <label for="text"><b>Имя</b></label><br>
    <input autocomplete="off" type="email" placeholder="Введите имя" name="name" value="" required><br>
    <label for="psw"><b>Фамилия</b></label><br>
    <input type="text" placeholder="Введите фамилию" name="surname" value="<?php echo @$data['surname'];?>" required><br>
	

    <button class="button" type="submit" name="enter">Добавить</button>
  </div>
  
	</form>
	<?php 
	if(!empty($errors)) 
	{
	print_r($errors); 
	
	}
	else if(!empty($mss))
		echo $mss;
		?>
	 </div>						   



</body>
</html>