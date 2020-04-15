<?php 
include "reg.php";  //подключение файла с функциями
?>
<!-- структура html страницы -->
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>авторизация и регистрация</title>
    <!-- подключение скриптов и стилей-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">  <!-- визуальный стиль bootstrap -->
<script src="js/jquery.min.js"></script>  <!-- ajax подключение -->
<script src="js/sweetalert.min.js"></script> <!-- подключение alert -->
<script src="js/script.js"></script> <!-- подключение скриптов -->
</head>
<body>
	<!-- Форма ввода Email -->
	<div class="container">
		<div class="row">
			<div class="col">
				<h2>Восстановление пароля</h2>
				<form action="recovery_pass.php" method="post" id="create_order_pass">
				<p><strong>Введите ваш Email</strong>:</p>
				<input type="email" name="email"  class="form-control" >
				<div style="color: red;" id="email_error_pas"></div>
				</p>
				</p>
				<input type="hidden" name="do_signup_pass"  class="form-control">
				<p>
				<a id="do_signup_pass" class="btn btn-success" >Изменить пароль</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>