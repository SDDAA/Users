<html>
<head>
	<title>Вход</title>
	
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/slider.css">
</head>

<?php
	require "db.php"; // подключаемся к базе данных
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "flowers";
	$link = mysqli_connect($host, $user, $password, $database);
	$data = $_POST; 
	if(isset($data['enter']))
	{
		$error = array();
		$user = R::findOne('users', 'email = ?', array($data['email']));
		if($user)
		{
			if(password_verify($data['psw'], $user->password))
			{
				$_SESSION['logged_user'] = $user;
			}
			else
				$error[] = 'Неверный пароль!';
		}
		else
			$error[] = 'Пользователь с таким логином не найден!';
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
	color: #8845ba;
}
.button {
    background-color: #8845ba; 
    border: none;
    color: white;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}
</style>
<body bgcolor="f6f6f6" background="images/bg.jpg">
<div id="container">
	<div id="header"> <!-- шапка -->
	<!--Горизонтальная навигация-->
		<div class="horizontal">
			<ul>
				<li style="float:right"><a href="../cart.php">Корзина</a></li>
				<li><a href="#">
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
<?php 
if(!isset($_SESSION['logged_user']->email)):?>
<form action="login.php" method="POST">
  <div class="login">
    <h1 style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>Вход</h1>
    <hr>
    <label for="email"><b>Email</b></label>
    <input autocomplete="off" type="email" placeholder="Введите Email" name="email" value="<?php echo @$data['email'];?>" required><br><br>
    <label for="psw"><b>Пароль</b></label>
    <input type="password" placeholder="Введите пароль" name="psw" value="<?php echo @$data['psw'];?>" required><br><br>
    <hr>
    <button id="button" type="submit" name="enter">Войти</button>
  </div>
  
  <div class="container signin">
    <p>Вы не зарегистрированы? <a href="singup.php">Регистрация</a>.</p>
  </div>
	<?php
  	if(!empty($error))
	{
		echo '<div style="color:red; font-size: 18px;">'.array_shift($error).'</div>';
	}
	?>
	</form>
	<?php else: ?>
	<?php echo '<hr><div style="color: green; font-size: 18px;"> Вы авторизовались! ' . 
	$_SESSION['logged_user']->login . ' </div><hr>' ;?> 
	<a href="../index.php" id="button">Перейти на главную</a>&nbsp;&nbsp;
	<a href="logout.php" id="button">Выйти с учетной записи</a><br><br>
	<a href="/site/php_db/login.php?kn" id="button">Просмотреть историю покупок</a><br><br>

	
	<?php 
	if(isset($_GET['kn']))	
	{
		$log = $_SESSION['logged_user']->id;
		$sql = "SELECT cart.id_pr, product.name, country.name_c, mater.mater, product.cost, cart.time FROM `cart`, 
		`product`, `users`, `country`, `mater` WHERE cart.id_pr=product.id 
		AND product.id_country = country.id_c AND product.mater=mater.id AND users.id=$log AND cart.id_user=$log";
		$result = $link->query($sql);
		if ($result->num_rows > 0)
		{			
			$j=1;
			echo '<table class="shopping_list"><tr style="color:white;"><th>№</th><th>Наименование</th><th>Страна</th><th>Материал</th>
			<th>Стоимость</th><th>Время</th></tr>';
			while($row = $result->fetch_assoc()) 
			{
				echo "<tr><td>" .$j. "</td>" . "<td>".$row["name"]."</td>"."<td>".$row["name_c"]."</td>"
				."<td>".$row["mater"]."</td>". "<td>".$row["cost"]."</td>". "<td>".$row["time"]."</td></tr>";
				$j++;
			}
			echo "</table>";
		}
		else 
			echo "У Вас нет покупок!";
	}
	?>
	<?php endif ; ?>
	</div>

	<div id="clear">
		 
	</div>							   
</div>



</body>
</html>