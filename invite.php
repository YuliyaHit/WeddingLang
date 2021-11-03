<?php
error_reporting(0);
$default_firstname = '';
$default_lastname = '';
if (array_key_exists('firstname',$_REQUEST))
$default_firstname =$_REQUEST['firstname'];
if (array_key_exists('lastname',$_REQUEST))
 $default_lastname =$_REQUEST['lastname'];
?>

<!-- /*Это путь доступа до сайта со свадьбой
http://wedding.com:8080/invite.php
 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Приглашение</title>
	<link rel="stylesheet" href="style.css?v=<?=rand(1,324234234)?>">
	
	<link rel="stylesheet" href="fonts.css">
</head>
<body>
	
<div class="wrapper">
<div class = "s1">	 
	<div class = "section1">
		<h2>Кристиан & Алена</h2>
		<picture>
			<source srcset="images/foto1dt.jpg"  class="foto11">
		    <img src="images/foto1dt.jpg" alt="" class="foto11">
		</picture>
	</div>
	
	<h3 class= "invate-title">
	<?php 
		include 'conection.php';
		$result = $mysqli->query("SELECT * FROM guests WHERE lastname = '$default_lastname'");
			while ($row = $result->fetch_assoc()) {
				if ($row['gender'] == 'man') {
					echo "Дорогой, ";
				} else { echo "Дорогая, ";}
			}
		$mysqli -> close();
		echo $default_firstname.'!';?>
	</h3>		

	<p class= "invate-text">Мы рады сообщить, что <span class = "words">17.09.2022</span> состоится самое главное торжество в нашей жизни - день нашей свадьбы!<br><br>

	Приглашаем тебя разделить с нами радость этого незабываемого дня.
	Ждем тебя <span class = "words">17.09.2022</span> в солнечной Турции!</p>
	
	<picture>
		<source srcset="images/foto2mb.jpg"  class="foto2" media="(max-width: 426px)">
	    <img src="images/foto2dt.jpg" alt="" class="foto2">
	</picture>

	<p class = "timer-wait">Мы отсчитываем каждый день до начала нашего праздника, осталось</p>	

	<div class="timer">
		<div class="timer-numbers" id="timer">
			<div class = "timer-item">
				<span class="days">0</span>
				<span class="days-word">дней</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="hours">0</span>
				<span class="days-word">часов</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="minutes">0</span>
				<span class="days-word">минут</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="seconds">0</span>
				<span class="days-word">секунд</span>
			</div>
		</div>
	</div>
    <p class = "text">Для нас очень важно получить ответы на вопросы до 30.11.2021</p>
</div>    
<div class = "wrapper-main__form">

	<div class = "main__form">

		<form action="invite.php#form" method="POST" id ="form">
<?php
	include 'conection.php';

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		    
			$errors = array();

		  /*  if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
		    		$errors[0] = "Введите имя и фамилию";
		  	} */

		  	if (empty($_POST["choice"])) {
		    		$errors[1] = "Ты не ответил на вопрос...";
		  	} 
		  	if (empty($_POST["partner"])) {
		    		$errors[2] = "С кем ты будешь на празднике?";
		  	} 

		  	if (empty($_POST["food"])) {
		    		$errors[3] = "Что ты предпочитаешь в еде?";
		  	}  

		  	if (empty($_POST["drink"])) {
		    		$errors[4] = "Какие ты любишь напитки?";
		  	}   

		  	if (empty($_POST["pfood"])) {
		    		$errors[5] = "Что твой партнер предпочитает в еде?";
		  	}  

		  	if (empty($_POST["pdrink"])) {
		    		$errors[6] = "Какие напитки любит твой партнер?";
		  	}   

		  	if (isset($_POST["choice"])) {
		  		
		  		$firstname = $_POST['firstname'];
	    		$lastname = $_POST['lastname'];
	    		$choice = $_POST['choice'];
	    		$partner = $_POST['partner'];
	    		$food = $_POST['food'];
	    		$drinks = $_POST['drink'];
	    		$commentFood = $_POST['food-comment'];
		  		$children = empty($_POST['children']) ? "Нет" : $_POST['children'];
	    		$childBaby = $_POST['child-baby'];
	    		$childMedium = $_POST['child-medium'];
	    		$childTeenager = $_POST['child-teenager'];
	    		/*если гость придет с кем-то*/
	    		$pfirstname = $_POST['pfirstname'];
	    		$plastname = $_POST['plastname'];
	    		$pfood = $_POST['pfood'];
	    		$pdrinks = $_POST['pdrink'];
	    		$pcommentFood = $_POST['pcommentFood'];

	    		/*Проверяется есть ли строка с партнером гостя*/
	    		$result = $mysqli->query("SELECT * FROM guests WHERE lastname = '$plastname'");
				$count = $result->num_rows; 

			  	if($_POST["choice"] == "Не смогу прийти") {	

					$mysqli->query("UPDATE guests SET answer = '$choice', partner = '0', meat = '$food[0]', fish = '$food[1]',  vegan = '$food[2]', seafood = '$food[3]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', whiskey = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '', children = 'Нет', group_of_children1 = '0', group_of_children2 = '0', group_of_children3 = '0', date = Now() WHERE lastname = '$lastname'");

					if($count > 0) {
						$mysqli->query("DELETE FROM guests WHERE lastname = '$default_lastname$default_firstname'");
					} 
					$errors = array();
					echo "<span class = 'thanks'>"."Очень жаль, что ты не сможешь прийти"."</span>";
					$mysqli -> close();

		  		}	
				else if(empty($errors) && $_POST['partner'] == 2) {

						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', seafood = '$food[2]', vegan = '$food[3]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', whiskey = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

					/*Если партнер есть, то обновляем, если нет - добавляем */
						if($count > 0) {
							$mysqli->query("UPDATE guests SET answer = '$choice', meat = '$pfood[0]', fish = '$pfood[1]', seafood = '$pfood[2]', vegan = '$pfood[3]', beer = '$pdrinks[0]', white_wine = '$pdrinks[1]', red_wine = '$pdrinks[2]', champagne = '$pdrinks[3]', vodka = '$pdrinks[4]', whiskey = '$pdrinks[5]', soft_drinks = '$pdrinks[6]', comment_food = '$pcommentFood', date = Now() WHERE lastname = '$plastname'");
							echo "<span class = 'thanks'>"."Большое спасибо за твой ответ!"."</span>";
						} 
						else {
								$mysqli->query("INSERT INTO guests VALUES(null, '$pfirstname', '$plastname', '$choice', '0', '$pfood[0]', '$pfood[1]', '$pfood[2]', '$pfood[3]', '$pdrinks[0]', '$pdrinks[1]', '$pdrinks[2]', '$pdrinks[3]', '$pdrinks[4]', '$pdrinks[5]', '$pdrinks[6]', '$pcommentFood', 'Нет', '', '', '', Now(),'', '', '')");

								echo "<span class = 'thanks'>"."Большое спасибо за твой ответ!"."</span>";
						}
						$mysqli -> close();
						
				}
				else if(empty($errors[2]) && empty($errors[3]) && empty($errors[4]) && $_POST['partner'] == 1) {
						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', seafood = '$food[2]', vegan = '$food[3]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', whiskey = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

						/*Надо проверить есть ли строка  с партнером гостя по фамилии, если есть - удаляем*/
						if($count > 0) {
							$mysqli->query("DELETE FROM guests WHERE lastname = '$default_lastname$default_firstname'");
						}
						echo "<span class = 'thanks'>"."Большое спасибо за твой ответ!"."</span>";
						$mysqli -> close();
			    }  
			    else {
			  		echo "<span class = 'check'>"."Кажется какой-то вопрос был пропущен"."</span>";
		  		}
		  	}	
		} 	
?>
	<?php
		if(isset($errors["0"])) {
		echo "<span class = 'errors'>".$errors[0]."</span>";
	}?>
			<input type="text"  style="display: none;" value="<?=$default_firstname?>" class="form__name" name="firstname" placeholder="Введите полное имя">
			<input type="text" style="display: none;" value="<?=$default_lastname?>" class="form__name" name="lastname"  placeholder="Введите вашу фамилию">
	<?php
		if(isset($errors["1"])) {
		echo "<span class = 'errors'>".$errors[1]."</span>";
	}?>
		<div class = "main__question">
			<h4>Ты придешь на нашу свадьбу?</h4>
			<label class="form__choice"><input type="radio"  class="form__decision" name="choice" value="Я прийду" >Я прийду</label><br>	
			<label  class="form__choice"><input type="radio" class="form__decision" name="choice" value="Скорее всего буду">Скорее всего буду</label><br>
			<label class="form__choice"><input type="radio" class="form__decision" name="choice" value="Не смогу прийти">Не смогу прийти</label><br>
		</div>

			<div class = "wrapper-form">
				<div class= "guest_preferences">
	<?php
		if(isset($errors["4"])) {
		echo "<span class = 'errors'>".$errors[4]."</span>";
	}?>
					<h4>Из напитков мне нравится...</h4>
					<label class="form__choice"><input type="checkbox" name="drink[0]" value="1">пиво</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[1]" value="1">белое вино</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[2]" value="1">красное вино</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[3]" value="1">шампанское</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[4]" value="1">водка</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[5]" value="1">виски</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[6]" value="1">безалкогольные напитки</label><br>
	<?php
		if(isset($errors["3"])) {
		echo "<span class = 'errors'>".$errors[3]."</span>";
	}?>
					<h4>А из еды я предпочитаю...</h4>
					<label class="form__choice"><input type="checkbox" name="food[0]" value="1">мясо</label><br>
					<label class="form__choice"><input type="checkbox" name="food[1]" value="1">рыбу</label><br>
					<label class="form__choice"><input type="checkbox" name="food[2]" value="1">морепродукты</label><br>
					<label class="form__choice"><input type="checkbox" name="food[3]" value="1">я вегетерианец</label><br>

					<textarea class= "food_comment" placeholder="Если у тебя есть какие-то ограничения в еде или напитках, аллергия или просто пожелания, напиши, пожалуйста, об этом здесь" name ="food-comment"></textarea>
					</div>
	<?php
		if(isset($errors["2"])) {
		echo "<span class = 'errors'>".$errors[2]."</span>";
	}?>
				<h4>Я буду...</h4>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="1"> один</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">с мужем/парнем</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">с женой/девушкой</label><br>

					<div class= "partner_preferences" style="display: none;"> 
							
							<input type="text"  style="display: none;" value="Partner" class="form__name" name="pfirstname" placeholder="Введите полное имя">
							<input type="text" style="display: none;" value="<?=$default_lastname?><?=$default_firstname?>" class="form__name" name="plastname"  placeholder="Введите вашу фамилию">
							
							<?php
								if($_POST['partner'] == 2 && isset($errors["6"])) {
									echo "<span class = 'errors'>".$errors[6]."</span>";
								}
							?>
							<hr>
							<h4>Мой партнер будет пить...</h4>
							<label class="form__choice"><input type="checkbox" name="pdrink[0]" value="1">пиво</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[1]" value="1">белое вино</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[2]" value="1">красное вино</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[3]" value="1">шампанское</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[4]" value="1">водку</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[5]" value="1">виски</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[6]" value="1">безалкогольные напитки</label><br>
							<?php
								if($_POST['partner'] == 2 && isset($errors["5"])) {
									echo "<span class = 'errors'>".$errors[5]."</span>";
								}
							?>
							<h4>Из еды мой партнер предпочитает...</h4>
							<label class="form__choice"><input type="checkbox" name="pfood[0]" value="1">мясо</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[1]" value="1">рыбу</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[2]" value="1">морепродукты</label><br>
							<label class="form__choice" id = pfood3><input type="checkbox" name="pfood[3]" value="1"><span></span></label><br>

							<textarea class= "food_comment" placeholder="Если у твоего партнера есть какие-то ограничения в еде или напитках, аллергия или просто пожелания, напиши, пожалуйста, об этом здесь" name ="pcommentFood"></textarea>
							<hr>
					</div>

				<h4><label><input type="checkbox" class="form__children" name="children" value="Да">Я приду со своими детьми:</label></h4><br>
			
				<div class = "wrapper-form-children">
					<h6 class = "age">от 0 до 5 лет</h6>
					<input type="text" class="form__name" name="child-baby" placeholder="Введите количество ваших детей"><br>
					<h6 class = "age">от 6 до 13 лет</h6>
					<input type="text" class="form__name" name="child-medium" placeholder="Введите количество ваших детей"><br>
					<h6 class = "age">от 14 и старше</h6>
					<input type="text" class="form__name" name="child-teenager" placeholder="Введите количество ваших детей"><br>
				</div>	
			</div>
			
			<input type="submit" class="form__button" name="submit" value="Отправить">
		
		</form>
		<img src="images/foto4dt.jpg" alt="Кристиан и Алена" class="foto3">
	</div>
</div>

<div class = "s2">
	<div class = "wedding-style"> 
		<p class = "wedding-style__text">Будем очень благодарны, если вы поддержите стиль и цвет нашей свадьбы в своих нарядах</p>
		<div class = "colors"> 
			<div class = "color" style = "background-color: #680400;"></div>
			<div class = "color" style = "background-color: #8f5b4d;"></div>
			<div class = "color" style = "background-color: #e7c2a7;"></div> 
			<div class = "color" style = "background-color: #cda490;"></div> 
			<div class = "color" style = "background-color: #eee2d6;"></div>
		</div>
	</div>

	<hr class = "line">
	<p class = "text-information">Позднее здесь же по ссылкам, расположенным ниже, будут размещены полный фотоотчет и свадебное видео, которые вы можете сохранить себе на память</p>
	<div class = "photoreport">
		<!-- <a class= "link" href="#">Смотреть видеоролик</a> -->
		<a class= "link" href="#"><img src="images/play1.png" alt="" class="play"></a>
		<a class= "link" href="#"><img src="images/load2.png" alt="" class="load"></a>
		<!-- <a class= "link" href="#">Скачать фотоотчет</a> -->
	</div>

</div>
</div>
<script src="scriptru.js"></script>
	
</body>
</html>