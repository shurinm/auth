<?php 
session_start(); //старт сесии
include "reg/reg.php";  //подключение файла с функциями
/*главная страница*/
$ban = ip_bloc ();  //получаем список забаненых адресов
//unset($ban[0]); //удаляем первый элемент массива NULL
$ip = $_SERVER['REMOTE_ADDR']; //текущий ip
$count = count($ban); 
/*сравниваем текущий ip с ип из черного списка*/
for ($i=1; $i<$count; $i++) { 
if ($ip == $ban[$i]['ip']) { die("Извините. Доступ заблокирован для текушего адреса  $ip"); } 
} 
    /*проверяем если сесии активна, то выводим информацию о пользователе*/
	if( isset($_SESSION['logged_user'])):?>   
    	<div class="qwe" style=" ">
    		<div class="qwe1" style=" text-align: left; padding-left: 10px; display: table-cell;">Авторизован!</div>
    		<div class="qwe2" style="padding-left: 1000px; display: table-cell;">
    		Привет, <?php if( isset($_SESSION['logged_user']))
        	echo $_SESSION['logged_user']["fio"]; ?>
        	<div class="btn-group">
  <!-- Кнопка -->
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Информация
  </button>
  <!-- Меню -->  
  <div class="dropdown-menu">
  	<a class="dropdown-item" href="">Настройки</a>
    <a class="dropdown-item" href="reg/logau.php">Выйти</a>
  </div>
</div>
</div>       	
    <hr>
<body>
  <?php 
    /*проверяем прошел ли активацию пользователь и в зависимости от результата выводим ему сообщение*/
    if($_SESSION['logged_user']['activation'] == 0){
        echo "<div class='qwe' style=''>
            <div class='qwe1' style=' text-align: left; padding-left: 10px; display: table-cell;'>Подтвердите пожалуйста свой email</div>
";
        }else{
        echo "<div class='qwe' style=''>
            <div class='qwe1' style=' text-align: left; padding-left: 10px; display: table-cell;'>Ваш email подтвержден!</div>
";    
            }?>
        

</body>
</html>
    
<?php else : ?> 
    <!-- если сесия не активна отображаем формы авторизации и регистрации -->
	 <div class="container">
		<div class="row">
			<div class="col">
				<h2>Авторизация</h2>
				<form action="reg/auth.php" method="post">
				<input type="text" class="form-control" id="login" placeholder="Логин" name="login" <?if(isset($_COOKIE["login"])){$log = $_COOKIE['login'];echo 'value="'.$log.'"';}?>><br>
				<input type="password" class="form-control" id="pass" placeholder="пароль" name="pass" <?if(isset($_COOKIE["pass"])){$pass = $_COOKIE['pass'];echo 'value="'.$pass.'"';}?>>
				<a href="reg/recovery.php">Забыли пароль</a><br>
                  <input type="checkbox" name="checkme" checked="checked" />
                  <label class="form-check-label" for="dropdownCheck">
                    Запомнить меня
                  </label>
        		</br>
				<button class="btn btn-success" type="submit">Авторизация</button>
				</form>
			</div>
			<div class="col">
				<h2>Регистрация</h2>
				<form method="POST" action="reg/reg.php" id="create_order">
				<p> 
				<p><strong>Ваше имя</strong>:</p>
				<input type="text" name="nname"  class="form-control" >
				<div style="color: red;" id="name_error"></div>
				</p>

				<p> 
				<p><strong>Ваш логин</strong>:</p>
				<input type="text" name="login"  class="form-control" >
				<div style="color: red;" id="login_error"></div>
				</p>

				<p> 
				<p><strong>Ваш Email</strong>:</p>
				<input type="email" name="email"  class="form-control" >
				<div style="color: red;" id="email_error"></div>
				</p>

				<p> 
				<p><strong>Ваш пароль</strong>:</p>
				<input type="password" name="password"  class="form-control" >
				<div style="color: red;" id="pass_error"></div>
				</p>

				<p> 
				<p><strong>Введите пароль еще раз</strong>:</p>
				<input type="password" name="password_2"  class="form-control">
				<div style="color: red;" id="pass2_error"></div>
				</p>
				<input type="hidden" name="do_signup"  class="form-control">
				<p>
				<a id="do_signup" class="btn btn-success" >Зарегистрироваться</a>
				</form>
			</div>
		</div>
	</div>

<?php endif; ?>
<!-- структура html страницы -->
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>авторизация и регистрация</title>
    <!-- подключение скриптов и стилей-->
  <link rel="stylesheet" type="text/css" href="reg/css/bootstrap.min.css">  <!-- визуальный стиль bootstrap -->
<script src="reg/js/jquery.min.js"></script>  <!-- ajax подключение -->
<script src="reg/js/sweetalert.min.js"></script> <!-- подключение alert -->
<script src="reg/js/script.js"></script> <!-- подключение скриптов -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
		
</body>
</html>