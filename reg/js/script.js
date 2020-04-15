/*в этом файле пишутся собственные скрипты*/
/*по нажатию регистрации отправка ajax и обработка ответов*/
  $(document).ready(function(){
    $("#do_signup").click(function(){
      
        $.ajax({
          type: "POST",
            url: "reg/reg.php",
            data: $("#create_order").serialize(),
            
    success: function(){
        //при успехе
    },
    timeout:30000 //30 секунд таймааут
        })

        .done(function( msg ) {
        	msg = msg.replace(/\s+/g, ' ').trim(); //удаление лишних пробелов
        	error1 = 'Введите Имя!';
        	error2 = 'Введите логин!';
        	error3 = 'Введите Email!';
        	error4 = 'Введите пароль!';
        	error5 = 'Повторный пароль введен не верно!';
        	error6 = 'Пользователь с таким логином уже существует!';
        	error7 = 'Пользователь с таким email уже существует!';
        	if(msg == error1){ //проверка на соответствуюшую ошибку и вывод 
        		document.getElementById("name_error").innerHTML = msg;	
        	}
        	if(msg == error2){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("login_error").innerHTML = msg;	
        	}
        	if(msg == error3){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("email_error").innerHTML = msg;	
        	}
        	if(msg == error4){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("pass_error").innerHTML = msg;	
        	}
        	if(msg == error5){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("pass2_error").innerHTML = msg;	
        	}
        	if(msg == error6){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("login_error").innerHTML = msg;	
        	}
        	if(msg == error7){ //проверка на соответствуюшую ошибку и вывод
        		document.getElementById("email_error").innerHTML = msg;	
        	}
            if(msg == true){    //проверка на результат ответа и вызов функции ShowAlertDanger
                ShowAlertDanger(); 
            }
      		if(msg == false){   //проверка на результат ответа и вызов функции ShowAlertDanger_false
                ShowAlertDanger_false(); 
            }
      })
    });

    
  });
/* функция вывода alert при успешной регистрации*/
function ShowAlertDanger() {

  swal({
  title: "Поздравляем, Вы успешно зарегистрированны!",
  text: 'На вашу почту было отправленно письмо с активацией',
  icon: "success",
  closeOnClickOutside: false,
  button: "ОК!",
});
}
/* функция вывода alert при ошибке*/
function ShowAlertDanger_false() {

  swal({
  title: "Ошибка регистрации",
  text: 'Попробуйте позже',
  icon: "error",
  closeOnClickOutside: false,
  button: "ОК!",
});
}

/*по нажатию восстановить отправка ajax и обработка ответов*/
  $(document).ready(function(){
    $("#do_signup_pass").click(function(){
      
        $.ajax({
          type: "POST",
            url: "recovery_pass.php",
            data: $("#create_order_pass").serialize(),
            
    success: function(){
        //при успехе
    },
    timeout:30000 //30 секунд таймааут
        })

        .done(function( msg ) {
          msg = msg.replace(/\s+/g, ' ').trim(); //удаление лишних пробелов
          error_email_pass = 'Пользователь с таким email не найден';
          if(msg == error_email_pass){ //проверка на соответствуюшую ошибку и вывод
            document.getElementById("email_error_pas").innerHTML = msg; 
          }
          if(msg == true){    //проверка на результат ответа и вызов функции ShowAlertDanger
                ShowAlertDanger1(); 
            }
          if(msg == false){   //проверка на результат ответа и вызов функции ShowAlertDanger_false
                ShowAlertDanger_false1(); 
            }
      })
    });

    
  });
/* функция вывода alert при успешной регистрации*/
function ShowAlertDanger1() {

  swal({
  title: "Вы запросили изменения пароля!",
  text: 'На вашу почту было отправленно письмо с инструкцией',
  icon: "success",
  closeOnClickOutside: false,
  button: "ОК!",
});
}
/* функция вывода alert при ошибке*/
function ShowAlertDanger_false1() {

  swal({
  title: "Ошибка изменения",
  text: 'Попробуйте позже',
  icon: "error",
  closeOnClickOutside: false,
  button: "ОК!",
});
}

