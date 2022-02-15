<?php
session_start();

if ($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT']) {
	unset($_SESSION['user']);
	unset($_SESSION['dataOfSign']);
}

if (!$_SESSION['user']) {
	$_SESSION['url'] = 'stockrooms';
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
    <link rel="stylesheet" href="App/templates/files/css/stockrooms.css">
    <link rel="stylesheet" href="App/templates/files/css/popUp.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpError.css">
    <link rel="stylesheet" href="App/templates/files/css/popUpAddNew.css">
	<link rel="stylesheet" href="App/templates/files/css/loadingImages.css">
	<link rel="stylesheet" href="App/templates/files/css/dropDownList.css">
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
		<?php if($_SESSION['user']['isblocked'] !== '1') { ?>
			
			<h2 class="main-title">Склады</h2>
		
			<div class="add_new_stockroom toggleModal0">Добавить<br>новый склад</div>
		
		<div class="table_stockrooms">
			<table class="content-table">
				<thead>
					<tr>
					<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
						<th>ФИО продавца</th>
					<?php } ?>
						<th>Страна</th>	
						<th>Регион</th>					
						<th>Город</th>
						<th>Улица</th>
						<th>Дом</th>
					</tr>
				</thead>
				<tbody>
					<?php
						  
					foreach ($stockrooms as $stockroom) {
						
						echo '<tr>
								  <td class="none" data-id="' . $stockroom->id . '" ';
					
						echo 'data-phone="' . $stockroom->phone . '" ';
						
						echo "data-seller-id=\"";
						echo $stockroom->seller->id;
						echo "\" ";
						
						echo "data-jur-selected-type=\"";
						echo $stockroom->seller->jurSelectedType;
						echo "\" ";
						
						echo "data-jur-type=\"";
						echo $stockroom->seller->jurType;
						echo "\" ";
						
						echo "data-jur-name=\"";
						echo $stockroom->seller->jurName;
						echo "\" ";
						
						echo "data-addr-office=\"";
						echo $stockroom->address->office;
						echo "\" ";
						
						echo "data-addr-post-index=\"";
						echo $stockroom->address->postIndex;
						echo "\" ";
						
						echo "data-list-of-pvz=\"";
						echo $stockroom->listOfPVZ;
						echo "\" ";
						
						echo "data-is-delivery-from-point=\"";
						echo $stockroom->isDeliveryFromPoint;
						echo "\" >";
						
						echo '</td>';
						if($_SESSION['user']["typeofuser"] == 'Admin') {
							echo '<td class="full_name">' . $stockroom->user->full_name . '</td>';
						}
						echo ' <td class="addressCountry">' . $stockroom->address->country . '</td>';
						echo ' <td class="addressRegion">' . $stockroom->address->region . '</td>';
						echo ' <td class="addressCity">' . $stockroom->address->city . '</td>';
						echo ' <td class="addressStreet">' . $stockroom->address->street . '</td>';
						echo ' <td class="addressHome">' . $stockroom->address->home . '</td>';
						echo "<td class=\"editStockroom\">
								<svg width=\"20px\" height=\"20px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">
									<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>
								</svg><br>Редактировать
									</td>";
						echo "<td class=\"deleteStockroom\">
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
		
		<div class="editing_stockroom none">
			<div class="header">
				<span>Редактирование склада</span>
				<div class="save-stockroom">
					<svg width="25" height="25" fill="#fff">
						<svg title="change" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 -256 1792 1792" enable-background="new 0 0 1000 1000" xml:space="preserve">
							<g transform="matrix(1,0,0,-1,129.08475,1270.2373)">
								<path d="m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z"></path>
							</g>
						</svg>
					</svg>
				</div>
				<div class="reply-stockroom">
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
			<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
				<div class="field editFio">
					<label>ФИО продавца:</label>
					<span class="input"></span>
				</div>
				<div class="field editJurName">
					<label>Юридическое название:</label>
					<span class="input"></span>
				</div>
			<?php } ?>
			<div class="field">
				<label>Адрес:</label>
				<ul class="address-list">
					<li>
						<label for="stockroom_AddrCountry">Страна:</label>
						<div class="input">
							<select id="stockroom_AddrCountry">
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
						<label for="stockroom_AddrIndex">Почтовый индекс:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrIndex">
						</div>
					</li>
					Почтовый индекс должен обязательно соответствовать городу, в котором находится склад. Именно по почтовому индексу будет определятся город для создания заказов в системе доставки.
					<li>
						<label for="stockroom_AddrRegion">Регион /край /область /другое:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrRegion">
						</div>
					</li>
					<li>
						<label for="stockroom_AddrCity">Город:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrCity">
						</div>
					</li>
					<li>
						<label for="stockroom_AddrStreet">Улица/ проспект/ проулок /другое:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrStreet">
						</div>
					</li>
					<li>
						<label for="stockroom_AddrHome">Номер дома:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrHome">
						</div>
					</li>
					<li>
						<label for="stockroom_AddrOffice">Номер квартиры/ офисы/ склады /другого:</label>
						<div class="input">
							<input type="text" id="stockroom_AddrOffice">
						</div>
					</li>
				</ul>
			</div>
			<div class="field pvz_list_container">
				<div>
				    <label>Пункты приёма заказов:</label>
    				<div style="
                        width: 200px;
                        padding: 7px;
                        margin: 5px;
                        background-color: #A83242;
                        color: #fff;
                        border-radius: 10px;
                        cursor: pointer;
                    " class="button-update">
    				    Обновить список пунктов приёма заказов
    				</div>
    				<div style="width: 200px;margin-left: 5px;">
    				    При обновлении списка пунктов приёма заказов сбросятся все выбранные раннее пункты
    				</div>
    			</div>
				<div>
					<div class="input">
						<ul class="pvz_list">
	                    </ul>
					</div>
				</div>
			</div>
			<div class="field">				
				<label for="point_type_of_picking">Способ приёма товаров для доставки:</label>
				<div class="input">
                    <div style="display: flex;">
                        <input type="radio" id="point_type_of_picking" name="type_of_picking_goods_for_delivery" value="point">
                        <label for="point_type_of_picking" style="min-width: 181px; padding-left: 5px;">Пункт приёма заказов</label><br>
                    </div>
                    <div style="display: flex;">
                        <input type="radio" id="courier_type_of_picking" name="type_of_picking_goods_for_delivery" value="courier">
                        <label for="courier_type_of_picking" style="padding-left: 5px;">Курьером со склада</label>
                    </div>
				</div>
			</div>
			<div class="field editContact">
				<label for="stockroom_contact">Контактный телефон:</label>
				<div>
					<div class="input">
						<div class="number">
							<input type="text" id="stockroom_contact" class="active">
							<label for="stockroom_contact" class="active">Номер телефона</label>
						</div>
					</div>
				</div>
			</div>
			<div class="field">
				<div>
    				<div style="width: 160px;margin-left: 5px;">
    				    При нажатии на кнопку "Присвоить всем товарам данный склад" присваивание всем товарам данного склада осуществляется сразу же 
    				</div>
    			</div>
				<div>
					<div class="input">
        				<div style="
                            width: 200px;
                            padding: 7px;
                            margin: 5px;
                            background-color: #A83242;
                            color: #fff;
                            border-radius: 10px;
                            cursor: pointer;
                        " class="all-goods-to-one-stock">
        				    Присвоить всем товарам данный склад
        				</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--Modal Window-->
		<div class="modalBlock addNewTable toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Добавление нового склада</div>
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
				<?php if($_SESSION['user']["typeofuser"] == 'Admin') {?>
					<div class="juridic_name">
						<label for="addNewSeller_jurName">Юридическое название зарегестрированного продавца:</label>
						<div class="input">
							<input type="text" id="addNewSeller_jurName">
						</div>
					</div>
					<div class="title_for_input">
						Пишется без кавычек. Для ИП - ФИО.
					</div>
				<?php } ?>
				<div class="addNewSeller_stockAddrIndex1">
					<label for="addNewSeller_stockAddrIndex1">Индекс:</label>
					<input type="text" id="addNewSeller_stockAddrIndex1">
				</div>
				<div class="addNewSeller_stockAddrCountry1">
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
				</div>
				<div>
					<label for="addNewSeller_stockAddrRegion1">Регион /край /область /другое:</label>
					<input type="text" id="addNewSeller_stockAddrRegion1">
				</div>
				<div>
					<label for="addNewSeller_stockAddrCity1">Город:</label>
					<input type="text" id="addNewSeller_stockAddrCity1">
				</div>
				<div>
					<label for="addNewSeller_stockAddrStreet1">Улица/ проспект/ проулок /другое:</label>
					<input type="text" id="addNewSeller_stockAddrStreet1">
				</div>
				<div>
					<label for="addNewSeller_stockAddrHome1">Номер дома:</label>
					<input type="text" id="addNewSeller_stockAddrHome1">
				</div>
				<div>
					<label for="addNewSeller_stockAddrOffice1">Номер квартиры/ офисы/ склады /другого:</label>
					<input type="text" id="addNewSeller_stockAddrOffice1">
				</div>
				<div class="phones">
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
				</div>
			</div>
			
		  </div>
		</div>
		
		<?php if($_SESSION['user']["typeofuser"] == 'Seller') {?>
			<script>
				let sellerJuridicName = "<?php echo $jurName; ?>";
			</script>
		<?php } ?>
		
		<?php } ?>
		
		<div class="modalBlock error toggleModal1" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal1" data-toggle="true">
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
		
		<div class="modalBlock error toggleModal2 level2" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal2 level2" data-toggle="true">
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
		
		<div class="modalBlock error toggleModal3 level3" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error">
			<div class="modalHeaderError">
				<div class="title">Ошибка</div>
				<button class="modal__close error toggleModal3 level3" data-toggle="true">
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
		
		<div class="modalBlock error warning toggleModal4" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block error warning">
			<div class="modalHeaderError">
				<div class="title">Предупреждение</div>
				<button class="modal__close error toggleModal4" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/files/img/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<div>Ошибка</div>
				<div class="buttons">
					<div class="ok">Да</div>
					<div class="cancel toggleModal4">Нет</div>
				</div>
			</div>
			
		  </div>
		</div>
		
		<div id="cover"></div>
		<div id="cover2"></div>
		<div id="cover3"></div>
		
	</div>
	
	<script src="App/templates/files/js/adminpanel.js"></script>
	<script src="App/templates/files/js/tableHead.js"></script>
	<script src="App/templates/files/js/popUp.js"></script>
	<script src="App/templates/files/js/changeLeftMenuHeight.js"></script>
	<script src="App/templates/files/js/closeEditingStockroom.js"></script>
	<script src="App/templates/files/js/saveEditingStockroom.js"></script>
	<script src="App/templates/files/js/editStockroom.js"></script>
	<script src="App/templates/files/js/addNewStockroom.js"></script>

</body>
</html>