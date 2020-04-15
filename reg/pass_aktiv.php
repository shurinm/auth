<?php
session_start(); //старт сесии
include "base.php"; //подключение файла с функциями
    $data = $_POST; //получение массива данных и проверка
    if( isset($data['do_signup']))
        {
        $errors = array();

        if ( $data['password'] == '') 
        {
            $errors[] = 'Введите пароль!';
        }

        if ( $data['password_2'] != $data['password']) 
        {
            $errors[] = 'Повторный пароль введен не верно!';
        }

        if( empty($errors)) //если ошибок нет делаем запрос в бд на изменение
        {
            $pass = md5($data['password']);
            $mail = $_SESSION['mail_pass'];
            $tocken = $_SESSION['tocken'];
            $strQuery = "UPDATE `users` SET  `tocken` ='' WHERE `email` ='$mail' AND `tocken` ='$tocken'";   //запрос к бд
        $varResult = QueryDB($strQuery); //ответ на запрос
            /*делаем проверку ответа и возвращаем результат*/
         if ($varResult == true){
            $strQuery = "UPDATE `users` SET `pass` = '$pass' WHERE `email` ='$mail'";   //запрос к бд
        $varResult = QueryDB($strQuery); //ответ на запрос
            /*делаем проверку ответа и возвращаем результат*/
         if ($varResult == true){
            header('Refresh: 1; URL=../reg/logau.php');   //переход на главную
            echo "Пароль успешно изменен!";  // сообщение пользователю
        }else{
            header('Refresh: 1; URL=../reg/logau.php');   //переход на главную страницу и закрытие сесии
            echo "Ошибка!";  // сообщение пользователю
        }}else{
            header('Refresh: 1; URL=../reg/logau.php');   //переход на главную страницу и закрытие сесии
            echo "Ошибка!";  // сообщение пользователю
        }        
        } else
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>'; //вывод ошибок
        }
    }
?>
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
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Восстановление пароля</h2>
<!-- форма --> 
    <form action="../reg/pass_aktiv.php" method="POST">

    <p><strong>Ваш пароль</strong>:</p>
    <input class="form-control" type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>
    <p> 
    <p><strong>Введите пароль еще раз</strong>:</p>
    <input class="form-control" type="password" name="password_2">
    </p>
    <p>
    <button class="btn btn-success" type="submit" name="do_signup">Сменить пароль</button>
    </p>    
    </form>
            </div>
        </div>
    </div>
</body>
</html>
