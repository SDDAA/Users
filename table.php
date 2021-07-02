<html>
<head>
	<title>Таблица пользователей</title>
	
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<?php 
require "php/db.php";

	$sql = R::count('users');
	$data = $_GET;
	if(isset($data['id']))
	{
		$id = $data['id'];
		if ($sql > 0)
		{			
			$user = R::load('users', $id);
			R::trash($user);
		}
		echo $id;
	}
?>

<style>
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

.button:hover { background: rgb(232,95,76); }
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
	  <?php 

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "users";
	$link = mysqli_connect($host, $user, $password, $database);
	$sql = "SELECT * FROM `users`";
	$result = $link->query($sql);
	if ($result->num_rows > 0)
	{			
		echo '<form method="GET" action="table.php"><table name="id"><tr style="color:white;"><th>ID</th><th>Имя</th><th>Фамилия</th><th>Логин</th>
		<th>Пароль</th><th>Действие</th></tr>';
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr><td>" .$row["id"]. "</td>" . "<td>".$row["name"]."</td>"."<td>".$row["surname"]."</td>"
			."<td>".$row["login"]."</td>". "<td>".$row["password"]."</td>";
			echo "<td>" . "<a href=table.php?id=" . $row['id'] . ">Удалить</a></td>";
			echo '</tr></form>';
		}
		echo "</table>";
	}
	else 
		echo "Нет пользователей!";


 ?>		   
	</div>


</div>
</body>
</html>
