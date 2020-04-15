<?php
session_start(); //старт сесии
	include "base.php";	//подключение файла с функциями
$data = $_GET;	//получаем данные методом GET
	$login = $data['login']; //считываем почту
	$tocken = $data['code'];	//считываем токен
    $_SESSION['mail_pass'] = $login;
    $_SESSION['tocken'] = $tocken;
    if(countSELECT($login, 'email') && countSELECT($tocken, 'tocken')){
            header('Refresh: 1; URL=../reg/pass_aktiv.php');   //ввод пароля
        }else{
            header('Refresh: 1; URL=../reg/logau.php');   //переход на главную страницу и закрытие сесии
            echo "Ошибка!";  // сообщение пользователю
        }        
            ?>
            
    
