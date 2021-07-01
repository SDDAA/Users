<html>
<head>
	<title>Регистрация</title>
	
	<link rel="stylesheet" type="text/css" href="/site/css/style.css">
</head>
<body>
<?php
	require "db.php";
	$data = $_POST;
	$errors = array();
	if(isset($data['regist']))
	{
		if(trim($data['name']) == '')
			$errors[] = 'Введите имя';
		else if(trim($data['email']) == '')
			$errors[] = 'Введите Email';
		else if($data['psw'] == '')
			$errors[] = 'Введите пароль';
		else if($data['psw'] != $data['psw-repeat'])
			$errors[] = 'Пароли не совпадают';
		else if(R::count('users', "email = ?", array($data['email'])) > 0)
			$errors[] = 'Пользователь с таким email существует';

		if(empty($errors))
		{
			$user = R::dispense('users');
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->password = password_hash($data['psw'], PASSWORD_DEFAULT);
			R::store($user);
			header('Location: ../php_db/login.php');
		}
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
	width: 100%;
	margin: 0px 0px 10px 0px;
	height: 42px;
	padding-left: 10px;
	border: 2px solid #80C8A0;
	border-radius: 5px;
	outline: none;
	background: white;
	color: #9E9C9C;
}
.button {
    background-color: #80C8A0; 
    border: none;
    color: white;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}
</style>
<body bgcolor="f6f6f6">
<div id="container">
	<div id="header"> <!-- шапка -->
	<!--Горизонтальная навигация-->
		<div class="horizontal">
			<ul>
				<li style="float:right"><a href="../cart.php">Корзина</a></li>
				<li><a href="../php_db/login.php">
				<?php 
				if(isset($_SESSION['logged_user']->email)) 
					echo "Авторизован: " . $_SESSION['logged_user'] ->name; 
				else
					echo "Войти";
				?>
				</a>
				</li>
				<li class="search">
					<form action="" method="get">
					<input name="s" placeholder="Поиск" type="search">
					<button type="button"></button>
					</form>
				</li>
				<li><a href="">Акции</a></li>
				<li><a href="../catalog.php">Каталог</a></li>
				<li><a href="../index.php">Главная</a></li>	
			</ul>
		</div>
	</div>
		 
	<div id="sidebar">
		<div class="vertical" style="float: left;">
			<h3 class="category-wrap h3">Каталог</h3>
				<ul class="category-wrap ul">
				<li><a href="../p_1.php">Посуда для приготовления</a></li>
				<li><a href="../p_2.php">Столовая посуда</a></li>
				<li><a href="../p_3.php">Детская посуда</a></li>
				<li><a href="../p_4.php">Посуда для напитков</a></li>
				<li><a href="../i_1.php">Фоторамки</a></li>
				<li><a href="../i_2.php">Фигурки</a></li>
				<li><a href="../i_3.php">Вазы</a></li>
				<li><a href="../i_4.php">Зеркала</a></li>
				</ul>
		</div>
	</div>
		 
	<div id="content">
	<form class="login" action="singup.php" method="POST">
	<div class="container">
    <h1 style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>Регистрация</h1>
    <hr>
	<label for="email"><b>Ваше имя</b></label>
    <input autocomplete="off" type="text" placeholder="Введите имя" name="name" value="<?php echo @$data['name'];?>" required><br><br>
    <label for="email"><b>Email</b></label>
    <input autocomplete="off" type="email" placeholder="Введите Email" name="email" value="<?php echo @$data['email'];?>" required><br><br>

    <label for="psw"><b>Пароль</b></label>
    <input type="password" placeholder="Введите пароль" name="psw" value="<?php echo @$data['psw'];?>" required><br><br>

    <label for="psw-repeat"><b>Повторите пароль</b></label>
    <input type="password" placeholder="Повторите пароль" name="psw-repeat" value="<?php echo @$data['psw-repeat'];?>" required><br><br>
    <hr>
    <button type="submit" name="regist" id="button">Регистрация</button>
  </div>
  
  <div class="container signin">
    <p>У Вас уже есть аккаунт? <a href="login.php">Войти</a>.</p>
  </div>
  		<?php 
		if(!empty($errors))
			echo '<div style="color:red; font-size: 18px;">'.array_shift($errors).'</div>';?>
	</form>
	</div>
	
</div>
</body>
</html>