<div class="head-slide-main-block">
		<div class="head-slides">
			<div class="head-slides-block">
				<div class="head-slide">
					<div class="slide-decoration knife"></div>
					<div class="slide-decoration phone slide-1"></div>
					<div class="slide-decoration-2 phone slide-2"></div>
					<div scroll_to="donate" class="button-buy-donate-slide linka"></div>
					<div class="slide-text-title slide-1 slide-2 slide-3">Выиграй Apple iPhone 11 Pro 64GB</div>
					<div class="slide-text-descr slide-1 slide-2 slide-3">Купив донат , у вас появляется шанс выиграть новый телефон. </div>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="main-content">
			<div class="express-block-first">
				<div id="donate" style="min-height: 682px;" class="express-block-b">
					<div class="express-block-a-name-block">Покупка донат-услуг</div>
					<div class="express-block-select-server">ВЫБЕРИТЕ СЕРВЕР:</div>
					<div class="express-server-select">
						<? 	/*Выводим сервера для выбора*/
							foreach($donate as $key => $val){
								if(!$server_select){
									echo "<div idServer=$key class='express-server select-server'>$val[name_server]</div>";
									$server_select = 1;
								}else{
									echo "<div idServer=$key class='express-server'>$val[name_server]</div>";
								}
							}
						?>
					</div>
					<div class="express-block-a-name-block-2">Введите ваш ник:</div>
					<input id='username' class="input-name">
					<div class="express-block-a-name-block-2">ВЫБЕРИТЕ ТОВАР:</div>
					<? 	/*Выводим донат для серверов*/
							foreach($donate as $key => $val){
								if(!$pex_select){
									echo "<div class='select-donate server-$key'><select id='server_pex_$key'>";
									$pex_select = 1;
								}else{
									echo "<div style='display: none;' class='select-donate server-$key'><select id='server_pex_$key'>";
								}
								foreach($val['donates'] as $key_donates => $val_donates){
									echo "<option value='$key_donates'>$val_donates[name]</option>";
								}
								echo "</select><div class='select-donate-arrow'></div></div>";
							}
					?>
					<div class="button-buy">КУПИТЬ</div>
				</div>
			</div>
			<div class="main-content-express">	
				<div class="express-block-a">
					<div class="express-decoration"></div>
					<div class="text-express">
						<div class="express-title-1">Выгодное предожение</div>
						<div class="express-title-2">КОНСОЛЬ СО СКИДКОЙ -90%</div>
						<div class="express-title-3">Поспеши, выгодней не будет!</div>
					</div>
					<div class="timer-express-block">
						<div class="timer-express">
							<div class="timer-express-time time-a">10</div>
							<div class="timer-express-time-title">ЧАСОВ</div>
						</div>
						<div class="timer-express">
							<div class="timer-express-time time-b">10</div>
							<div class="timer-express-time-title">МИНУТ</div>
						</div><div class="timer-express">
							<div class="timer-express-time time-c">10</div>
							<div class="timer-express-time-title">СЕКУНД</div>
						</div>
					</div>
				</div>
				<div class="express-block-a">
					<div class="express-decoration" style="background-image: url(/img/chest.png);margin-right: -63px;margin-top: 35px;"></div>
					<div class="text-express">
						<div class="express-title-1">Эксрпесс предложение</div>
						<div class="express-title-2">КЕЙС С ПРИВИЛЕГИЯМИ</div>
						<div class="express-title-3" style="padding-right: 50px;">ВЫБЕЙ ЛЮБОЙ ДОНАТ С ЛУЧШИМ ШАНСОМ!</div>
						<div class="express-title-4" style="padding-right: 50px;">x1000</div>
						<div class="express-title-5" style="padding-right: 50px;">
							<ohg class="cost-express-old" >100</ohg>
							<ohg class="cost-express-new">
								<ohg class="cost-express-new-text">
									40 рублей
								</ohg>
								<ohg class="cost-express-new-line"></ohg>
							</ohg>
						</div>
					</div>
				</div>
				<!--/*<div style="min-height: 801px;" class="express-block-a">
					<div class="express-block-a-name-block">Последние покупки</div>
					<div class="last-7-buy">
						<div class="block-last-buy">
							<div class="image-avatar"></div>
							<div class="info-user">
								<div class="info-user-name"></div>
								<div class="info-user-buy-what"></div>
								<div class="info-user-buy-why"></div>
							</div>
						</div>
					</div>
				</div>-->
			</div>
		</div>
		<div class="express-block-a-name-block-b">Последние покупки</div>
		<div class="last-7-buy">
			<div class="block-last-buy">
				<div class="image-avatar"></div>
				<div class="info-user">
					<div class="info-user-name">123</div>
					<div class="info-user-buy-what">Купил VIP</div>
					<div class="info-user-buy-why">Сегодня в 04:41</div>
				</div>
			</div>
			<div class="block-last-buy">
				<div class="image-avatar"></div>
				<div class="info-user">
					<div class="info-user-name">123</div>
					<div class="info-user-buy-what">Купил VIP</div>
					<div class="info-user-buy-why">Сегодня в 04:41</div>
				</div>
			</div>
		</div>
	</div>

<script>
var select_server_id = 0;
$(".express-server").click(function () {
	select_server_id = $(this).attr('idserver');
	$(".select-donate").css('display', 'none');
	$('.server-'+$(this).attr('idServer')).fadeIn();
	$(".express-server").each( function(){
		$(this).removeClass("select-server");
	});
	$(this).addClass("select-server");
});
$(".button-buy").click(function () {
	//Ид сервера console.log(select_server_id);
	//Привилегия console.log($("#server_pex_"+select_server_id).val());
	//Ник $("#username").val()
	if(!$("#username").val()){
		Lobibox.notify('error', {
            delay: 5000,
            title: "Ошибка",
            msg: "Вы не ввели свой ник"
         });
	}
	
	window.location.href = $("#domen").text()+"lib/donate/buy.php?server_id="+select_server_id+"&pex="+$("#server_pex_"+select_server_id).val()+"&user="+$("#username").val();
});
function preloadImages() {
  for (var i = 0; i < arguments.length; i++) {
    new Image().src = arguments[i];
  }
}

//preloadImages(
	
//);
</script>