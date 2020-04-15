<?php
/*авторизация пользователя*/
include "base.php"; //подключение файла с функциями
/*получение информации методом POST с формы и записи в переменные*/
$login = trim($_POST['login']);
$pass = trim($_POST['pass']);
session_start(); //старт сессии
$chek = checkbox_verify('checkme');
if ($chek == 1){
	setcookie("login", $login, time()+3600, "/");  /* создаем куки срок действия 1 час для всех страниц */
	setcookie("pass", $pass, time()+3600, "/");  /* создаем кукисоздаем куки срок действия 1 час для всех страниц*/
}else{
	setcookie("login", "", time() - 3600, "/");	/*удаляем куки*/
	setcookie("pass", "", time() - 3600, "/");	/*удаляем куки*/
}
/*вызов функции авторизации*/ 
$qwe = getuserSELECT ($login, md5($pass));
if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;	//проверяем на существование $_SESSION['counter'] и если нет, то создаем. 
if($qwe == "error") //если ошибка регистрации выдаем сообщение и переходим на главную
{    
   $_SESSION['counter']++; //делаем +1 к текущему значению
   header('Refresh: 1; URL=http:../index.php');	//переход на главную страницу
   echo "неверный логин или пароль";
if($_SESSION['counter']>3 ){	//проверяем на колличество и если вызовов более 4 то выполняем условие
	$ip = $_SERVER['REMOTE_ADDR']; 
   $time = date('d.m.Y h:i:s');
   addip_bloc($ip, $time);
}
   
}
else{
	$_SESSION['logged_user'] = $qwe;	//запись в сессию
				header('Refresh: 1; URL=../index.php');	//переход на главную страницу
				echo '<div style="color: green;">Вы успешно авторизированны!</div><hr>';
}
function checkbox_verify($_name)
// Выполняет: проверку checkbox
{
// обязательно прописываем, чтобы функция всегда возвращала результат
$result=0;

// проверяем, а есть ли вообще такой checkbox на HTML форме, а то часто промахиваются
if (isset($_REQUEST[$_name]))
{ if ($_REQUEST[$_name]=='on') {$result=1;}
}
return $result;
}




 ?>
