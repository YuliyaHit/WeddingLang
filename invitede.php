<?php
error_reporting(0);
$default_firstname = '';
$default_lastname = '';
if (array_key_exists('firstname',$_REQUEST))
$default_firstname =$_REQUEST['firstname'];
if (array_key_exists('lastname',$_REQUEST))
 $default_lastname =$_REQUEST['lastname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Einladung</title>
	<link rel="stylesheet" href="style.css?v=<?=rand(1,324234234)?>">
	<link rel="stylesheet" href="fonts.css">
	<style> 
		.form__choice, .form__decision {
			padding-left: 0;
		}
	</style>
</head>
<body>
	
<div class="wrapper">	 
	<div class = "section1">
		<h2>Christian & Alena</h2>
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
					echo "Sehr geehrter, ";
				} else { echo "Sehr geehrte, ";}
			}
		$mysqli -> close();
		echo $default_firstname.'!';?>
	</h3>		

	<p class= "invate-text">Wir freuen uns darüber mitzuteilen, dass unser wichtigstes Fest unseres Lebens – unsere Hochzeit, am <span class = "words">17.09.2022</span> stattfindet!<br><br>

	Wir laden dich ein, um die Freude dieses unvergessenen Tages mit uns zu teilen.
	Wir warten auf dich am 
	<span class = "words">17.09.2022</span> in der sonnigen Türkei!</p>
	
	<picture>
		<source srcset="images/foto2mb.jpg"  class="foto2" media="(max-width: 426px)">
	    <img src="images/foto2dt.jpg" alt="" class="foto2">
	</picture>

	<p class = "timer-wait">Wir zählen jeden Tag bis zum Anfang unseres Festes, es fehlt noch</p>	

	<div class="timer">
		<div class="timer-numbers" id="timer">
			<div class = "timer-item">
				<span class="days">0</span>
				<span class="days-word">Tage</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="hours">0</span>
				<span class="days-word">Stunden</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="minutes">0</span>
				<span class="days-word">Minuten</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="seconds">0</span>
				<span class="days-word">Sekunden</span>
			</div>
		</div>
	</div>
<<<<<<< Updated upstream
    <p class = "text">Uns ist es sehr wichtig, Antworten auf die folgenden Fragen zu bekommen...</p>
=======
    <p class = "text"> Uns ist es sehr wichtig, Antworten bis zum 15.12.2021 auf die folgenden Fragen zu bekommen...</p>
</div>
>>>>>>> Stashed changes
<div class = "wrapper-main__form">
	<div class = "main__form">
		<form action="invitede.php#form" method="POST" id ="form">
	<?php
	include 'conection.php';

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		    
			$errors = array();

		  /*  if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
		    		$errors[0] = "Введите имя и фамилию";
		  	} */

		  	if (empty($_POST["choice"])) {
		    		$errors[1] = "Du hast die Frage nicht beantwortet...";
		  	} 
		  	if (empty($_POST["partner"])) {
		    		$errors[2] = "Mit wem wirst du zu unserer Hochzeit kommen?";
		  	} 

		  	if (empty($_POST["food"])) {
		    		$errors[3] = "Was bevorzugst du als Essen?";
		  	}  

		  	if (empty($_POST["drink"])) {
		    		$errors[4] = "Was bevorzugst du trinken?";
		  	}   

		  	if (empty($_POST["pfood"])) {
		    		$errors[5] = "Was dein Partner/deine Partnerin als Essen bevorzugt";
		  	}  

		  	if (empty($_POST["pdrink"])) {
		    		$errors[6] = "Was dein Partner/deine Partnerin zum Trinken bevorzugt";
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

					$mysqli->query("UPDATE guests SET answer = '$choice', partner = '0', meat = '$food[0]', fish = '$food[1]',  vegan = '$food[2]', any_food = '$food[3]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', brandy = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '', children = 'Нет', group_of_children1 = '0', group_of_children2 = '0', group_of_children3 = '0', date = Now() WHERE lastname = '$lastname'");

					if($count > 0) {
						$mysqli->query("DELETE FROM guests WHERE lastname = '$default_lastname$default_firstname'");
					} 
					$errors = array();
					echo "<span class = 'thanks'>"."Schade, dass du nicht kommen kannst"."</span>";
					$mysqli -> close();

		  		}	else if(empty($errors) && $_POST['partner'] == 2) {

						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', any_food = '$food[3]', vegan = '$food[2]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', brandy = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

					/*Если партнер есть, то обновляем, если нет - добавляем */
						if($count > 0) {
							$mysqli->query("UPDATE guests SET answer = '$choice', meat = '$pfood[0]', fish = '$pfood[1]', any_food = '$pfood[3]', vegan = '$pfood[2]', beer = '$pdrinks[0]', white_wine = '$pdrinks[1]', red_wine = '$pdrinks[2]', champagne = '$pdrinks[3]', vodka = '$pdrinks[4]', brandy = '$pdrinks[5]', soft_drinks = '$pdrinks[6]', comment_food = '$pcommentFood', date = Now() WHERE lastname = '$plastname'");
							echo "<span class = 'thanks'>"."Vielen Dank für deine Antwort!"."</span>";
						} 
						else {
								$mysqli->query("INSERT INTO guests VALUES(null, '$pfirstname', '$plastname', '$choice', '0', '$pfood[0]', '$pfood[1]', '$pfood[2]', '$pfood[3]', '$pdrinks[0]', '$pdrinks[1]', '$pdrinks[2]', '$pdrinks[3]', '$pdrinks[4]', '$pdrinks[5]', '$pdrinks[6]', '$pcommentFood', 'Нет', '', '', '', Now(),'', '', '')");

								echo "<span class = 'thanks'>"."Vielen Dank für deine Antwort!"."</span>";
						}
						$mysqli -> close();
						
				}
				else if(empty($errors[2]) && empty($errors[3]) && empty($errors[4]) && $_POST['partner'] == 1) {
						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', any_food = '$food[3]', vegan = '$food[2]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', brandy = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

						/*Надо проверить есть ли строка  с партнером гостя по фамилии, если есть - удаляем*/
						if($count > 0) {
							$mysqli->query("DELETE FROM guests WHERE lastname = '$default_lastname$default_firstname'");
						}
						echo "<span class = 'thanks'>"."Vielen Dank für deine Antwort!"."</span>";
						$mysqli -> close();
			    }  
			    else {
			  		echo "<span class = 'check'>"."Es scheint, dass du irgendwelche Frage verpasst hast"."</span>";
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
	<h4>Wirst du zu unserer Hochzeit kommen?</h4>
		<div>
			<label class="form__choice"><input type="radio"  class="form__decision" name="choice" value="Я прийду" >Ich bin dabei</label><br>	
			<label  class="form__choice"><input type="radio" class="form__decision" name="choice" value="Скорее всего буду">Ich werde sehr wahrscheinlich dabei sein</label><br>
			<label class="form__choice"><input type="radio" class="form__decision" name="choice" value="Не смогу прийти">Ich kann leider nicht kommen</label><br>
		</div>

			<div class = "wrapper-form">
				<div class= "guest_preferences">
	<?php
		if(isset($errors["4"])) {
		echo "<span class = 'errors'>".$errors[4]."</span>";
	}?>
					<h4>Als Getränke bevorzuge ich...</h4>
					<label class="form__choice"><input type="checkbox" name="drink[0]" value="1">Bier</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[1]" value="1">weißen Wein</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[2]" value="1">roten Wein</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[3]" value="1">Sekt</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[4]" value="1">Wodka</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[5]" value="1">Kognak</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[6]" value="1">alkoholfreie Getränke</label><br>
	<?php
		if(isset($errors["3"])) {
		echo "<span class = 'errors'>".$errors[3]."</span>";
		}?>
					<h4>Als Essen gefällt mir...</h4>
					<label class="form__choice"><input type="checkbox" name="food[0]" value="1">Fleisch</label><br>
					<label class="form__choice"><input type="checkbox" name="food[1]" value="1">Meeresfrüchte</label><br>
					<label class="form__choice"><input type="checkbox" name="food[2]" value="1">Ich bin Vegetarianer</label><br>
					<label class="form__choice"><input type="checkbox" name="food[3]" value="1">Mir gefällt alles!</label><br>

					<textarea class= "food_comment" placeholder="Wenn du Allergie, irgendwelche Beschränkungen im Essen oder in Getränken oder einfach Wünsche zur Organisation hast, dann teile bitte uns diese hier mit." name ="food-comment"></textarea>
					</div>
	<?php
		if(isset($errors["2"])) {
		echo "<span class = 'errors'>".$errors[2]."</span>";
	}?>
				<h4>Ich komme...</h4>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="1">allein</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">mit meinem Ehemann/Freund</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">mit meiner Ehefrau/Freundin</label><br>

					<div class= "partner_preferences" style="display: none;"> 
							
							<input type="text"  style="display: none;" value="Partner" class="form__name" name="pfirstname" placeholder="Введите полное имя">
							<input type="text" style="display: none;" value="<?=$default_lastname?><?=$default_firstname?>" class="form__name" name="plastname"  placeholder="Введите вашу фамилию">
							
							<?php
								if($_POST['partner'] == 2 && isset($errors["6"])) {
									echo "<span class = 'errors'>".$errors[6]."</span>";
								}
							?>
							<hr>
							<h4>Mein Partner/meine Partnerin trinkt...</h4>
							<label class="form__choice"><input type="checkbox" name="pdrink[0]" value="1">bier</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[1]" value="1">weißen Wein</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[2]" value="1">roten Wein</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[3]" value="1">Sekt</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[4]" value="1">Wodka</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[5]" value="1">Kognak</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[6]" value="1">alkoholfreie Getränke</label><br>
							<?php
								if($_POST['partner'] == 2 && isset($errors["5"])) {
									echo "<span class = 'errors'>".$errors[5]."</span>";
								}
							?>
							<h4>Als Essen bevorzugt mein Partner/meine Partnerin...</h4>
							<label class="form__choice"><input type="checkbox" name="pfood[0]" value="1">Fleisch</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[1]" value="1">Meeresfrüchte</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[2]" value="1">Er/sie ist Vegetarianer/in </label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[3]" value="1">Meinem/er Partner/in gefällt alles!</label><br>

							<textarea class= "food_comment" placeholder="Wenn dein Partner/deine Partnerin Allergie, irgendwelche Beschränkungen im Essen oder Getränke, oder einfach wünsche zur Organisation der Hochzeit hat, dann teile uns diese bitte hier mit" name ="pcommentFood"></textarea>
							<hr>
					</div>

				<h4><label><input type="checkbox" class="form__children" name="children" value="Да">Mit mir kommen auch die Kinder:</label></h4><br>
			
			
				<div class = "wrapper-form-children">
					<h6 class = "age">von 0 bis 5 Jahre</h6>
					<input type="text" class="form__name" name="child-baby" placeholder="Gib bitte Anzahl von Kindern ein"><br>
					<h6 class = "age">von 6 bis 13 Jahre</h6>
					<input type="text" class="form__name" name="child-medium" placeholder="Gib bitte Anzahl von Kindern ein"><br>
					<h6 class = "age">von 14 Jahre und älter </h6>
					<input type="text" class="form__name" name="child-teenager" placeholder="Gib bitte Anzahl von Kindern ein"><br>
				</div>	
			</div>
			
			<input type="submit" class="form__button" name="submit" value="SENDEN">
		
		</form>

		<img src="images/foto4dt.jpg" alt="Кристиан и Алена" class="foto3">
	</div>
</div>

	<p class = "text-information">Später nach der Hochzeit wird hier unten der Link zu den Fotos und Hochzeitsfilm veröffentlicht. Die Mediadateien kann man zum Andenken speichern</p>
	<div class = "photoreport">
		<a class= "link" href="#">Video abspielen</a>
		<a class= "link" href="#"><img src="images/play1.png" alt="" class="play"></a>
		<a class= "link" href="#"><img src="images/load2.png" alt="" class="load"></a>
		<a class= "link" href="#">Fotos herunterladen</a>
	</div>
</div>
<script src="script.js"></script>
	
</body>
</html>