<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'sellers';
    header('Location: home');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
    <link rel="stylesheet" href="App/templates/files/css/main.css">
    <link rel="stylesheet" href="App/templates/files/css/adminpanel.css">
    <link rel="stylesheet" href="App/templates/files/css/table.css">
	<link rel="stylesheet" href="App/templates/files/css/toggleSwitch.css">
    <link rel="stylesheet" href="App/templates/files/css/sellers.css">
    <link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
	<link rel="stylesheet" href="App/templates/files/css/loadingImages.css">
</head>
<body>

    <!-- Админка -->
	<?php include __DIR__ . "/files/html/blocks/header.php";?>
	<?php include __DIR__ . "/files/html/blocks/leftMenu.php";?>

	<div class="<?php
					if($_SESSION['leftMenu'] == 'hidden') {
						echo "mainHtmlContent htmlContenToLeft";
					} else {
						echo "mainHtmlContent";
					}
				?>">
		<?php if($_SESSION['user']["typeofuser"] == 'Admin' && $_SESSION['user']['isblocked'] !== '1') { ?>
			
			<h2 class="main-title">Продавцы</h2>
		
			<div class="add_new_seller toggleModal0">Добавить<br>нового продавца</div>
		
		<div class="table_sellers">
			<table class="content-table">
				<thead>
					<tr>
						<th>ФИО</th>
						<th>Почта</th>
						<th>Дата добавления</th>
						<th>Разрешение<br>на продажу</th>
						<th>Статус<br>разрешения</th>
						<th>Статус<br>включения</th>
					</tr>
				</thead>
				<tbody>
					<?php
						  
					foreach ($sellers as $seller) {
						
						echo '<tr>
								  <td class="none" data-id="' . $seller->id . '" ';
						echo 'data-userId="' . $seller->userId . '" ';
					
						if($seller->img) {
							echo "data-img-url=\"" . $seller->img->url . "\" ";
							
							$pos_ext = strripos($seller->img->name, '.');			
							$minuspos = strlen($seller->img->name)-$pos_ext-1;								
							$file_ext = strtolower(substr($seller->img->name, $pos_ext+1, $minuspos));			
							$file_name = substr($seller->img->name, 0, $pos_ext);								
							$file_name = $file_name . '_150x150.' . $file_ext;
							
							echo "data-img-name=\"" . $file_name  . "\"";
						}
						echo "data-phones";
						if($seller->phones) {
							echo "=\"[";
							foreach($seller->phones as $phone) {
								echo "'" . $phone->contact . "', ";
							}
							echo "']\" ";
						} else {
							echo " ";
						}
						
						echo "data-jur-selected-type=\"";
						echo $seller->jurSelectedType;
						echo "\" ";
						
						echo "data-jur-type=\"";
						echo $seller->jurType;
						echo "\" ";
						
						echo "data-jur-name=\"";
						echo $seller->jurName;
						echo "\" ";
						
						echo "data-bank='";
						echo $seller->bank;
						echo "' ";
						
						echo "data-curr-acc-num=\"";
						echo $seller->currentAccountNumber;
						echo "\" ";
						
						echo "data-cor-acc-num=\"";
						echo $seller->correspondentAccountNumber;
						echo "\" ";
						
						echo "data-bik=\"";
						echo $seller->BIK;
						echo "\" ";
						
						echo "data-inn=\"";
						echo $seller->INN;
						echo "\" ";
						
						echo "data-isTrading=\"";
						echo $seller->isTrading;
						echo "\" ";
						
						echo "data-status-of-trading=\"";
						echo $seller->statusOfTrading;
						echo "\" ";
						
						echo "data-is-included=\"";
						echo $seller->isIncluded;
						echo "\" ";
						
						echo "data-bank-code=\"";
						echo $seller->bankCode;
						echo "\" ";
						
						echo "data-jur-add=\"[";
						foreach($seller->jurAddress as $prop=>$val) {
							echo "'" . $prop . "' = '" . $val . "', ";
						}
						echo "']\" ";
						
						echo "data-fact-add=\"[";
						foreach($seller->factAddress as $prop=>$val) {
							echo "'" . $prop . "' = '" . $val . "', ";
						}
						echo "']\" >";
						
						echo '</td>
							  <td class="full_name">' . $seller->full_name . '</td>';
						echo ' <td class="email">' . $seller->email . '</td>';
						echo ' <td>' . $seller->date_added . '</td>';
						if($seller->isTrading == "1") {
							echo  '<td>Одобрен</td>';
						} else {
							echo  '<td>Неодобрен</td>';							
						}
						
						if($seller->statusOfTrading !== NULL) {
							echo  '<td>' . $seller->statusOfTrading . '</td>';
						} else {
							echo '<td></td>';
						}
						
						if($seller->isIncluded == "1") {
							echo  '<td>Включён</td>';
						} else {
							echo  '<td>Выключен</td>';							
						}
						echo "<td class=\"editSeller\">
								<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
									<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>
								</svg><br>Редактировать
									</td>";
						echo "<td class=\"deleteSeller\">
								<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
									<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/></g>
								</svg><br>Удалить
									</td>";
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		
		<div class="editing_seller none">
			<div class="header">
				<span>Редактирование продавца</span>
				<div class="save-seller">
					<svg width="25" height="25" fill="#fff">
						<svg title="change" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 -256 1792 1792" enable-background="new 0 0 1000 1000" xml:space="preserve">
							<g transform="matrix(1,0,0,-1,129.08475,1270.2373)">
								<path d="m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z"></path>
							</g>
						</svg>
					</svg>
				</div>
				<div class="reply-seller">
					<svg width="25" height="25" fill="#fff">
						<svg title="Отменить" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480.000000 480.000000" preserveAspectRatio="xMidYMid meet">
							<g transform="translate(0.000000,480.000000) scale(0.100000,-0.100000)" stroke="none">
								<path d="M1045 3285 c-567 -480 -1030 -878 -1030 -885 0 -7 463 -405 1030
								-885 l1030 -871 3 478 2 478 223 0 c721 0 1238 -98 1692 -320 264 -129 466
								-278 683 -504 l122 -128 0 80 c0 112 -18 364 -36 507 -128 1009 -597 1625
								-1410 1854 -278 78 -474 101 -921 108 l-353 6 -2 476 -3 477 -1030 -871z"/>
							</g>
						</svg>
					</svg>
				</div>
				<button class="close" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
					</svg>
				</button>
			</div>
			<div class="field editFio">
				<label>ФИО:</label>
				<span class="input"></span>
			</div>
			<div class="field editPhoto">
				<label>Фотография:</label>
				<div class="input">
				</div>
			</div>
			<div class="field editMail">
				<label>Почта:</label>
				<span class="input"></span>
			</div>
			<div class="field editPhone">
				<label>Телефон:</label>
				<div class="input"></div>
			</div>
			<div class="field editEntity">				
				<label for="entityTypesSelect">Форма собственности:</label>
				<div class="input">
					<div>
					  <input type="radio" id="entityTypesList" value="list" name="entityType">
					  <label for="entityTypesList">Из списка</label>
					</div>
					<div>					  
					  <input type="radio" id="entityTypesInput" value="input" name="entityType">
					  <label for="entityTypesInput">Свой вариант</label>
					  <input type="text" id="seller_entityType" placeholder="Введите свой вариант">
					</div>
				</div>
			</div>
			<div class="field editJurName">				
				<label for="seller_jurName">Юридическое название:</label>
				<div class="input">
					<input type="text" id="seller_jurName">
				</div>
			</div>
			<div class="field editBank">				
				<label for="seller_bank">Банк в котором открыт счёт:</label>
				<div class="input">
					<input type="text" id="seller_bank">
				</div>
			</div>
			<div class="field editCurAccNum">				
				<label for="seller_currentAccountNumber">Номер расчётного счёта:</label>
				<div class="input">
					<input type="text" id="seller_currentAccountNumber">
				</div>
			</div>
			<div class="field editCorAccNum">				
				<label for="seller_cortAccountNumber">Номер корреспондентского счёта:</label>
				<div class="input">
					<input type="text" id="seller_cortAccountNumber">
				</div>
			</div>
			<div class="field editBIK">				
				<label for="seller_BIK">БИК:</label>
				<div class="input">
					<input type="text" id="seller_BIK">
				</div>
			</div>
			<div class="field editINN">				
				<label for="seller_INN">ИНН:</label>
				<div class="input">
					<input type="text" id="seller_INN">
				</div>
			</div>
			<div class="field">				
				<label>Юридический адрес:</label>
				<ul class="address-list">
					<li>
						<label for="seller_jurAddrCountry">Страна:</label>
						<div class="input">
							<select id="seller_jurAddrCountry">
								<option value="" disabled="">Выберите страну</option>
								<option value="rus">Российская Федерация</option>
								<option value="" disabled=""></option><option value="aus">Австралия</option>
								<option value="aut">Австрия</option>
								<option value="aze">Азербайджан</option>
								<option value="ala">Аландские Острова</option>
								<option value="alb">Албания</option>
								<option value="dza">Алжир</option>
								<option value="aia">Ангилья</option>
								<option value="ago">Ангола</option>
								<option value="and">Андорра</option>
								<option value="atg">Антигуа и Барбуда</option>
								<option value="ant">Антильские Острова (Нидерландские)</option>
								<option value="mac">Аомынь (Макао)</option>
								<option value="arg">Аргентина</option>
								<option value="arm">Армения</option>
								<option value="abw">Аруба</option>
								<option value="afg">Афганистан</option>
								<option value="bhs">Багамские Острова</option>
								<option value="bgd">Бангладеш</option>
								<option value="brb">Барбадос</option>
								<option value="bhr">Бахрейн</option>
								<option value="blr">Беларусь</option>
								<option value="blz">Белиз</option>
								<option value="bel">Бельгия</option>
								<option value="ben">Бенин</option>
								<option value="bmu">Бермудские Острова</option>
								<option value="bgr">Болгария</option>
								<option value="bol">Боливия</option>
								<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>
								<option value="bih">Босния и Герцеговина</option>
								<option value="bwa">Ботсвана</option>
								<option value="bra">Бразилия</option>
								<option value="iot">Британская территория в Индийском океане</option>
								<option value="brn">Бруней</option>
								<option value="bvt">Буве, остров</option>
								<option value="bfa">Буркина Фасо</option>
								<option value="bdi">Бурунди</option>
								<option value="btn">Бутан</option>
								<option value="vut">Вануату</option>
								<option value="vat">Ватикан</option>
								<option value="gbr">Великобритания</option>
								<option value="hun">Венгрия</option>
								<option value="ven">Венесуэла</option>
								<option value="vgb">Виргинские Острова (Британские)</option>
								<option value="vir">Виргинские Острова (США)</option>
								<option value="asm">Восточное Самоа</option>
								<option value="tls">Восточный Тимор</option>
								<option value="vnm">Вьетнам</option>
								<option value="gab">Габон</option>
								<option value="hti">Гаити</option>
								<option value="guy">Гайана</option>
								<option value="gmb">Гамбия</option>
								<option value="gha">Гана</option>
								<option value="glp">Гваделупа</option>
								<option value="gtm">Гватемала</option>
								<option value="guf">Гвиана Французская</option>
								<option value="gin">Гвинея</option>
								<option value="gnb">Гвинея-Бисау</option>
								<option value="deu">Германия</option>
								<option value="ggy">Гернси</option>
								<option value="gib">Гибралтар</option>
								<option value="hnd">Гондурас</option>
								<option value="hkg">Гонконг</option>
								<option value="grd">Гренада</option>
								<option value="grl">Гренландия</option>
								<option value="grc">Греция</option>
								<option value="geo">Грузия</option>
								<option value="gum">Гуам</option>
								<option value="dnk">Дания</option>
								<option value="jey">Джерси</option>
								<option value="dji">Джибути</option>
								<option value="dma">Доминика</option>
								<option value="dom">Доминиканская Республика</option>
								<option value="egy">Египет</option>
								<option value="zmb">Замбия</option>
								<option value="esh">Западная Сахара</option>
								<option value="wsm">Западное Самоа</option>
								<option value="zwe">Зимбабве</option>
								<option value="isr">Израиль</option>
								<option value="ind">Индия</option>
								<option value="idn">Индонезия</option>
								<option value="jor">Иордания</option>
								<option value="irq">Ирак</option>
								<option value="irn">Иран</option>
								<option value="irl">Ирландия</option>
								<option value="isl">Исландия</option>
								<option value="esp">Испания</option>
								<option value="ita">Италия</option>
								<option value="yem">Йемен</option>
								<option value="cpv">Кабо-Верде</option>
								<option value="kaz">Казахстан</option>
								<option value="cym">Каймановы острова</option>
								<option value="khm">Камбоджа</option>
								<option value="cmr">Камерун</option>
								<option value="can">Канада</option>
								<option value="qat">Катар</option>
								<option value="ken">Кения</option>
								<option value="cyp">Кипр</option>
								<option value="kgz">Киргизия (Кыргызстан)</option>
								<option value="kir">Кирибати</option>
								<option value="chn">Китай</option>
								<option value="cck">Кокосовые (Килинг) острова</option>
								<option value="col">Колумбия</option>
								<option value="com">Коморские Острова</option>
								<option value="cog">Конго</option>
								<option value="cod">Конго, Демократическая Республика</option>
								<option value="prk">Корейская Народно-Демократическая Республика</option>
								<option value="kor">Корея, Республика</option>
								<option value="cri">Коста-Рика</option>
								<option value="civ">Кот-д'Ивуар</option>
								<option value="cub">Куба</option>
								<option value="kwt">Кувейт</option>
								<option value="cok">Кука, Острова</option>
								<option value="cuw">Кюрасао</option>
								<option value="lao">Лаос</option>
								<option value="lva">Латвия</option>
								<option value="lso">Лесото</option>
								<option value="lbr">Либерия</option>
								<option value="lbn">Ливан</option>
								<option value="lby">Ливия</option>
								<option value="ltu">Литва</option>
								<option value="lie">Лихтенштейн</option>
								<option value="lux">Люксембург</option>
								<option value="mus">Маврикий</option>
								<option value="mrt">Мавритания</option>
								<option value="mdg">Мадагаскар</option>
								<option value="mkd">Македония</option>
								<option value="mwi">Малави</option>
								<option value="mys">Малайзия</option>
								<option value="mli">Мали</option>
								<option value="mdv">Мальдивы</option>
								<option value="mlt">Мальта</option>
								<option value="myt">Маоре (Майотта)</option>
								<option value="mar">Марокко</option>
								<option value="mtq">Мартиника</option>
								<option value="mhl">Маршалловы Острова</option>
								<option value="mex">Мексика</option>
								<option value="umi">Мелкие отдаленные острова США</option>
								<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>
								<option value="moz">Мозамбик</option>
								<option value="mda">Молдова</option>
								<option value="mco">Монако</option>
								<option value="mng">Монголия</option>
								<option value="msr">Монтсеррат</option>
								<option value="mmr">Мьянма (Бирма)</option>
								<option value="imn">Мэн, Остров</option>
								<option value="nam">Намибия</option>
								<option value="nru">Науру</option>
								<option value="npl">Непал</option>
								<option value="ner">Нигер</option>
								<option value="nga">Нигерия</option>
								<option value="nld">Нидерланды</option>
								<option value="nic">Никарагуа</option>
								<option value="niu">Ниуэ</option>
								<option value="nzl">Новая Зеландия</option>
								<option value="ncl">Новая Каледония</option>
								<option value="nor">Норвегия</option>
								<option value="nfk">Норфолк</option>
								<option value="are">Объединенные Арабские Эмираты</option>
								<option value="omn">Оман</option>
								<option value="pak">Пакистан</option>
								<option value="plw">Палау</option>
								<option value="pse">Палестина</option>
								<option value="pan">Панама</option>
								<option value="png">Папуа — Новая Гвинея</option>
								<option value="pry">Парагвай</option>
								<option value="per">Перу</option>
								<option value="pcn">Питкэрн</option>
								<option value="pol">Польша</option>
								<option value="prt">Португалия</option>
								<option value="pri">Пуэрто-Рико</option>
								<option value="abh">Республика Абхазия</option>
								<option value="ost">Республика Южная Осетия</option>
								<option value="reu">Реюньон</option>
								<option value="cxr">Рождества (Кристмас), Остров</option>
								<option value="rus">Российская Федерация</option>
								<option value="rwa">Руанда</option>
								<option value="rou">Румыния</option>
								<option value="slv">Сальвадор</option>
								<option value="smr">Сан-Марино</option>
								<option value="stp">Сан-Томе и Принсипи</option>
								<option value="sau">Саудовская Аравия</option>
								<option value="swz">Свазиленд</option>
								<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>
								<option value="shn">Святой Елены, Остров</option>
								<option value="mnp">Северные Марианские Острова</option>
								<option value="syc">Сейшельские Острова</option>
								<option value="maf">Сен-Мартен</option>
								<option value="spm">Сен-Пьер и Микелон</option>
								<option value="sen">Сенегал</option>
								<option value="blm">Сент-Бартельми</option>
								<option value="vct">Сент-Винсент и Гренадины</option>
								<option value="kna">Сент-Китс и Невис</option>
								<option value="lca">Сент-Люсия</option>
								<option value="srb">Сербия</option>
								<option value="sgp">Сингапур</option>
								<option value="sxm">Синт-Мартен</option>
								<option value="syr">Сирия</option>
								<option value="svk">Словакия</option>
								<option value="svn">Словения</option>
								<option value="usa">Соединенные Штаты Америки (США)</option>
								<option value="slb">Соломоновы Острова</option>
								<option value="som">Сомали</option>
								<option value="sdn">Судан</option>
								<option value="sur">Суринам</option>
								<option value="sle">Сьерра-Леоне</option>
								<option value="tjk">Таджикистан</option>
								<option value="tha">Таиланд</option>
								<option value="twn">Тайвань (провинция Китая)</option>
								<option value="tza">Танзания</option>
								<option value="tca">Теркс и Кайкос</option>
								<option value="tgo">Того</option>
								<option value="tkl">Токелау</option>
								<option value="ton">Тонга</option>
								<option value="tto">Тринидад и Тобаго</option>
								<option value="tuv">Тувалу</option>
								<option value="tun">Тунис</option>
								<option value="tkm">Туркменистан</option>
								<option value="tur">Турция</option>
								<option value="uga">Уганда</option>
								<option value="uzb">Узбекистан</option>
								<option value="ukr">Украина</option>
								<option value="wlf">Уоллис и Футуна</option>
								<option value="ury">Уругвай</option>
								<option value="fro">Фарерские острова</option>
								<option value="fji">Фиджи</option>
								<option value="phl">Филиппины</option>
								<option value="fin">Финляндия</option>
								<option value="flk">Фолклендские (Мальвинские) Острова</option>
								<option value="fra">Франция</option>
								<option value="pyf">Французская Полинезия</option>
								<option value="atf">Французские Южные территории</option>
								<option value="hmd">Херд и Макдональд, острова</option>
								<option value="hrv">Хорватия</option>
								<option value="caf">Центральноафриканская Республика</option>
								<option value="tcd">Чад</option>
								<option value="mne">Черногория</option>
								<option value="cze">Чешская Республика</option>
								<option value="chl">Чили</option>
								<option value="che">Швейцария</option>
								<option value="swe">Швеция</option>
								<option value="lka">Шри-Ланка</option>
								<option value="ecu">Эквадор</option>
								<option value="gnq">Экваториальная Гвинея</option>
								<option value="eri">Эритрея</option>
								<option value="est">Эстония</option>
								<option value="eth">Эфиопия</option>
								<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>
								<option value="zaf">Южно-Африканская Республика</option>
								<option value="ssd">Южный Судан</option>
								<option value="jam">Ямайка</option>
								<option value="jpn">Япония</option>
							</select>
						</div>
					</li>
					<li>
						<label for="seller_jurAddrIndex">Индекс:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrIndex">
						</div>
					</li>
					<li>
						<label for="seller_jurAddrRegion">Регион /край /область /другое:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrRegion">
						</div>
					</li>
					<li>
						<label for="seller_jurAddrCity">Город:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrCity">
						</div>
					</li>
					<li>
						<label for="seller_jurAddrStreet">Улица/ проспект/ проулок /другое:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrStreet">
						</div>
					</li>
					<li>
						<label for="seller_jurAddrHome">Номер дома:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrHome">
						</div>
					</li>
					<li>
						<label for="seller_jurAddrOffice">Номер квартиры/ офисы/ склады /другого:</label>
						<div class="input">
							<input type="text" id="seller_jurAddrOffice">
						</div>
					</li>
				</ul>
			</div>
			<div class="field">				
				<label>Фактический адрес:</label>
				<ul class="address-list">
					<li>
						<label for="seller_factAddrCountry">Страна:</label>
						<div class="input">
							<select id="seller_factAddrCountry">
								<option value="" disabled="">Выберите страну</option>
								<option value="rus">Российская Федерация</option>
								<option value="" disabled=""></option><option value="aus">Австралия</option>
								<option value="aut">Австрия</option>
								<option value="aze">Азербайджан</option>
								<option value="ala">Аландские Острова</option>
								<option value="alb">Албания</option>
								<option value="dza">Алжир</option>
								<option value="aia">Ангилья</option>
								<option value="ago">Ангола</option>
								<option value="and">Андорра</option>
								<option value="atg">Антигуа и Барбуда</option>
								<option value="ant">Антильские Острова (Нидерландские)</option>
								<option value="mac">Аомынь (Макао)</option>
								<option value="arg">Аргентина</option>
								<option value="arm">Армения</option>
								<option value="abw">Аруба</option>
								<option value="afg">Афганистан</option>
								<option value="bhs">Багамские Острова</option>
								<option value="bgd">Бангладеш</option>
								<option value="brb">Барбадос</option>
								<option value="bhr">Бахрейн</option>
								<option value="blr">Беларусь</option>
								<option value="blz">Белиз</option>
								<option value="bel">Бельгия</option>
								<option value="ben">Бенин</option>
								<option value="bmu">Бермудские Острова</option>
								<option value="bgr">Болгария</option>
								<option value="bol">Боливия</option>
								<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>
								<option value="bih">Босния и Герцеговина</option>
								<option value="bwa">Ботсвана</option>
								<option value="bra">Бразилия</option>
								<option value="iot">Британская территория в Индийском океане</option>
								<option value="brn">Бруней</option>
								<option value="bvt">Буве, остров</option>
								<option value="bfa">Буркина Фасо</option>
								<option value="bdi">Бурунди</option>
								<option value="btn">Бутан</option>
								<option value="vut">Вануату</option>
								<option value="vat">Ватикан</option>
								<option value="gbr">Великобритания</option>
								<option value="hun">Венгрия</option>
								<option value="ven">Венесуэла</option>
								<option value="vgb">Виргинские Острова (Британские)</option>
								<option value="vir">Виргинские Острова (США)</option>
								<option value="asm">Восточное Самоа</option>
								<option value="tls">Восточный Тимор</option>
								<option value="vnm">Вьетнам</option>
								<option value="gab">Габон</option>
								<option value="hti">Гаити</option>
								<option value="guy">Гайана</option>
								<option value="gmb">Гамбия</option>
								<option value="gha">Гана</option>
								<option value="glp">Гваделупа</option>
								<option value="gtm">Гватемала</option>
								<option value="guf">Гвиана Французская</option>
								<option value="gin">Гвинея</option>
								<option value="gnb">Гвинея-Бисау</option>
								<option value="deu">Германия</option>
								<option value="ggy">Гернси</option>
								<option value="gib">Гибралтар</option>
								<option value="hnd">Гондурас</option>
								<option value="hkg">Гонконг</option>
								<option value="grd">Гренада</option>
								<option value="grl">Гренландия</option>
								<option value="grc">Греция</option>
								<option value="geo">Грузия</option>
								<option value="gum">Гуам</option>
								<option value="dnk">Дания</option>
								<option value="jey">Джерси</option>
								<option value="dji">Джибути</option>
								<option value="dma">Доминика</option>
								<option value="dom">Доминиканская Республика</option>
								<option value="egy">Египет</option>
								<option value="zmb">Замбия</option>
								<option value="esh">Западная Сахара</option>
								<option value="wsm">Западное Самоа</option>
								<option value="zwe">Зимбабве</option>
								<option value="isr">Израиль</option>
								<option value="ind">Индия</option>
								<option value="idn">Индонезия</option>
								<option value="jor">Иордания</option>
								<option value="irq">Ирак</option>
								<option value="irn">Иран</option>
								<option value="irl">Ирландия</option>
								<option value="isl">Исландия</option>
								<option value="esp">Испания</option>
								<option value="ita">Италия</option>
								<option value="yem">Йемен</option>
								<option value="cpv">Кабо-Верде</option>
								<option value="kaz">Казахстан</option>
								<option value="cym">Каймановы острова</option>
								<option value="khm">Камбоджа</option>
								<option value="cmr">Камерун</option>
								<option value="can">Канада</option>
								<option value="qat">Катар</option>
								<option value="ken">Кения</option>
								<option value="cyp">Кипр</option>
								<option value="kgz">Киргизия (Кыргызстан)</option>
								<option value="kir">Кирибати</option>
								<option value="chn">Китай</option>
								<option value="cck">Кокосовые (Килинг) острова</option>
								<option value="col">Колумбия</option>
								<option value="com">Коморские Острова</option>
								<option value="cog">Конго</option>
								<option value="cod">Конго, Демократическая Республика</option>
								<option value="prk">Корейская Народно-Демократическая Республика</option>
								<option value="kor">Корея, Республика</option>
								<option value="cri">Коста-Рика</option>
								<option value="civ">Кот-д'Ивуар</option>
								<option value="cub">Куба</option>
								<option value="kwt">Кувейт</option>
								<option value="cok">Кука, Острова</option>
								<option value="cuw">Кюрасао</option>
								<option value="lao">Лаос</option>
								<option value="lva">Латвия</option>
								<option value="lso">Лесото</option>
								<option value="lbr">Либерия</option>
								<option value="lbn">Ливан</option>
								<option value="lby">Ливия</option>
								<option value="ltu">Литва</option>
								<option value="lie">Лихтенштейн</option>
								<option value="lux">Люксембург</option>
								<option value="mus">Маврикий</option>
								<option value="mrt">Мавритания</option>
								<option value="mdg">Мадагаскар</option>
								<option value="mkd">Македония</option>
								<option value="mwi">Малави</option>
								<option value="mys">Малайзия</option>
								<option value="mli">Мали</option>
								<option value="mdv">Мальдивы</option>
								<option value="mlt">Мальта</option>
								<option value="myt">Маоре (Майотта)</option>
								<option value="mar">Марокко</option>
								<option value="mtq">Мартиника</option>
								<option value="mhl">Маршалловы Острова</option>
								<option value="mex">Мексика</option>
								<option value="umi">Мелкие отдаленные острова США</option>
								<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>
								<option value="moz">Мозамбик</option>
								<option value="mda">Молдова</option>
								<option value="mco">Монако</option>
								<option value="mng">Монголия</option>
								<option value="msr">Монтсеррат</option>
								<option value="mmr">Мьянма (Бирма)</option>
								<option value="imn">Мэн, Остров</option>
								<option value="nam">Намибия</option>
								<option value="nru">Науру</option>
								<option value="npl">Непал</option>
								<option value="ner">Нигер</option>
								<option value="nga">Нигерия</option>
								<option value="nld">Нидерланды</option>
								<option value="nic">Никарагуа</option>
								<option value="niu">Ниуэ</option>
								<option value="nzl">Новая Зеландия</option>
								<option value="ncl">Новая Каледония</option>
								<option value="nor">Норвегия</option>
								<option value="nfk">Норфолк</option>
								<option value="are">Объединенные Арабские Эмираты</option>
								<option value="omn">Оман</option>
								<option value="pak">Пакистан</option>
								<option value="plw">Палау</option>
								<option value="pse">Палестина</option>
								<option value="pan">Панама</option>
								<option value="png">Папуа — Новая Гвинея</option>
								<option value="pry">Парагвай</option>
								<option value="per">Перу</option>
								<option value="pcn">Питкэрн</option>
								<option value="pol">Польша</option>
								<option value="prt">Португалия</option>
								<option value="pri">Пуэрто-Рико</option>
								<option value="abh">Республика Абхазия</option>
								<option value="ost">Республика Южная Осетия</option>
								<option value="reu">Реюньон</option>
								<option value="cxr">Рождества (Кристмас), Остров</option>
								<option value="rus">Российская Федерация</option>
								<option value="rwa">Руанда</option>
								<option value="rou">Румыния</option>
								<option value="slv">Сальвадор</option>
								<option value="smr">Сан-Марино</option>
								<option value="stp">Сан-Томе и Принсипи</option>
								<option value="sau">Саудовская Аравия</option>
								<option value="swz">Свазиленд</option>
								<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>
								<option value="shn">Святой Елены, Остров</option>
								<option value="mnp">Северные Марианские Острова</option>
								<option value="syc">Сейшельские Острова</option>
								<option value="maf">Сен-Мартен</option>
								<option value="spm">Сен-Пьер и Микелон</option>
								<option value="sen">Сенегал</option>
								<option value="blm">Сент-Бартельми</option>
								<option value="vct">Сент-Винсент и Гренадины</option>
								<option value="kna">Сент-Китс и Невис</option>
								<option value="lca">Сент-Люсия</option>
								<option value="srb">Сербия</option>
								<option value="sgp">Сингапур</option>
								<option value="sxm">Синт-Мартен</option>
								<option value="syr">Сирия</option>
								<option value="svk">Словакия</option>
								<option value="svn">Словения</option>
								<option value="usa">Соединенные Штаты Америки (США)</option>
								<option value="slb">Соломоновы Острова</option>
								<option value="som">Сомали</option>
								<option value="sdn">Судан</option>
								<option value="sur">Суринам</option>
								<option value="sle">Сьерра-Леоне</option>
								<option value="tjk">Таджикистан</option>
								<option value="tha">Таиланд</option>
								<option value="twn">Тайвань (провинция Китая)</option>
								<option value="tza">Танзания</option>
								<option value="tca">Теркс и Кайкос</option>
								<option value="tgo">Того</option>
								<option value="tkl">Токелау</option>
								<option value="ton">Тонга</option>
								<option value="tto">Тринидад и Тобаго</option>
								<option value="tuv">Тувалу</option>
								<option value="tun">Тунис</option>
								<option value="tkm">Туркменистан</option>
								<option value="tur">Турция</option>
								<option value="uga">Уганда</option>
								<option value="uzb">Узбекистан</option>
								<option value="ukr">Украина</option>
								<option value="wlf">Уоллис и Футуна</option>
								<option value="ury">Уругвай</option>
								<option value="fro">Фарерские острова</option>
								<option value="fji">Фиджи</option>
								<option value="phl">Филиппины</option>
								<option value="fin">Финляндия</option>
								<option value="flk">Фолклендские (Мальвинские) Острова</option>
								<option value="fra">Франция</option>
								<option value="pyf">Французская Полинезия</option>
								<option value="atf">Французские Южные территории</option>
								<option value="hmd">Херд и Макдональд, острова</option>
								<option value="hrv">Хорватия</option>
								<option value="caf">Центральноафриканская Республика</option>
								<option value="tcd">Чад</option>
								<option value="mne">Черногория</option>
								<option value="cze">Чешская Республика</option>
								<option value="chl">Чили</option>
								<option value="che">Швейцария</option>
								<option value="swe">Швеция</option>
								<option value="lka">Шри-Ланка</option>
								<option value="ecu">Эквадор</option>
								<option value="gnq">Экваториальная Гвинея</option>
								<option value="eri">Эритрея</option>
								<option value="est">Эстония</option>
								<option value="eth">Эфиопия</option>
								<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>
								<option value="zaf">Южно-Африканская Республика</option>
								<option value="ssd">Южный Судан</option>
								<option value="jam">Ямайка</option>
								<option value="jpn">Япония</option>
							</select>
						</div>
					</li>
					<li>
						<label for="seller_factAddrIndex">Индекс:</label>
						<div class="input">
							<input type="text" id="seller_factAddrIndex">
						</div>
					</li>
					<li>
						<label for="seller_factAddrRegion">Регион /край /область /другое:</label>
						<div class="input">
							<input type="text" id="seller_factAddrRegion">
						</div>
					</li>
					<li>
						<label for="seller_factAddrCity">Город:</label>
						<div class="input">
							<input type="text" id="seller_factAddrCity">
						</div>
					</li>
					<li>
						<label for="seller_factAddrStreet">Улица/ проспект/ проулок /другое:</label>
						<div class="input">
							<input type="text" id="seller_factAddrStreet">
						</div>
					</li>
					<li>
						<label for="seller_factAddrHome">Номер дома:</label>
						<div class="input">
							<input type="text" id="seller_factAddrHome">
						</div>
					</li>
					<li>
						<label for="seller_factAddrOffice">Номер квартиры/ офисы/ склады /другого:</label>
						<div class="input">
							<input type="text" id="seller_factAddrOffice">
						</div>
					</li>
				</ul>
			</div>
			<div class="field editIsTrading">				
				<label for="seller_isTrading">Разрешение на продажу:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<div class="field">				
				<label for="seller_statusOfTrading">Статус разрешения:</label>
				<div class="input">
					<input type="text" id="seller_statusOfTrading">
				</div>
			</div>
			<div class="field editIsIncluded">				
				<label for="seller_isIncluded">Статус включения:</label>
				<div class="input">
					<div class="isShow"></div>
				</div>
			</div>
			<div class="field">				
				<label for="seller_bankCode">PayU код продавца:</label>
				<div class="input">
					<input type="text" id="seller_bankCode">
				</div>
			</div>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock toggleModal1" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Изменение фотографии</div>
				<div class="select-all">
					<svg width="19" height="19" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/select-all.svg" ?>
					</svg>					
				</div>
				<div class="delete-bin">
					<svg width="17" height="17"  viewBox="0 0 225.000000 225.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/delete-bin.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal1" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" multiple accept="image/*" name="fileToUpload1" id="fileToUpload1" class="none">
						<div class="camera">
							<svg width="45" height="45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
								<?php include __DIR__ . "/files/img/icons/camera.svg" ?>
							</svg>
						</div>
						<div class="title">
							Отпустите, чтобы начать загрузку
						</div>
				</div>
			</div>
			
			<label class="modalLoadNewPhoto" for="fileToUpload1">
				<div class="title">
					<svg class="iconPlus" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
					<span>Загрузить новую фотографию</span> 
				</div>
			</label>
			
			<div class="modalBody">
				<div class="fileUploadError"></div>
				<div class="fileLoading"></div>
				
				<div class="windowAllImages">
				
					<div class="rowImages">
						<?php
							foreach ($images as $img) {								
								echo "<div class=\"imageCart\">
									<div class='hoverForSelect notSelect'>
									<div class='shadow'></div>
									<div class='before1'></div>
									<div class='before2'></div>
									<div class='after1'></div>
									<div class='after2'></div>
									<div class='selectImages'><div class='item'><div class='galka'></div></div></div>
								
								<img src='" . $img["url"];
								
								$pos_ext = strripos($img["name"], '.');			
								$minuspos = strlen($img["name"])-$pos_ext-1;								
								$file_ext = strtolower(substr($img["name"], $pos_ext+1, $minuspos));			
								$file_name = substr($img["name"], 0, $pos_ext);								
								$file_name = $file_name . '_150x150.' . $file_ext;
								
								$dataFileName = $img["name"];
					
								echo $file_name . "' alt='' class='avatarImages' width='153px' height = '153px' data-filename='";
								echo $dataFileName . "'></div></div>";
							}
						 ?>
					</div>	
				</div>
			</div>
			
		  </div>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock addNewTable toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление нового продавца</div>
				<div class="save-new-table level2">
					<svg width="25" height="25" fill="#fff">
						<?php include __DIR__ . "/files/img/icons/save.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal0" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>
					<label for="add_new_user_fio">ФИО:</label>
					<input type="text" id="add_new_user_fio">
				</div>
				<div class="addNewSeller_email">
					<label for="add_new_user_email">Email:</label>
					<input type="text" id="add_new_user_email">
				</div>
				<div class="title_for_input">
					В данном пункте пишем электронную почту, которую продавец всегда сможет проверить и куда будут приходить уведомления о продаже товаров.
				</div>
				<div class="add_new_user_phone">
					<label for="add_new_user_phoneCode">Телефон(ы) контактный(е) для связи с Saterno:</label>
					<div>
						<div class="input">
							<div class="code">
								<input type="text" id="add_new_user_phoneCode" value="+">
								<label for="add_new_user_phoneCode">Код страны</label>
							</div>
							<div class="number">
								<input type="text" id="add_new_user_phone">
								<label for="add_new_user_phone">Номер телефона</label>
							</div>
						</div>
					</div>					
				</div>
				<div class="title_for_input">
					В данном пункте пишем телефон(ы), куда смогут звонить сотрудники Saterno.
					<!--
					Телефон(ы) для отслеживания покупок:
					В данном пункте пишем телефон(ы), куда смогут звонить покупатели для отслеживания покупок или консультаций.
					-->
				</div>
				<div>
					<label for="add_new_user_password">Пароль:</label>
					<input type="password" id="add_new_user_password">
				</div>
				<div class="addNewSeller_shopName">
					<label for="addNewSeller_nameOfShop">Название магазина:</label>
					<input type="text" id="addNewSeller_nameOfShop">
				</div>
				<div class="title_for_input">
					В данном пункте пишем только название магазина по которому продавец хотел бы, чтобы его искали в Яндексе и которое будет размещено на странице магазина в Saterno. (Это не название ИП или юр. лица, а бренд магазина)
				</div>
				<div class="addNewSeller_URLShop">
					<label for="addNewSeller_URLShop">URL магазина:</label>
					<input type="text" id="addNewSeller_URLShop">
				</div>
				<div class="title_for_input">
					В данном пункте пишем то, как продавец хотел бы, чтобы писался адрес его магазина в адресной строке, по типу: www.saterno.ru/vashadresmagazina,
					где URL это vashadresmagazina, без обратного слеша /
				</div>
				<div class="addNewSeller_descriptionOfShop">
					<label for="addNewSeller_descriptionOfShop">Описание магазина:</label>
					<textarea type="text" id="addNewSeller_descriptionOfShop"></textarea>
				</div>
				<div class="title_for_input">
					Этот текст будет в описании магазина на его странице в Saterno. 
					Описание должно быть уникальным, не скопированным из сети.
				</div>
				<div class="addNewSeller_logoOfShop">
					<label>Логотип магазина:</label>
					<img src="App/templates/files/img/shops/default.png" width="50px" height="50px">
					<svg class="toggleModal3 level2" width="15px" height="15px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
						<g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g>
					</svg>
				</div>
				<div class="title_for_input">
					Логотип появится на странице магазина в Saterno.					
				</div>
				<div class="addNewSeller_phone">
					<label for="addNewSeller_phoneCode">Телефон(ы) для отслеживания покупок:</label>
					<div>
						<div class="input">
							<div class="code">
								<input type="text" id="addNewSeller_phoneCode" value="+">
								<label for="addNewSeller_phoneCode">Код страны</label>
							</div>
							<div class="number">
								<input type="text" id="addNewSeller_phone">
								<label for="addNewSeller_phone">Номер телефона</label>
							</div>
						</div>
					</div>					
				</div>
				<div class="title_for_input">
					В данном пункте пишем телефон(ы), куда смогут звонить покупатели для отслеживания покупок или консультаций.
				</div>
				<div class="addNewSeller_stockroom">
					<label for="addNewSeller_stockAddrRegion">Склады:</label>
					
					<div class="addNewStockroom">
						<div class="line-1"></div>
						<div class="line-2"></div>
					</div>
					<div class="title_for_inputFly">
						Вы можете вводить 1,2,3 и более адресов складов. При добавлении товара, на каждый товар нужно выбирать адрес склада.
						Если склад один, он автоматически проставляется на все товары. Если складов 2 и более, то нужно выбирать из списка складов.
					</div>
					<div class="stockRoomList">
						<ul class="address-list">
							<span class="numberStock">Склад 1</span>
							<li>
								<label for="addNewSeller_stockAddrIndex1">Индекс:</label>
								<input type="text" id="addNewSeller_stockAddrIndex1">
							</li>
            				<div class="title_for_input">
            					Индекс должен обязательно соответствовать городу, в котором находится склад.
            					Именно по почтовому индексу будет определятся город для создания заказов в системе доставки.
            				</div>
							<li>
								<label for="addNewSeller_stockAddrCountry1">Страна:</label>
								<select id="addNewSeller_stockAddrCountry1">
									<option value="" disabled="">Выберите страну</option>
									<option value="rus">Российская Федерация</option>
									<option value="" disabled=""></option>
									<option value="aus">Австралия</option>
									<option value="aut">Австрия</option>
									<option value="aze">Азербайджан</option>
									<option value="ala">Аландские Острова</option>
									<option value="alb">Албания</option>
									<option value="dza">Алжир</option>
									<option value="aia">Ангилья</option>
									<option value="ago">Ангола</option>
									<option value="and">Андорра</option>
									<option value="atg">Антигуа и Барбуда</option>
									<option value="ant">Антильские Острова (Нидерландские)</option>
									<option value="mac">Аомынь (Макао)</option>
									<option value="arg">Аргентина</option>
									<option value="arm">Армения</option>
									<option value="abw">Аруба</option>
									<option value="afg">Афганистан</option>
									<option value="bhs">Багамские Острова</option>
									<option value="bgd">Бангладеш</option>
									<option value="brb">Барбадос</option>
									<option value="bhr">Бахрейн</option>
									<option value="blr">Беларусь</option>
									<option value="blz">Белиз</option>
									<option value="bel">Бельгия</option>
									<option value="ben">Бенин</option>
									<option value="bmu">Бермудские Острова</option>
									<option value="bgr">Болгария</option>
									<option value="bol">Боливия</option>
									<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>
									<option value="bih">Босния и Герцеговина</option>
									<option value="bwa">Ботсвана</option>
									<option value="bra">Бразилия</option>
									<option value="iot">Британская территория в Индийском океане</option>
									<option value="brn">Бруней</option>
									<option value="bvt">Буве, остров</option>
									<option value="bfa">Буркина Фасо</option>
									<option value="bdi">Бурунди</option>
									<option value="btn">Бутан</option>
									<option value="vut">Вануату</option>
									<option value="vat">Ватикан</option>
									<option value="gbr">Великобритания</option>
									<option value="hun">Венгрия</option>
									<option value="ven">Венесуэла</option>
									<option value="vgb">Виргинские Острова (Британские)</option>
									<option value="vir">Виргинские Острова (США)</option>
									<option value="asm">Восточное Самоа</option>
									<option value="tls">Восточный Тимор</option>
									<option value="vnm">Вьетнам</option>
									<option value="gab">Габон</option>
									<option value="hti">Гаити</option>
									<option value="guy">Гайана</option>
									<option value="gmb">Гамбия</option>
									<option value="gha">Гана</option>
									<option value="glp">Гваделупа</option>
									<option value="gtm">Гватемала</option>
									<option value="guf">Гвиана Французская</option>
									<option value="gin">Гвинея</option>
									<option value="gnb">Гвинея-Бисау</option>
									<option value="deu">Германия</option>
									<option value="ggy">Гернси</option>
									<option value="gib">Гибралтар</option>
									<option value="hnd">Гондурас</option>
									<option value="hkg">Гонконг</option>
									<option value="grd">Гренада</option>
									<option value="grl">Гренландия</option>
									<option value="grc">Греция</option>
									<option value="geo">Грузия</option>
									<option value="gum">Гуам</option>
									<option value="dnk">Дания</option>
									<option value="jey">Джерси</option>
									<option value="dji">Джибути</option>
									<option value="dma">Доминика</option>
									<option value="dom">Доминиканская Республика</option>
									<option value="egy">Египет</option>
									<option value="zmb">Замбия</option>
									<option value="esh">Западная Сахара</option>
									<option value="wsm">Западное Самоа</option>
									<option value="zwe">Зимбабве</option>
									<option value="isr">Израиль</option>
									<option value="ind">Индия</option>
									<option value="idn">Индонезия</option>
									<option value="jor">Иордания</option>
									<option value="irq">Ирак</option>
									<option value="irn">Иран</option>
									<option value="irl">Ирландия</option>
									<option value="isl">Исландия</option>
									<option value="esp">Испания</option>
									<option value="ita">Италия</option>
									<option value="yem">Йемен</option>
									<option value="cpv">Кабо-Верде</option>
									<option value="kaz">Казахстан</option>
									<option value="cym">Каймановы острова</option>
									<option value="khm">Камбоджа</option>
									<option value="cmr">Камерун</option>
									<option value="can">Канада</option>
									<option value="qat">Катар</option>
									<option value="ken">Кения</option>
									<option value="cyp">Кипр</option>
									<option value="kgz">Киргизия (Кыргызстан)</option>
									<option value="kir">Кирибати</option>
									<option value="chn">Китай</option>
									<option value="cck">Кокосовые (Килинг) острова</option>
									<option value="col">Колумбия</option>
									<option value="com">Коморские Острова</option>
									<option value="cog">Конго</option>
									<option value="cod">Конго, Демократическая Республика</option>
									<option value="prk">Корейская Народно-Демократическая Республика</option>
									<option value="kor">Корея, Республика</option>
									<option value="cri">Коста-Рика</option>
									<option value="civ">Кот-д'Ивуар</option>
									<option value="cub">Куба</option>
									<option value="kwt">Кувейт</option>
									<option value="cok">Кука, Острова</option>
									<option value="cuw">Кюрасао</option>
									<option value="lao">Лаос</option>
									<option value="lva">Латвия</option>
									<option value="lso">Лесото</option>
									<option value="lbr">Либерия</option>
									<option value="lbn">Ливан</option>
									<option value="lby">Ливия</option>
									<option value="ltu">Литва</option>
									<option value="lie">Лихтенштейн</option>
									<option value="lux">Люксембург</option>
									<option value="mus">Маврикий</option>
									<option value="mrt">Мавритания</option>
									<option value="mdg">Мадагаскар</option>
									<option value="mkd">Македония</option>
									<option value="mwi">Малави</option>
									<option value="mys">Малайзия</option>
									<option value="mli">Мали</option>
									<option value="mdv">Мальдивы</option>
									<option value="mlt">Мальта</option>
									<option value="myt">Маоре (Майотта)</option>
									<option value="mar">Марокко</option>
									<option value="mtq">Мартиника</option>
									<option value="mhl">Маршалловы Острова</option>
									<option value="mex">Мексика</option>
									<option value="umi">Мелкие отдаленные острова США</option>
									<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>
									<option value="moz">Мозамбик</option>
									<option value="mda">Молдова</option>
									<option value="mco">Монако</option>
									<option value="mng">Монголия</option>
									<option value="msr">Монтсеррат</option>
									<option value="mmr">Мьянма (Бирма)</option>
									<option value="imn">Мэн, Остров</option>
									<option value="nam">Намибия</option>
									<option value="nru">Науру</option>
									<option value="npl">Непал</option>
									<option value="ner">Нигер</option>
									<option value="nga">Нигерия</option>
									<option value="nld">Нидерланды</option>
									<option value="nic">Никарагуа</option>
									<option value="niu">Ниуэ</option>
									<option value="nzl">Новая Зеландия</option>
									<option value="ncl">Новая Каледония</option>
									<option value="nor">Норвегия</option>
									<option value="nfk">Норфолк</option>
									<option value="are">Объединенные Арабские Эмираты</option>
									<option value="omn">Оман</option>
									<option value="pak">Пакистан</option>
									<option value="plw">Палау</option>
									<option value="pse">Палестина</option>
									<option value="pan">Панама</option>
									<option value="png">Папуа — Новая Гвинея</option>
									<option value="pry">Парагвай</option>
									<option value="per">Перу</option>
									<option value="pcn">Питкэрн</option>
									<option value="pol">Польша</option>
									<option value="prt">Португалия</option>
									<option value="pri">Пуэрто-Рико</option>
									<option value="abh">Республика Абхазия</option>
									<option value="ost">Республика Южная Осетия</option>
									<option value="reu">Реюньон</option>
									<option value="cxr">Рождества (Кристмас), Остров</option>
									<option value="rus">Российская Федерация</option>
									<option value="rwa">Руанда</option>
									<option value="rou">Румыния</option>
									<option value="slv">Сальвадор</option>
									<option value="smr">Сан-Марино</option>
									<option value="stp">Сан-Томе и Принсипи</option>
									<option value="sau">Саудовская Аравия</option>
									<option value="swz">Свазиленд</option>
									<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>
									<option value="shn">Святой Елены, Остров</option>
									<option value="mnp">Северные Марианские Острова</option>
									<option value="syc">Сейшельские Острова</option>
									<option value="maf">Сен-Мартен</option>
									<option value="spm">Сен-Пьер и Микелон</option>
									<option value="sen">Сенегал</option>
									<option value="blm">Сент-Бартельми</option>
									<option value="vct">Сент-Винсент и Гренадины</option>
									<option value="kna">Сент-Китс и Невис</option>
									<option value="lca">Сент-Люсия</option>
									<option value="srb">Сербия</option>
									<option value="sgp">Сингапур</option>
									<option value="sxm">Синт-Мартен</option>
									<option value="syr">Сирия</option>
									<option value="svk">Словакия</option>
									<option value="svn">Словения</option>
									<option value="usa">Соединенные Штаты Америки (США)</option>
									<option value="slb">Соломоновы Острова</option>
									<option value="som">Сомали</option>
									<option value="sdn">Судан</option>
									<option value="sur">Суринам</option>
									<option value="sle">Сьерра-Леоне</option>
									<option value="tjk">Таджикистан</option>
									<option value="tha">Таиланд</option>
									<option value="twn">Тайвань (провинция Китая)</option>
									<option value="tza">Танзания</option>
									<option value="tca">Теркс и Кайкос</option>
									<option value="tgo">Того</option>
									<option value="tkl">Токелау</option>
									<option value="ton">Тонга</option>
									<option value="tto">Тринидад и Тобаго</option>
									<option value="tuv">Тувалу</option>
									<option value="tun">Тунис</option>
									<option value="tkm">Туркменистан</option>
									<option value="tur">Турция</option>
									<option value="uga">Уганда</option>
									<option value="uzb">Узбекистан</option>
									<option value="ukr">Украина</option>
									<option value="wlf">Уоллис и Футуна</option>
									<option value="ury">Уругвай</option>
									<option value="fro">Фарерские острова</option>
									<option value="fji">Фиджи</option>
									<option value="phl">Филиппины</option>
									<option value="fin">Финляндия</option>
									<option value="flk">Фолклендские (Мальвинские) Острова</option>
									<option value="fra">Франция</option>
									<option value="pyf">Французская Полинезия</option>
									<option value="atf">Французские Южные территории</option>
									<option value="hmd">Херд и Макдональд, острова</option>
									<option value="hrv">Хорватия</option>
									<option value="caf">Центральноафриканская Республика</option>
									<option value="tcd">Чад</option>
									<option value="mne">Черногория</option>
									<option value="cze">Чешская Республика</option>
									<option value="chl">Чили</option>
									<option value="che">Швейцария</option>
									<option value="swe">Швеция</option>
									<option value="lka">Шри-Ланка</option>
									<option value="ecu">Эквадор</option>
									<option value="gnq">Экваториальная Гвинея</option>
									<option value="eri">Эритрея</option>
									<option value="est">Эстония</option>
									<option value="eth">Эфиопия</option>
									<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>
									<option value="zaf">Южно-Африканская Республика</option>
									<option value="ssd">Южный Судан</option>
									<option value="jam">Ямайка</option>
									<option value="jpn">Япония</option>
								</select>
							</li>
							<li>
								<label for="addNewSeller_stockAddrRegion1">Регион /край /область /другое:</label>
								<input type="text" id="addNewSeller_stockAddrRegion1">
							</li>
							<li>
								<label for="addNewSeller_stockAddrCity1">Город:</label>
								<input type="text" id="addNewSeller_stockAddrCity1">
							</li>
							<li>
								<label for="addNewSeller_stockAddrStreet1">Улица/ проспект/ проулок /другое:</label>
								<input type="text" id="addNewSeller_stockAddrStreet1">
							</li>
							<li>
								<label for="addNewSeller_stockAddrHome1">Номер дома:</label>
								<input type="text" id="addNewSeller_stockAddrHome1">
							</li>
							<li>
								<label for="addNewSeller_stockAddrOffice1">Номер квартиры/ офисы/ склады /другого:</label>
								<input type="text" id="addNewSeller_stockAddrOffice1">
							</li>
							<li class="phones">
								<label for="addNewSeller_stockAddrPhoneCode1">Контактный телефон:</label>
								<div>
									<div class="input">
										<div class="code">
											<input type="text" id="addNewSeller_stockAddrPhoneCode1" value="+">
											<label for="addNewSeller_stockAddrPhoneCode1">Код страны</label>
										</div>
										<div class="number">
											<input type="text" id="addNewSeller_stockAddrPhone1">
											<label for="addNewSeller_stockAddrPhone1">Номер телефона</label>
										</div>
									</div>
								</div>					
							</li>
						</ul>
					</div>
				</div>
				<div class="juridic_entity">
					<label for="addNewSeller_entityTypesSelect">Форма собственности:</label>
					
					<div class="input">
						<div class="selecting">
						  <input type="radio" id="addNewSeller_entityTypesList" value="list" name="entityType">
						  <label for="addNewSeller_entityTypesList">Из списка</label>
						</div>
						<div class="inputing">					  
						  <input type="radio" id="addNewSeller_entityTypesInput" value="input" name="entityType">
						  <label for="addNewSeller_entityTypesInput">Свой вариант</label>
						  <input type="text" id="addNewSeller_seller_entityType" placeholder="Введите свой вариант">
						</div>
					</div>
				</div>
				<div class="juridic_name">
					<label for="addNewSeller_jurName">Юридическое название:</label>
					<div class="input">
						<input type="text" id="addNewSeller_jurName">
					</div>
				</div>
				<div class="title_for_input">
					Пишется без кавычек. Для ИП - ФИО.
				</div>
				<div>
					<label for="add_new_user_bank">Банк в котором открыт счёт:</label>
					<input type="text" id="add_new_user_bank">
				</div>
				<div>
					<label for="add_new_user_accNum">Номер расчётного счёта:</label>
					<input type="text" id="add_new_user_accNum">
				</div>
				<div>
					<label for="add_new_user_corNum">Номер корреспондентского счёта:</label>
					<input type="text" id="add_new_user_corNum">
				</div>
				<div>
					<label for="add_new_user_BIK">БИК:</label>
					<input type="text" id="add_new_user_BIK">
				</div>
				<div>
					<label for="addNewSeller_INN">ИНН:</label>
					<input type="text" id="addNewSeller_INN">
				</div>
				<div class="juridic_address">
					<label for="addNewSeller_jurAddrRegion">Юридический адрес:</label>
					
					<div class="title_for_inputFly">
						В данный пункт пишем прописку для ИП или адрес регистрации для юр. лица.
					</div>
					<ul class="address-list">
						<li>
							<label for="addNewSeller_jurAddrIndex">Индекс:</label>
							<input type="text" id="addNewSeller_jurAddrIndex">
						</li>
						<li>
							<label for="addNewSeller_jurAddrCountry">Страна:</label>
							<select id="addNewSeller_jurAddrCountry">
								<option value="" disabled="">Выберите страну</option>
								<option value="rus">Российская Федерация</option>
								<option value="" disabled=""></option>
								<option value="aus">Австралия</option>
								<option value="aut">Австрия</option>
								<option value="aze">Азербайджан</option>
								<option value="ala">Аландские Острова</option>
								<option value="alb">Албания</option>
								<option value="dza">Алжир</option>
								<option value="aia">Ангилья</option>
								<option value="ago">Ангола</option>
								<option value="and">Андорра</option>
								<option value="atg">Антигуа и Барбуда</option>
								<option value="ant">Антильские Острова (Нидерландские)</option>
								<option value="mac">Аомынь (Макао)</option>
								<option value="arg">Аргентина</option>
								<option value="arm">Армения</option>
								<option value="abw">Аруба</option>
								<option value="afg">Афганистан</option>
								<option value="bhs">Багамские Острова</option>
								<option value="bgd">Бангладеш</option>
								<option value="brb">Барбадос</option>
								<option value="bhr">Бахрейн</option>
								<option value="blr">Беларусь</option>
								<option value="blz">Белиз</option>
								<option value="bel">Бельгия</option>
								<option value="ben">Бенин</option>
								<option value="bmu">Бермудские Острова</option>
								<option value="bgr">Болгария</option>
								<option value="bol">Боливия</option>
								<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>
								<option value="bih">Босния и Герцеговина</option>
								<option value="bwa">Ботсвана</option>
								<option value="bra">Бразилия</option>
								<option value="iot">Британская территория в Индийском океане</option>
								<option value="brn">Бруней</option>
								<option value="bvt">Буве, остров</option>
								<option value="bfa">Буркина Фасо</option>
								<option value="bdi">Бурунди</option>
								<option value="btn">Бутан</option>
								<option value="vut">Вануату</option>
								<option value="vat">Ватикан</option>
								<option value="gbr">Великобритания</option>
								<option value="hun">Венгрия</option>
								<option value="ven">Венесуэла</option>
								<option value="vgb">Виргинские Острова (Британские)</option>
								<option value="vir">Виргинские Острова (США)</option>
								<option value="asm">Восточное Самоа</option>
								<option value="tls">Восточный Тимор</option>
								<option value="vnm">Вьетнам</option>
								<option value="gab">Габон</option>
								<option value="hti">Гаити</option>
								<option value="guy">Гайана</option>
								<option value="gmb">Гамбия</option>
								<option value="gha">Гана</option>
								<option value="glp">Гваделупа</option>
								<option value="gtm">Гватемала</option>
								<option value="guf">Гвиана Французская</option>
								<option value="gin">Гвинея</option>
								<option value="gnb">Гвинея-Бисау</option>
								<option value="deu">Германия</option>
								<option value="ggy">Гернси</option>
								<option value="gib">Гибралтар</option>
								<option value="hnd">Гондурас</option>
								<option value="hkg">Гонконг</option>
								<option value="grd">Гренада</option>
								<option value="grl">Гренландия</option>
								<option value="grc">Греция</option>
								<option value="geo">Грузия</option>
								<option value="gum">Гуам</option>
								<option value="dnk">Дания</option>
								<option value="jey">Джерси</option>
								<option value="dji">Джибути</option>
								<option value="dma">Доминика</option>
								<option value="dom">Доминиканская Республика</option>
								<option value="egy">Египет</option>
								<option value="zmb">Замбия</option>
								<option value="esh">Западная Сахара</option>
								<option value="wsm">Западное Самоа</option>
								<option value="zwe">Зимбабве</option>
								<option value="isr">Израиль</option>
								<option value="ind">Индия</option>
								<option value="idn">Индонезия</option>
								<option value="jor">Иордания</option>
								<option value="irq">Ирак</option>
								<option value="irn">Иран</option>
								<option value="irl">Ирландия</option>
								<option value="isl">Исландия</option>
								<option value="esp">Испания</option>
								<option value="ita">Италия</option>
								<option value="yem">Йемен</option>
								<option value="cpv">Кабо-Верде</option>
								<option value="kaz">Казахстан</option>
								<option value="cym">Каймановы острова</option>
								<option value="khm">Камбоджа</option>
								<option value="cmr">Камерун</option>
								<option value="can">Канада</option>
								<option value="qat">Катар</option>
								<option value="ken">Кения</option>
								<option value="cyp">Кипр</option>
								<option value="kgz">Киргизия (Кыргызстан)</option>
								<option value="kir">Кирибати</option>
								<option value="chn">Китай</option>
								<option value="cck">Кокосовые (Килинг) острова</option>
								<option value="col">Колумбия</option>
								<option value="com">Коморские Острова</option>
								<option value="cog">Конго</option>
								<option value="cod">Конго, Демократическая Республика</option>
								<option value="prk">Корейская Народно-Демократическая Республика</option>
								<option value="kor">Корея, Республика</option>
								<option value="cri">Коста-Рика</option>
								<option value="civ">Кот-д'Ивуар</option>
								<option value="cub">Куба</option>
								<option value="kwt">Кувейт</option>
								<option value="cok">Кука, Острова</option>
								<option value="cuw">Кюрасао</option>
								<option value="lao">Лаос</option>
								<option value="lva">Латвия</option>
								<option value="lso">Лесото</option>
								<option value="lbr">Либерия</option>
								<option value="lbn">Ливан</option>
								<option value="lby">Ливия</option>
								<option value="ltu">Литва</option>
								<option value="lie">Лихтенштейн</option>
								<option value="lux">Люксембург</option>
								<option value="mus">Маврикий</option>
								<option value="mrt">Мавритания</option>
								<option value="mdg">Мадагаскар</option>
								<option value="mkd">Македония</option>
								<option value="mwi">Малави</option>
								<option value="mys">Малайзия</option>
								<option value="mli">Мали</option>
								<option value="mdv">Мальдивы</option>
								<option value="mlt">Мальта</option>
								<option value="myt">Маоре (Майотта)</option>
								<option value="mar">Марокко</option>
								<option value="mtq">Мартиника</option>
								<option value="mhl">Маршалловы Острова</option>
								<option value="mex">Мексика</option>
								<option value="umi">Мелкие отдаленные острова США</option>
								<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>
								<option value="moz">Мозамбик</option>
								<option value="mda">Молдова</option>
								<option value="mco">Монако</option>
								<option value="mng">Монголия</option>
								<option value="msr">Монтсеррат</option>
								<option value="mmr">Мьянма (Бирма)</option>
								<option value="imn">Мэн, Остров</option>
								<option value="nam">Намибия</option>
								<option value="nru">Науру</option>
								<option value="npl">Непал</option>
								<option value="ner">Нигер</option>
								<option value="nga">Нигерия</option>
								<option value="nld">Нидерланды</option>
								<option value="nic">Никарагуа</option>
								<option value="niu">Ниуэ</option>
								<option value="nzl">Новая Зеландия</option>
								<option value="ncl">Новая Каледония</option>
								<option value="nor">Норвегия</option>
								<option value="nfk">Норфолк</option>
								<option value="are">Объединенные Арабские Эмираты</option>
								<option value="omn">Оман</option>
								<option value="pak">Пакистан</option>
								<option value="plw">Палау</option>
								<option value="pse">Палестина</option>
								<option value="pan">Панама</option>
								<option value="png">Папуа — Новая Гвинея</option>
								<option value="pry">Парагвай</option>
								<option value="per">Перу</option>
								<option value="pcn">Питкэрн</option>
								<option value="pol">Польша</option>
								<option value="prt">Португалия</option>
								<option value="pri">Пуэрто-Рико</option>
								<option value="abh">Республика Абхазия</option>
								<option value="ost">Республика Южная Осетия</option>
								<option value="reu">Реюньон</option>
								<option value="cxr">Рождества (Кристмас), Остров</option>
								<option value="rus">Российская Федерация</option>
								<option value="rwa">Руанда</option>
								<option value="rou">Румыния</option>
								<option value="slv">Сальвадор</option>
								<option value="smr">Сан-Марино</option>
								<option value="stp">Сан-Томе и Принсипи</option>
								<option value="sau">Саудовская Аравия</option>
								<option value="swz">Свазиленд</option>
								<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>
								<option value="shn">Святой Елены, Остров</option>
								<option value="mnp">Северные Марианские Острова</option>
								<option value="syc">Сейшельские Острова</option>
								<option value="maf">Сен-Мартен</option>
								<option value="spm">Сен-Пьер и Микелон</option>
								<option value="sen">Сенегал</option>
								<option value="blm">Сент-Бартельми</option>
								<option value="vct">Сент-Винсент и Гренадины</option>
								<option value="kna">Сент-Китс и Невис</option>
								<option value="lca">Сент-Люсия</option>
								<option value="srb">Сербия</option>
								<option value="sgp">Сингапур</option>
								<option value="sxm">Синт-Мартен</option>
								<option value="syr">Сирия</option>
								<option value="svk">Словакия</option>
								<option value="svn">Словения</option>
								<option value="usa">Соединенные Штаты Америки (США)</option>
								<option value="slb">Соломоновы Острова</option>
								<option value="som">Сомали</option>
								<option value="sdn">Судан</option>
								<option value="sur">Суринам</option>
								<option value="sle">Сьерра-Леоне</option>
								<option value="tjk">Таджикистан</option>
								<option value="tha">Таиланд</option>
								<option value="twn">Тайвань (провинция Китая)</option>
								<option value="tza">Танзания</option>
								<option value="tca">Теркс и Кайкос</option>
								<option value="tgo">Того</option>
								<option value="tkl">Токелау</option>
								<option value="ton">Тонга</option>
								<option value="tto">Тринидад и Тобаго</option>
								<option value="tuv">Тувалу</option>
								<option value="tun">Тунис</option>
								<option value="tkm">Туркменистан</option>
								<option value="tur">Турция</option>
								<option value="uga">Уганда</option>
								<option value="uzb">Узбекистан</option>
								<option value="ukr">Украина</option>
								<option value="wlf">Уоллис и Футуна</option>
								<option value="ury">Уругвай</option>
								<option value="fro">Фарерские острова</option>
								<option value="fji">Фиджи</option>
								<option value="phl">Филиппины</option>
								<option value="fin">Финляндия</option>
								<option value="flk">Фолклендские (Мальвинские) Острова</option>
								<option value="fra">Франция</option>
								<option value="pyf">Французская Полинезия</option>
								<option value="atf">Французские Южные территории</option>
								<option value="hmd">Херд и Макдональд, острова</option>
								<option value="hrv">Хорватия</option>
								<option value="caf">Центральноафриканская Республика</option>
								<option value="tcd">Чад</option>
								<option value="mne">Черногория</option>
								<option value="cze">Чешская Республика</option>
								<option value="chl">Чили</option>
								<option value="che">Швейцария</option>
								<option value="swe">Швеция</option>
								<option value="lka">Шри-Ланка</option>
								<option value="ecu">Эквадор</option>
								<option value="gnq">Экваториальная Гвинея</option>
								<option value="eri">Эритрея</option>
								<option value="est">Эстония</option>
								<option value="eth">Эфиопия</option>
								<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>
								<option value="zaf">Южно-Африканская Республика</option>
								<option value="ssd">Южный Судан</option>
								<option value="jam">Ямайка</option>
								<option value="jpn">Япония</option>
							</select>
						</li>
						<li>
							<label for="addNewSeller_jurAddrRegion">Регион /край /область /другое:</label>
							<input type="text" id="addNewSeller_jurAddrRegion">
						</li>
						<li>
							<label for="addNewSeller_jurAddrCity">Город:</label>
							<input type="text" id="addNewSeller_jurAddrCity">
						</li>
						<li>
							<label for="addNewSeller_jurAddrStreet">Улица/ проспект/ проулок /другое:</label>
							<input type="text" id="addNewSeller_jurAddrStreet">
						</li>
						<li>
							<label for="addNewSeller_jurAddrHome">Номер дома:</label>
							<input type="text" id="addNewSeller_jurAddrHome">
						</li>
						<li>
							<label for="addNewSeller_jurAddrOffice">Номер квартиры/ офисы/ склады /другого:</label>
							<input type="text" id="addNewSeller_jurAddrOffice">
						</li>
					</ul>
				</div>
				<div class="fact_address">
					<label for="addNewSeller_factAddrIndex">Фактический адрес:</label>
					<ul class="address-list">
						<li>
							<label for="addNewSeller_factAddrIndex">Индекс:</label>
							<input type="text" id="addNewSeller_factAddrIndex">
						</li>
						<li>
							<label for="addNewSeller_factAddrCountry">Страна:</label>
							<select id="addNewSeller_factAddrCountry">
								<option value="" disabled="">Выберите страну</option>
								<option value="rus">Российская Федерация</option>
								<option value="" disabled=""></option>
								<option value="aus">Австралия</option>
								<option value="aut">Австрия</option>
								<option value="aze">Азербайджан</option>
								<option value="ala">Аландские Острова</option>
								<option value="alb">Албания</option>
								<option value="dza">Алжир</option>
								<option value="aia">Ангилья</option>
								<option value="ago">Ангола</option>
								<option value="and">Андорра</option>
								<option value="atg">Антигуа и Барбуда</option>
								<option value="ant">Антильские Острова (Нидерландские)</option>
								<option value="mac">Аомынь (Макао)</option>
								<option value="arg">Аргентина</option>
								<option value="arm">Армения</option>
								<option value="abw">Аруба</option>
								<option value="afg">Афганистан</option>
								<option value="bhs">Багамские Острова</option>
								<option value="bgd">Бангладеш</option>
								<option value="brb">Барбадос</option>
								<option value="bhr">Бахрейн</option>
								<option value="blr">Беларусь</option>
								<option value="blz">Белиз</option>
								<option value="bel">Бельгия</option>
								<option value="ben">Бенин</option>
								<option value="bmu">Бермудские Острова</option>
								<option value="bgr">Болгария</option>
								<option value="bol">Боливия</option>
								<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>
								<option value="bih">Босния и Герцеговина</option>
								<option value="bwa">Ботсвана</option>
								<option value="bra">Бразилия</option>
								<option value="iot">Британская территория в Индийском океане</option>
								<option value="brn">Бруней</option>
								<option value="bvt">Буве, остров</option>
								<option value="bfa">Буркина Фасо</option>
								<option value="bdi">Бурунди</option>
								<option value="btn">Бутан</option>
								<option value="vut">Вануату</option>
								<option value="vat">Ватикан</option>
								<option value="gbr">Великобритания</option>
								<option value="hun">Венгрия</option>
								<option value="ven">Венесуэла</option>
								<option value="vgb">Виргинские Острова (Британские)</option>
								<option value="vir">Виргинские Острова (США)</option>
								<option value="asm">Восточное Самоа</option>
								<option value="tls">Восточный Тимор</option>
								<option value="vnm">Вьетнам</option>
								<option value="gab">Габон</option>
								<option value="hti">Гаити</option>
								<option value="guy">Гайана</option>
								<option value="gmb">Гамбия</option>
								<option value="gha">Гана</option>
								<option value="glp">Гваделупа</option>
								<option value="gtm">Гватемала</option>
								<option value="guf">Гвиана Французская</option>
								<option value="gin">Гвинея</option>
								<option value="gnb">Гвинея-Бисау</option>
								<option value="deu">Германия</option>
								<option value="ggy">Гернси</option>
								<option value="gib">Гибралтар</option>
								<option value="hnd">Гондурас</option>
								<option value="hkg">Гонконг</option>
								<option value="grd">Гренада</option>
								<option value="grl">Гренландия</option>
								<option value="grc">Греция</option>
								<option value="geo">Грузия</option>
								<option value="gum">Гуам</option>
								<option value="dnk">Дания</option>
								<option value="jey">Джерси</option>
								<option value="dji">Джибути</option>
								<option value="dma">Доминика</option>
								<option value="dom">Доминиканская Республика</option>
								<option value="egy">Египет</option>
								<option value="zmb">Замбия</option>
								<option value="esh">Западная Сахара</option>
								<option value="wsm">Западное Самоа</option>
								<option value="zwe">Зимбабве</option>
								<option value="isr">Израиль</option>
								<option value="ind">Индия</option>
								<option value="idn">Индонезия</option>
								<option value="jor">Иордания</option>
								<option value="irq">Ирак</option>
								<option value="irn">Иран</option>
								<option value="irl">Ирландия</option>
								<option value="isl">Исландия</option>
								<option value="esp">Испания</option>
								<option value="ita">Италия</option>
								<option value="yem">Йемен</option>
								<option value="cpv">Кабо-Верде</option>
								<option value="kaz">Казахстан</option>
								<option value="cym">Каймановы острова</option>
								<option value="khm">Камбоджа</option>
								<option value="cmr">Камерун</option>
								<option value="can">Канада</option>
								<option value="qat">Катар</option>
								<option value="ken">Кения</option>
								<option value="cyp">Кипр</option>
								<option value="kgz">Киргизия (Кыргызстан)</option>
								<option value="kir">Кирибати</option>
								<option value="chn">Китай</option>
								<option value="cck">Кокосовые (Килинг) острова</option>
								<option value="col">Колумбия</option>
								<option value="com">Коморские Острова</option>
								<option value="cog">Конго</option>
								<option value="cod">Конго, Демократическая Республика</option>
								<option value="prk">Корейская Народно-Демократическая Республика</option>
								<option value="kor">Корея, Республика</option>
								<option value="cri">Коста-Рика</option>
								<option value="civ">Кот-д'Ивуар</option>
								<option value="cub">Куба</option>
								<option value="kwt">Кувейт</option>
								<option value="cok">Кука, Острова</option>
								<option value="cuw">Кюрасао</option>
								<option value="lao">Лаос</option>
								<option value="lva">Латвия</option>
								<option value="lso">Лесото</option>
								<option value="lbr">Либерия</option>
								<option value="lbn">Ливан</option>
								<option value="lby">Ливия</option>
								<option value="ltu">Литва</option>
								<option value="lie">Лихтенштейн</option>
								<option value="lux">Люксембург</option>
								<option value="mus">Маврикий</option>
								<option value="mrt">Мавритания</option>
								<option value="mdg">Мадагаскар</option>
								<option value="mkd">Македония</option>
								<option value="mwi">Малави</option>
								<option value="mys">Малайзия</option>
								<option value="mli">Мали</option>
								<option value="mdv">Мальдивы</option>
								<option value="mlt">Мальта</option>
								<option value="myt">Маоре (Майотта)</option>
								<option value="mar">Марокко</option>
								<option value="mtq">Мартиника</option>
								<option value="mhl">Маршалловы Острова</option>
								<option value="mex">Мексика</option>
								<option value="umi">Мелкие отдаленные острова США</option>
								<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>
								<option value="moz">Мозамбик</option>
								<option value="mda">Молдова</option>
								<option value="mco">Монако</option>
								<option value="mng">Монголия</option>
								<option value="msr">Монтсеррат</option>
								<option value="mmr">Мьянма (Бирма)</option>
								<option value="imn">Мэн, Остров</option>
								<option value="nam">Намибия</option>
								<option value="nru">Науру</option>
								<option value="npl">Непал</option>
								<option value="ner">Нигер</option>
								<option value="nga">Нигерия</option>
								<option value="nld">Нидерланды</option>
								<option value="nic">Никарагуа</option>
								<option value="niu">Ниуэ</option>
								<option value="nzl">Новая Зеландия</option>
								<option value="ncl">Новая Каледония</option>
								<option value="nor">Норвегия</option>
								<option value="nfk">Норфолк</option>
								<option value="are">Объединенные Арабские Эмираты</option>
								<option value="omn">Оман</option>
								<option value="pak">Пакистан</option>
								<option value="plw">Палау</option>
								<option value="pse">Палестина</option>
								<option value="pan">Панама</option>
								<option value="png">Папуа — Новая Гвинея</option>
								<option value="pry">Парагвай</option>
								<option value="per">Перу</option>
								<option value="pcn">Питкэрн</option>
								<option value="pol">Польша</option>
								<option value="prt">Португалия</option>
								<option value="pri">Пуэрто-Рико</option>
								<option value="abh">Республика Абхазия</option>
								<option value="ost">Республика Южная Осетия</option>
								<option value="reu">Реюньон</option>
								<option value="cxr">Рождества (Кристмас), Остров</option>
								<option value="rus">Российская Федерация</option>
								<option value="rwa">Руанда</option>
								<option value="rou">Румыния</option>
								<option value="slv">Сальвадор</option>
								<option value="smr">Сан-Марино</option>
								<option value="stp">Сан-Томе и Принсипи</option>
								<option value="sau">Саудовская Аравия</option>
								<option value="swz">Свазиленд</option>
								<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>
								<option value="shn">Святой Елены, Остров</option>
								<option value="mnp">Северные Марианские Острова</option>
								<option value="syc">Сейшельские Острова</option>
								<option value="maf">Сен-Мартен</option>
								<option value="spm">Сен-Пьер и Микелон</option>
								<option value="sen">Сенегал</option>
								<option value="blm">Сент-Бартельми</option>
								<option value="vct">Сент-Винсент и Гренадины</option>
								<option value="kna">Сент-Китс и Невис</option>
								<option value="lca">Сент-Люсия</option>
								<option value="srb">Сербия</option>
								<option value="sgp">Сингапур</option>
								<option value="sxm">Синт-Мартен</option>
								<option value="syr">Сирия</option>
								<option value="svk">Словакия</option>
								<option value="svn">Словения</option>
								<option value="usa">Соединенные Штаты Америки (США)</option>
								<option value="slb">Соломоновы Острова</option>
								<option value="som">Сомали</option>
								<option value="sdn">Судан</option>
								<option value="sur">Суринам</option>
								<option value="sle">Сьерра-Леоне</option>
								<option value="tjk">Таджикистан</option>
								<option value="tha">Таиланд</option>
								<option value="twn">Тайвань (провинция Китая)</option>
								<option value="tza">Танзания</option>
								<option value="tca">Теркс и Кайкос</option>
								<option value="tgo">Того</option>
								<option value="tkl">Токелау</option>
								<option value="ton">Тонга</option>
								<option value="tto">Тринидад и Тобаго</option>
								<option value="tuv">Тувалу</option>
								<option value="tun">Тунис</option>
								<option value="tkm">Туркменистан</option>
								<option value="tur">Турция</option>
								<option value="uga">Уганда</option>
								<option value="uzb">Узбекистан</option>
								<option value="ukr">Украина</option>
								<option value="wlf">Уоллис и Футуна</option>
								<option value="ury">Уругвай</option>
								<option value="fro">Фарерские острова</option>
								<option value="fji">Фиджи</option>
								<option value="phl">Филиппины</option>
								<option value="fin">Финляндия</option>
								<option value="flk">Фолклендские (Мальвинские) Острова</option>
								<option value="fra">Франция</option>
								<option value="pyf">Французская Полинезия</option>
								<option value="atf">Французские Южные территории</option>
								<option value="hmd">Херд и Макдональд, острова</option>
								<option value="hrv">Хорватия</option>
								<option value="caf">Центральноафриканская Республика</option>
								<option value="tcd">Чад</option>
								<option value="mne">Черногория</option>
								<option value="cze">Чешская Республика</option>
								<option value="chl">Чили</option>
								<option value="che">Швейцария</option>
								<option value="swe">Швеция</option>
								<option value="lka">Шри-Ланка</option>
								<option value="ecu">Эквадор</option>
								<option value="gnq">Экваториальная Гвинея</option>
								<option value="eri">Эритрея</option>
								<option value="est">Эстония</option>
								<option value="eth">Эфиопия</option>
								<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>
								<option value="zaf">Южно-Африканская Республика</option>
								<option value="ssd">Южный Судан</option>
								<option value="jam">Ямайка</option>
								<option value="jpn">Япония</option>
							</select>
						</li>
						<li>
							<label for="addNewSeller_factAddrRegion">Регион /край /область /другое:</label>
							<input type="text" id="addNewSeller_factAddrRegion">
						</li>
						<li>
							<label for="addNewSeller_factAddrCity">Город:</label>
							<input type="text" id="addNewSeller_factAddrCity">
						</li>
						<li>
							<label for="addNewSeller_factAddrStreet">Улица/ проспект/ проулок /другое:</label>
							<input type="text" id="addNewSeller_factAddrStreet">
						</li>
						<li>
							<label for="addNewSeller_factAddrHome">Номер дома:</label>
							<input type="text" id="addNewSeller_factAddrHome">
						</li>
						<li>
							<label for="addNewSeller_factAddrOffice">Номер квартиры/ офисы/ склады /другого:</label>
							<input type="text" id="addNewSeller_factAddrOffice">
						</li>
					</ul>
				</div>
			
			</div>
			
		  </div>
		</div>
		
		
		<!--Modal Window-->
		<div class="modalBlock loadNewLogoOfShop toggleModal3 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Изменение фотографии</div>
				<div class="select-all">
					<svg width="19" height="19" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/select-all.svg" ?>
					</svg>					
				</div>
				<div class="delete-bin">
					<svg width="17" height="17"  viewBox="0 0 225.000000 225.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/delete-bin.svg" ?>
					</svg>
				</div>
				<button class="modal__close toggleModal3 level2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>

			<div id="drop-area">
				<div class="areaBackground">
						<input type="file" accept="image/*" name="fileToUpload3" id="fileToUpload3" class="none">
						<div class="camera">
							<svg width="45" height="45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
								<?php include __DIR__ . "/files/img/icons/camera.svg" ?>
							</svg>
						</div>
						<div class="title">
							Отпустите, чтобы начать загрузку
						</div>
				</div>
			</div>
			
			<label class="modalLoadNewPhoto" for="fileToUpload3">
				<div class="title">
					<svg class="iconPlus" width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
					<span>Загрузить новую фотографию</span> 
				</div>
			</label>
			
			<div class="modalBody">
				<div class="fileUploadError"></div>
				<div class="fileLoading"></div>
				
				<div class="windowAllImages">
				
					<div class="rowImages">
					</div>	
				</div>
			</div>
			
		  </div>
		</div>

		<?php } ?>
		
		<div class="modalBlock error toggleModal2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error toggleModal4 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal4 level2" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error toggleModal5 level3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal5 level3" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<p>Ошибка</p>
			</div>
			
		  </div>
		</div>
		<div class="modalBlock error warning toggleModal6" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error warning">
			<div class="modalHeaderError">
				<div class="title">Предупреждение</div>
				<button class="modal__close error toggleModal6" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>Ошибка</div>
				<div class="buttons">
					<div class="ok">Да</div>
					<div class="cancel toggleModal6">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<div id="cover"></div>
		<div id="cover2"></div>
		<div id="cover3"></div>
		
	</div>
	
	
	
	<script>
		let entityTypes = [];
		<?php
			if($entitytypes !== NULL) {
				foreach ($entitytypes as $entityType) {
					echo "entityTypes.push([\"";
					
					foreach ($entityType as $prop => $value) {
						if($prop !== "type") {
							echo $value . "\", \"";
						} else {
							echo $value;
						}
					}
					
					echo "\"]);";
				}
			}
		?>
	</script>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/loadingImagesInPopUp.js"></script>
	<script src="App/templates/files/js/sellersImagesPopUp.js"></script>
	<script src="App/templates/files/js/closeEditingSeller.js"></script>
	<script src="App/templates/files/js/saveEditingSeller.js"></script>
	<script src="App/templates/files/js/editSeller.js"></script>
	<script src="App/templates/files/js/addNewSeller.js"></script>

</body>
</html>