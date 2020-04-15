<?php 
include "mail.class.php"; //подключаем наш класс
/*Взаимодействие с базой данных*/
    define("DB_HOST", "localhost"); //адресс бд
    define("DB_USER", "");  //логин
    define("DB_PSWD", ""); //пароль
    define("DB_NAME", ""); //имя бд
    /*функция подключения к бд*/
    function QueryDB($strQuery) {
        $objLink = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME); //connect к бд
        /*при ошибки вернет false иначе продолжит выполнение*/
        if (!$objLink) {
            return false;
        }

        /*проверка на кодировку*/
        if (!mysqli_query($objLink, "SET NAMES UTF8")){
            return false;
        }
        $varResult = mysqli_query($objLink, $strQuery); //выполняем запрос к бд
        /*при ошибки вернет false иначе продолжит выполнение*/
        if (!$varResult) {
            return false;
        }
        /*при ошибки закрытия ранее открытого соединение с базой, вернет false иначе продолжит выполнение*/
        if (!mysqli_close($objLink)) {
            return false;
        }
        return $varResult; //возвращаем результат выполненного запроса
    }
    /*функция регистрации пользователя в бд*/
    function pushSELECT ($fio, $login, $pass, $email, $tocken) {
        $strQuery = "INSERT INTO `users`(`id`, `fio`, `login`, `pass`, `email`, `tocken`, `activation`) VALUES ('','$fio','$login','$pass','$email','$tocken','0')"; //запрос к бд
        
        $varResult = QueryDB($strQuery); //ответ на запрос
            /*делаем проверку ответа и возвращаем результат*/
        if ($varResult == true){
            return true;
        //echo "Информация занесена в базу данных";
        }else{
        //echo "Информация не занесена в базу данных";
            return "error";
        }                
    }
    /*функция авторизации пользователя*/
    function getuserSELECT ($login, $pass) {
        $strQuery = "SELECT * FROM `users` WHERE `login` ='$login' AND `pass` ='$pass';";   //запрос к бд 

        $varResult = QueryDB($strQuery); //ответ на запрос
        /*цикл проверки ответа и правильности получения логина и пароля*/
        $arrResult[] = null;    
        while($objRow = $varResult->fetch_array(MYSQLI_ASSOC))
        {
            $arrResult[] = $objRow;
        }
        if(count($arrResult) > 1){
        	return $arrResult[1];                
        }else{
       		return "error";
       }
    }
    /*функция проверки логина и email на существование*/
    function countSELECT ($danny, $fild) {
        $strQuery = "SELECT COUNT(*) FROM `users` WHERE `$fild` = '$danny'"; //запрос к бд
        $varResult = QueryDB($strQuery); //ответ на запрос
        return $varResult->fetch_row()[0]; // возвращаем значение функции
            
              
    }
    /*функция отправки сообщения о регистрации пользователю на email*/
    function message_add ($mail, $login, $tocken) {
        $message_data = array(      //задаем данные для отправки
            'to'        => $mail, 
            'to_name'   => 'site',    
            'text'      => "Здравствуйте! Спасибо за регистрацию на site\nВаш логин: ".$login."\n Перейдите по ссылке, чтобы активировать ваш аккаунт: Ваш_сайт/reg/activation.php?login=".$login."&code=".$tocken."\nС уважением,\n Администрация site"
        );
        $mailer = new mail; //создаем экземпляр нашего класса

        $sendmail = $mailer->send($message_data);   //отправляем наше письмо

        if($sendmail == 0)  //проверяем, отправилось ли оно вообще
        {

            $aaa = true;
        }
        else
        {

            $aaa = false;
        }
        return $aaa;
    }
        /*функция отправки сообщения о смене пароля пользователю на email*/
        function message_add_pass ($mail, $tocken) {
            // Создаем письмо
        $message_data = array(      //задаем данные для отправки
            'to'        => $mail, 
            'to_name'   => 'qqq',    
            'text'      => "Для вашего email была запрошена смена пароля на нашем сайте. Для продолжения перейдите пожалуйста по ссылке: Ваш_сайт/reg/pass_recovery.php?login=".$mail."&code=".$tocken."\n"
        );
        $mailer = new mail; //создаем экземпляр нашего класса

        $sendmail = $mailer->send($message_data);   //отправляем наше письмо

        if($sendmail == 0)  //проверяем, отправилось ли оно вообще
        {

            $aaa = true;
        }
        else
        {

            $aaa = false;
        }
        return $aaa;
        }
    /*функция внесения ip в список заблокированных*/
    function addip_bloc ($ip, $time) {
        $strQuery = "INSERT INTO `ipbloc`(`id`, `ip`, `time`) VALUES ('','$ip','$time')"; //запрос к бд
        
        QueryDB($strQuery); //заносим ip в бд
                
    }

    /*функция получения ip из списка заблокированных*/
    function ip_bloc () {
        $strQuery = "SELECT ip FROM `ipbloc`"; //запрос к бд
        
        $varResult = QueryDB($strQuery); //получаем ip 
        /*обрабатываем ответ и возвращаем в виде массива*/
        $arrResult[] = null;    
        while($objRow = $varResult->fetch_array(MYSQLI_ASSOC))
        {
            $arrResult[] = $objRow;
        }
        if(count($arrResult) > 1){
            return $arrResult;                
        }
        
                
    }

    /*функция создания токена для изменения пароля*/
    function tocken_pass ($tocken, $email) {
        $strQuery = "UPDATE `users` SET `tocken` = '$tocken' WHERE `email` ='$email'";   //запрос к бд
        $varResult = QueryDB($strQuery);
        return $varResult;

    }

?>