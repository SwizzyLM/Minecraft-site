$(function() {
	$(".btn1").click(function() {
	$(".form-signin").toggleClass("form-signin-left");
    $(".form-signup").toggleClass("form-signup-left");
    $(".frame").toggleClass("frame-long");
    $(".signup-inactive").toggleClass("signup-active");
    $(".signin-active").toggleClass("signin-inactive");
    $(".forgot").toggleClass("forgot-left");   
    $(this).removeClass("idle").addClass("active");
	});
});

$(function() {
	$(".close").click(function() {
		$(".auth-block").fadeOut();
	});
});
$(function() {
	$(".open_auth").click(function() {
		if(ham_active){
			ham_active = 0;
			$(".ham").removeClass("active");
			$('.hamburger-menu').fadeOut();
			$(".ham").css('position','');
			$(".ham").css('filter','');
			$(".ham").css('z-index','');
			$(".ham").css('margin-left','');
			$('.hanmt').css('z-index','');
			$('.hanmt').css('margin-left','');
			$('.hanmt').css('width','');
		}
		$(".auth-block").fadeIn();
	});
	$( window ).resize(function() {
		if($( window ).width() > 1243){
			if(ham_active){
				ham_active = 0;
				$(".ham").removeClass("active");
				$('.hamburger-menu').fadeOut();
				$(".ham").css('position','');
				$(".ham").css('filter','');
				$(".ham").css('z-index','');
				$(".ham").css('margin-left','');
				$('.hanmt').css('z-index','');
				$('.hanmt').css('margin-left','');
				$('.hanmt').css('width','');
			}
		}
	});
});

var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

$(function() {
	$(".btn-signup").click(function() {
		/*Регистрация*/
		if($("#register_username").val().length < 3){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка регистрации",
                msg: "Минимальная длина логина 3 символа."
            });
			return;
		}
		if($("#register_email").val().length < 4){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка регистрации",
                msg: "Некорректная почта"
            });
			return;
		}
		if(!pattern.test($("#register_email").val())){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка регистрации",
                msg: "Некорректная почта"
            });
			return;
		}
		if($("#register_password1").val().length < 4){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка регистрации",
                msg: "Минимальная длина пароля 4 символа."
            });
			return;
		}
		if($("#register_password1").val() != $("#register_password2").val()){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка регистрации",
                msg: "Пароли не совпадают!"
            });
			return;
		}
		
		$.post("/modules/auth/register.php", { login: $("#register_username").val(), password: $("#register_password1").val(), password2: $("#register_password2").val(), email: $("#register_email").val() })
		.done(function(data) {
				var RQData = JSON.parse(data);
				
                Lobibox.notify(RQData.notify, {
                    delay: 5000,
                    title: RQData.title,
                    msg: RQData.msg
                });
				
				
				if(RQData.notify == 'success'){
					setTimeout(() => {updatePage("cabinet")}, 2000);
				}
   
		});
		
	});
});

$(function() {
	$(".btn-signin").click(function() {
		/*Авторизация*/
		if($("#auth_username").val().length < 3){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка авторизации",
                msg: "Минимальная длина логина 3 символа."
            });
			return;
		}
		if($("#auth_password").val().length < 4){
			Lobibox.notify('warning', {
                delay: 5000,
                title: "Ошибка авторизации",
                msg: "Минимальная длина пароля 4 символа."
            });
			return;
		}
		$.post("/modules/auth/auth.php", { login: $("#auth_username").val(), password: $("#auth_password").val() })
		.done(function(data) {
				var RQData = JSON.parse(data);
				
                Lobibox.notify(RQData.notify, {
                    delay: 5000,
                    title: RQData.title,
                    msg: RQData.msg
                });
				
				
				if(RQData.notify == 'success'){
					setTimeout(() => {updatePage("cabinet")}, 2000);
				}
   
		});
	});
});