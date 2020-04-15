<?
include "PHPMailer/PHPMailer.php";
include "PHPMailer/SMTP.php";

class mail{

private $smtp_data = array(
	"host"			=> 'ssl://smtp.yandex.ru',	// SMTP сервер
    	"debug"			=> 0,	// Уровень логирования (0 выкл, 1 - вывод ошибок, 2- полный лог)
    	"debugoutput"		=> 'html',	//формат вывода лога, если включено логирование
    	"auth"			=> true,	// Авторизация на сервере SMTP. Если ее нет - false
    	"port"			=> 465,	// Порт SMTP сервера
    	"username"		=> '',	// Логин на SMTP сервере
    	"password"		=> '',	// Пароль на SMTP сервере
    	"fromname"		=> 'site',	// Отображаемое имя отправителя
    	"replyto"		=> array(
    		"address"	=> 'my@site.ru',	// адрес почты для ответа
    		"name"		=> 'My Name'	//отображаемое имя владельца ящика
    		),
    	"notification"	=> array(
    		"address"	=> '',	// Почта оповещения админа (не оповещать- оставить пустым)
    		"name"		=> 'My Name'	//отображаемое имя владельца ящика
    		),
    	"secure"			=> 'tls',	// Тип шифрования. Например ssl или tls
    	"charset"		=> 'UTF-8',	//кодировка отправляемых писем
    	"verify"			=> '0'	// Верификация сертификата. 0 -выкл, 1 - вкл (выключить при возникновении ошибок связанных с SSL сертификатами при отправке)
    );

private $mail_content = array( 
    'title'     => 'Информация с сайта',
    'header'        => 'Добрый день! ',
    'footer'        => '
            С Уважением,
            Администрация сайта.
            Это сообщение отправлено автоматически, на него не нужно отвечать.'
    );

private function fullText($text)
{
    if(!empty($text))
    {
        return $this->mail_content['header'] . $text . $this->mail_content['footer'];
    }
    else
    {
        die("Отсутствует текст письма");
    }
}

public function send($message_data)
{

    $mail = new PHPMailer;
    $mail->isSMTP();
    if($this->smtp_data['verify'] == 0)
    {
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ));
    }

    $mail->Host         = $this->smtp_data['host'];
    $mail->SMTPDebug    = $this->smtp_data['debug'];
    $mail->Debugoutput  = $this->smtp_data['debugoutput'];
    $mail->SMTPAuth     = $this->smtp_data['auth'];
    $mail->Port         = $this->smtp_data['port'];
    $mail->Username     = $this->smtp_data['username'];
    $mail->Password     = $this->smtp_data['password'];
    $mail->SMTPSecure   = $this->smtp_data['secure'];
    $mail->CharSet      = $this->smtp_data['charset'];
    $mail->setFrom($this->smtp_data['username'], $this->smtp_data['fromname']);
    $mail->addReplyTo($this->smtp_data['replyto']['address'], $this->smtp_data['replyto']['name']);
    if(!empty($this->smtp_data['notification']['address']))
    {
        $mail->addAddress($this->smtp_data['notification']['address'], $this->smtp_data['notification']['name']);
    }
    $mail->addAddress($message_data['to'], $message_data['to_name']);
    $mail->Subject = $this->mail_content['title'];
    $mail->msgHTML($this->fullText($message_data['text']));
    $mail->AltBody = strip_tags($this->fullText($message_data['text']));

    if (!$mail->send()) 
    {
        die("Mailer Error: " . $mail->ErrorInfo);
    } 
    else 
    {
        return 0;
    }
}
}
