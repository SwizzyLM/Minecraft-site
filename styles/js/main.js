$(function () {
	if(document.URL.includes("#donate")){
		$('html, body').animate({
			scrollTop: $("#donate").offset().top
		}, 1000);
	}
});

/*CUSTOM CODE*/
$(".button-head").mouseenter(function() {
	$(this).addClass('animation-head-a-on');
})
.mouseleave(function(){                 
	$(this).removeClass('animation-head-a-on');
});
/*CUSTOM CODE*/
function copy_ip(el) {
		var $tmp = $("<textarea>");
		$("body").append($tmp);
		$tmp.val($("#"+el).text()).select();
		document.execCommand("copy");
		$tmp.remove();
		$(".copy-ip").css("background-image", "url(img/copy-ok.png)");
		Lobibox.notify('success', {
           delay: 5000,
		   title: 'Успешно скопировано',
           msg: $("#"+el).text()+' - скопировано'
        });
	}  

$(".linka").click(function () {
	if($("#"+$(this).attr("scroll_to")).length < 1) {
		window.location.href = $("#domen").text()+"/"+$(this).attr("page");
		return false;
	}
		// существует
	
	$('html, body').animate({
        scrollTop: $("#"+$(this).attr("scroll_to")).offset().top
    }, 1000);
    return false;
});

$(".up-block-category").click(function () {
	if ( $( ".down-category-shop" ).first().is( ":hidden" ) ) {
		$( ".down-category-shop" ).slideDown();
	  } else {
		$( ".down-category-shop" ).slideUp(200, "linear");
	  }
});

function str_rand() {
		var result = '';
		var words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		var max_position = words.length - 1;
			for( i = 0; i < 10; ++i ) {
				position = Math.floor ( Math.random() * max_position );
				result = result + words.substring(position, position + 1);
			}
		return result;
	}
	  

function update_MON(){
	/*$('.mon-id-1').each(function (index, value){
		var mon_server_name = $(this).attr('server');
		object_server = $(this);
		if(mon_server_name){
			$.get( "/modules/monitoring/cache/"+mon_server_name.toLowerCase()+".json", function() {
			})
			.done(function(data) {
				if(data){
					$('.'+mon_server_name).find('.mon-id-5').text('Онлайн '+data.online+'/'+data.max);
					$('.'+mon_server_name).find('.mon-id-2').removeClass("off");
					var percent = data.online * 100 / data.max;
					$('.'+mon_server_name).find('.mon-id-7-progress').css("width", percent+"%");
					
				}else{
					$('.'+mon_server_name).find('.mon-id-5').text('Выключен');
					$('.'+mon_server_name).find('.mon-id-7-progress').css("width", "0%");
					$('.'+mon_server_name).find('.mon-id-2').addClass("off");
				}
				console.log(data);
			})
			.fail(function() {
				console.log('false');
			});
		}
	});*/
	$.get( "/modules/monitoring/cache/globalOnline.json", function() {
	})
	.done(function(data) {
		if(data){
			$('.online-players').text('Онлайн: '+data);
		}else{
			$('.online-players').text('Онлайн: 0');
		}
	})
	.fail(function() {
		$('.online-players').text('Онлайн: 0');
	});
}
/*Мониторинг серов*/
var global_online = 0;
var object_server = false;
if($("*").is(".online-players")){
	update_MON();
	setInterval(function(){
		update_MON();
		//$('.progress-absolution-id3').text(global_online+' игроков');
	}, 5000);
}

var ham_active = 0;
$(".ham").click(function () {
	if(!ham_active){
		ham_active = 1;
		$('.hamburger-menu').fadeIn();
		$(this).css('position','fixed');
		$(this).css('z-index','3');
		$('.hanmt').css('z-index','2');
		$('.hanmt').css('margin-left','-50px');
		$('.hanmt').css('width','100px');
	}else{
		ham_active = 0;
		$('.hamburger-menu').fadeOut();
		$(this).css('position','');
		$(this).css('filter','');
		$(this).css('z-index','');
		$(this).css('margin-left','');
		$('.hanmt').css('z-index','');
		$('.hanmt').css('margin-left','');
		$('.hanmt').css('width','');
	}
});

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

$('#select_donate').change(function(){
  var cost = $(this)[0].value;
  cost = cost.replace(/[^0-9]/gim, "");
  //console.log($(this)[0].selectedIndex);
  $(".money").text(cost);
});

function buy_donate(){
	//console.log($("#domen").text()+"/lib/donate/buy.php?id="+$('#select_donate')[0].selectedIndex+"&name="+$("#name").val());
	if($("#name").val().length < 2){
		Lobibox.notify('warning', {
			delay: 5000,
			title: 'Ошибка ввода данных',
			msg: 'Вы не ввели свой логин'
		});
		return;
	}
	window.location.href = $("#domen").text()+"/lib/donate/buy.php?id="+$('#select_donate')[0].selectedIndex+"&user="+$("#name").val();
}

$(".modal").each( function(){
	$(this).wrap('<div class="overlay"></div>')
});
var RQData = null;
$("body").on("click", ".open-modal", function (e) {
	if($(this).data("modal") == "#shop"){
		RQData = JSON.parse($(this).find('.data-donate').text());
		RQData['cost_product'] = Number.parseInt(RQData['cost_product']);
		$('.buy-text-1').html(RQData['name_product']);
		$('.buy-text-2').html('Цена: '+RQData['cost_product']+' рублей');
		$('.buy-text-3').html(RQData['description']);
	}
	e.preventDefault();
	e.stopImmediatePropagation;
	
	var $this = $(this),
			modal = $($this).data("modal");
	
	$(modal).parents(".overlay").addClass("open");
	setTimeout( function(){
		$(modal).addClass("open");
	}, 350);
	
	$(document).on('click', function(e){
		var target = $(e.target);
		
		if ($(target).hasClass("overlay")){
			$(target).find(".modal").each( function(){
				$(this).removeClass("open");
			});
			setTimeout( function(){
				$(target).removeClass("open");
			}, 350);
		}
		
	});
});

var active_slide = 1;
$(".slide-list").on('click', function(e){
	if(active_slide == $(this).attr('id_slide')){
		return;
	}
	active_slide = $(this).attr('id_slide');
	$(".slide-list").each( function(){
		$(this).removeClass("active-slide");
	});
	$(this).addClass("active-slide");
	
	$(".slide-1").fadeOut();
	$(".slide-2").fadeOut();
	$(".slide-3").fadeOut();
	
	if($(this).attr('id_slide') == 1){
		setTimeout( function(){
			$('.head-slide').css('background-image', 'url(/img/slide-1.png)')
			$(".slide-text-title").text("Выиграй Apple iPhone 11 Pro 64GB");
			$(".slide-text-descr").text("Купив донат , у вас появляется шанс выиграть новый телефон. ");
			$(".slide-"+active_slide).fadeIn();
		}, 350);
	}
	if($(this).attr('id_slide') == 2){
		setTimeout( function(){
			$('.head-slide').css('background-image', 'url(/img/slide-2.png)')
			$(".slide-text-title").text("Хорошее оборудование");
			$(".slide-text-descr").text("У нас мощная VDS, которая позволит вам играть комфортно! ");
			$(".slide-"+active_slide).fadeIn();
		}, 350);
	}
	
	if($(this).attr('id_slide') == 3){
		setTimeout( function(){
			$('.head-slide').css('background-image', 'url(/img/slide-3.png)')
			$(".slide-text-title").text("Выигрывай сражения!");
			$(".slide-text-descr").text("Становись лидером на сервере, создавай свой клан, развивайся!");
			$(".slide-"+active_slide).fadeIn();
		}, 350);
	}

});	

$(".close-modal").on('click', function(e){
	e.preventDefault();
	e.stopImmediatePropagation;
	
	var $this = $(this),
			modal = $($this).data("modal");
	
	$(modal).removeClass("open");
	setTimeout( function(){	
		$(modal).parents(".overlay").removeClass("open");
	}, 350);
	
});	

$(".right-head-element").on('click', function(e){
	const windowOuterWidth = window.outerWidth
	if(windowOuterWidth > 1350){
		Lobibox.notify('info', {
			delay: 5000,
			title: 'Раздел недоступен.',
			msg: 'Данный раздел находится в разработке.'
	   });
	}
});

$(".close-modal").on('click', function(e){
	e.preventDefault();
	e.stopImmediatePropagation;
	
	var $this = $(this),
			modal = $($this).data("modal");
	
	$(modal).removeClass("open");
	setTimeout( function(){	
		$(modal).parents(".overlay").removeClass("open");
	}, 350);
	
});	

$(".buy-item-a").on('click', function(e){
	window.location.href = $("#domen").text()+"/lib/donate/buy.php?sum="+$("#sum_pay").val();
});

function Update_lastDonate(){
	setInterval(function(){
		$.post("/modules/last_donate/last_donate.php", { money: 'test' })
		.done(function(data) {
			if(data){
				$(".last-7-buy").html(data);
			}
		});
	}, 55000);
}

if($('*').is('.last-7-buy')) {
	$.post("/modules/last_donate/last_donate.php", { money: 'test' })
		.done(function(data) {
		if(data){
			$(".last-7-buy").html(data);
		}
	});
	Update_lastDonate();
}


function Update_lastBuy(){
	setInterval(function(){
		$.post("/modules/last_buy/last_buy.php", { money: 'test' })
		.done(function(data) {
			if(data){
				$(".history-info-all").html(data);
			}
		});
	}, 55000);
}

if($('*').is('.block-info-history')) {
	$.post("/modules/last_buy/last_buy.php", { money: 'test' })
		.done(function(data) {
		if(data){
			$(".history-info-all").html(data);
		}
	});
	Update_lastBuy();
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    total: t,
    days: days,
    hours: hours,
    minutes: minutes,
    seconds: seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);

  function updateClock() {
    var t = getTimeRemaining(endtime);

    if (t.total <= 0) {
      document.getElementById("countdown").className = "hidden";
      document.getElementById("deadline-message").className = "visible";
      clearInterval(timeinterval);
      return true;
    }

    //daysSpan.innerHTML = t.days;
    //hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
	var hours = "0" + t.hours;
	hours = hours.slice(-2)
	$(".time-a").text(hours);
	var minutes = "0" + t.minutes;
	minutes = minutes.slice(-2)
	$(".time-b").text(minutes);
	var second = "0" + t.seconds;
	second = second.slice(-2)
	$(".time-c").text(second);
  }//Пытался реализовать, но времени никак нету

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

$.post("/modules/timer/timer.php", { time: null })
.done(function(data) {
	console.log(data);
	var deadline = new Date(Date.parse(new Date()) + parseInt(data)); // for endless timer
	initializeClock("countdown", deadline);
});


function updatePage(links) {
	document.location.href = "/"+links;
}
$(".container").on('click', function(e){
	console.log($(this));
});	

$(window.atob('LnN0dWRpby1jb3AtbGluaw==')).css('display', 'block');
$(window.atob('LnN0dWRpby1jb3AtbGluaw==')).css('opacity', '1');
if(!$("*").is(window.atob('LnN0dWRpby1jb3AtbGluaw=='))){
	
	if($("*").is(window.atob('LmZvb3Rlci1kb3duLWNvbnRlbnQtcmlnaHQ='))){
		$(window.atob('LmZvb3Rlci1kb3duLWNvbnRlbnQtcmlnaHQ=')).append("<a href="+window.atob('aHR0cHM6Ly92ay5jb20vdW5pdmVyc2Fsc3R1ZGlv')+" class='studio-cop-link'></a>");
	}
	if(!$("*").is(window.atob('LmZvb3Rlci1kb3duLWNvbnRlbnQtcmlnaHQ='))){
		$(".footer").append("<div class='footer-down-content-right'><a href='"+window.atob('aHR0cHM6Ly92ay5jb20vdW5pdmVyc2Fsc3R1ZGlv')+"'class='studio-cop-link'></a></div>");
	}
}

var donate = window.location.hostname;
/*Всплывающие подсказки*/
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
$(function () {
    var IMG_PREFIX = 'demo/img/';
    (function () {
        Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
            iconSource: 'fontAwesome'
        });
        Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
            iconSource: 'fontAwesome'
        });

        (function () {
            $('#basicDefaultCustomDelay').click(function () {
                Lobibox.notify('default', {
                    delay: 15000,
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicInfoCustomDelay').click(function () {
                Lobibox.notify('info', {
                    delay: 15000,
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicWarningCustomDelay').click(function () {
                Lobibox.notify('warning', {
                    delay: 15000,
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            $('#basicErrorCustomDelay').click(function () {
                Lobibox.notify('error', {
                    delay: 5000,
                    title: "Ошибка авторизации",
                    msg: "Неправильный логин или пароль"
                });
            });
            $('#basicSuccessCustomDelay').click(function () {
                Lobibox.notify('success', {
                    delay: 15000,
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
        })();
    })();
});

console.log("Модуль успешно загружен!");