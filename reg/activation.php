<?php
	include "base.php";	//подключение файла с функциями
$data = $_GET;	//получаем данные методом GET
	$login = $data['login']; //считываем логин
	$tocken = $data['code'];	//считываем пароль
        $strQuery = "UPDATE `users` SET `activation` = '1', `tocken` ='' WHERE `login` ='$login' AND `tocken` ='$tocken'";   //запрос к бд
        $varResult = QueryDB($strQuery); //ответ на запрос
            /*делаем проверку ответа и возвращаем результат*/
        if ($varResult == true){
        	header('Refresh: 1; URL=../reg/logau.php');	//переход на главную страницу и закрытие сесии
			echo "Вы успешно прошли активацию! Теперь можете войти используя свой логин и пароль"; // сообщение пользователю
        }else{
        	header('Refresh: 1; URL=../reg/logau.php');	//переход на главную страницу и закрытие сесии
        	echo "Ошибка активации!";  // сообщение пользователю
        }             
    
?>