<?php
	/*выход. Закрытие сессии и переход на главную страницу*/
	session_start();
	unset($_SESSION['logged_user']); //удаляем переменную
	session_destroy();	//унечтожаем все связанное с данной сессией
	header('Location: ../index.php');	//переход на главную страницу
?>