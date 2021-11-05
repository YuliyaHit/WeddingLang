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
http://wedding3.com:8080/invite.php
 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invitation</title>
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
			if ($row = $result->fetch_assoc()) {
				echo "Dear, ";
			}
		$mysqli -> close();
		echo $default_firstname.'!';?>
	</h3>		

	<p class= "invate-text">We are glad, to inform you, that on <span class = "words">17.09.2022</span> will be spent the most important celebration of our life – our wedding day!<br><br>

	We invite you to come and share with us the joy and happiness of this unbelievable day.
	We are waiting for you on <span class = "words">17.09.2022</span> in sunny Turkey!</p>
	
	<picture>
		<source srcset="images/foto2mb.jpg"  class="foto2" media="(max-width: 426px)">
	    <img src="images/foto2dt.jpg" alt="" class="foto2">
	</picture>

	<p class = "timer-wait">We count down every day until the beginning of our wedding, it remains...</p>	

	<div class="timer">
		<div class="timer-numbers" id="timer">
			<div class = "timer-item">
				<span class="days">0</span>
				<span class="days-word">days</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="hours">0</span>
				<span class="days-word">hours</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="minutes">0</span>
				<span class="days-word">minutes</span>
			</div>
			<span>:</span>
			<div class = "timer-item">
				<span class="seconds">0</span>
				<span class="days-word">seconds</span>
			</div>
		</div>
	</div>
<<<<<<< Updated upstream
    <p class = "text">It is very important for us to get answers for the following questions...</p>
=======
    <p class = "text">It is very important for us to get answers for the following questions before 15.12.2021</p>
</div>
>>>>>>> Stashed changes
<div class = "wrapper-main__form">
	<div class = "main__form">
		<form action="inviteen.php#form" method="POST" id ="form">
	<?php
	include 'conection.php';

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		    
			$errors = array();

		  /*  if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
		    		$errors[0] = "Введите имя и фамилию";
		  	} */

		  	if (empty($_POST["choice"])) {
		    		$errors[1] = "You didn’t answer the question...";
		  	} 
		  	if (empty($_POST["partner"])) {
		    		$errors[2] = "Who will you be with on our wedding?";
		  	} 

		  	if (empty($_POST["food"])) {
		    		$errors[3] = "What do you prefer to eat?";
		  	}  

		  	if (empty($_POST["drink"])) {
		    		$errors[4] = "What do you prefer to drink?";
		  	}   

		  	if (empty($_POST["pfood"])) {
		    		$errors[5] = "What does your partner prefer to eat?";
		  	}  

		  	if (empty($_POST["pdrink"])) {
		    		$errors[6] = "What does your partner prefer to drink?";
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
					echo "<span class = 'thanks'>"."It is a pity that you can't come"."</span>";
					$mysqli -> close();

		  		}	else if(empty($errors) && $_POST['partner'] == 2) {

						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', any_food = '$food[3]', vegan = '$food[2]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', brandy = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

					/*Если партнер есть, то обновляем, если нет - добавляем */
						if($count > 0) {
							$mysqli->query("UPDATE guests SET answer = '$choice', meat = '$pfood[0]', fish = '$pfood[1]', any_food = '$pfood[3]', vegan = '$pfood[2]', beer = '$pdrinks[0]', white_wine = '$pdrinks[1]', red_wine = '$pdrinks[2]', champagne = '$pdrinks[3]', vodka = '$pdrinks[4]', brandy = '$pdrinks[5]', soft_drinks = '$pdrinks[6]', comment_food = '$pcommentFood', date = Now() WHERE lastname = '$plastname'");
							echo "<span class = 'thanks'>"."Thank you for your answer!"."</span>";
						} 
						else {
								$mysqli->query("INSERT INTO guests VALUES(null, '$pfirstname', '$plastname', '$choice', '0', '$pfood[0]', '$pfood[1]', '$pfood[2]', '$pfood[3]', '$pdrinks[0]', '$pdrinks[1]', '$pdrinks[2]', '$pdrinks[3]', '$pdrinks[4]', '$pdrinks[5]', '$pdrinks[6]', '$pcommentFood', 'Нет', '', '', '', Now(),'', '', '')");

								echo "<span class = 'thanks'>"."Thank you for your answer!"."</span>";
						}
						$mysqli -> close();
						
				}
				else if(empty($errors[2]) && empty($errors[3]) && empty($errors[4]) && $_POST['partner'] == 1) {
						$mysqli->query("UPDATE guests SET answer = '$choice', partner = '$partner', meat = '$food[0]', fish = '$food[1]', any_food = '$food[3]', vegan = '$food[2]', beer = '$drinks[0]', white_wine = '$drinks[1]', red_wine = '$drinks[2]', champagne = '$drinks[3]', vodka = '$drinks[4]', brandy = '$drinks[5]', soft_drinks = '$drinks[6]', comment_food = '$commentFood', children = '$children', group_of_children1 = '$childBaby', group_of_children2 = '$childMedium', group_of_children3 = '$childTeenager', date = Now() WHERE lastname = '$lastname'");

						/*Надо проверить есть ли строка  с партнером гостя по фамилии, если есть - удаляем*/
						if($count > 0) {
							$mysqli->query("DELETE FROM guests WHERE lastname = '$default_lastname$default_firstname'");
						}
						echo "<span class = 'thanks'>"."Thank you for your answer!"."</span>";
						$mysqli -> close();
			    }  
			    else {
			  		echo "<span class = 'check'>"."It seems, that you skipped some questions"."</span>";
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
		<div>
			<h4>Will you come to our Wedding?</h4>
			<label class="form__choice"><input type="radio"  class="form__decision" name="choice" value="Я прийду" >I will come</label><br>	
			<label  class="form__choice"><input type="radio" class="form__decision" name="choice" value="Скорее всего буду">I will probably come</label><br>
			<label class="form__choice"><input type="radio" class="form__decision" name="choice" value="Не смогу прийти">I can’t come</label><br>
		</div>

			<div class = "wrapper-form">
				<div class= "guest_preferences">
	<?php
		if(isset($errors["4"])) {
		echo "<span class = 'errors'>".$errors[4]."</span>";
	}?>
					<h4>I will drink...</h4>
					<label class="form__choice"><input type="checkbox" name="drink[0]" value="1">beer</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[1]" value="1">white wine</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[2]" value="1">red wine</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[3]" value="1">champagne</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[4]" value="1">vodka</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[5]" value="1">cognac</label><br>
					<label class="form__choice"><input type="checkbox" name="drink[6]" value="1">alcohol-free beverages </label><br>
	<?php
		if(isset($errors["3"])) {
		echo "<span class = 'errors'>".$errors[3]."</span>";
		}?>
					<h4>I prefer to eat...</h4>
					<label class="form__choice"><input type="checkbox" name="food[0]" value="1">meat</label><br>
					<label class="form__choice"><input type="checkbox" name="food[1]" value="1">seafood</label><br>
					<label class="form__choice"><input type="checkbox" name="food[2]" value="1">I'm a vegetarian</label><br>
					<label class="form__choice"><input type="checkbox" name="food[3]" value="1">I like everything!</label><br>

					<textarea class= "food_comment" placeholder="If you have allergy, any restrictions in meal or beverages, or just wishes to organization of wedding, please write it here" name ="food-comment"></textarea>
					</div>
	<?php
		if(isset($errors["2"])) {
		echo "<span class = 'errors'>".$errors[2]."</span>";
	}?>
				<h4>I will be...</h4>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="1">alone</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">with my husband/boyfriend</label><br>
				<label class="form__choice"><input type="radio" class="form__choice_partner" name="partner" value="2">with my wife/girlfriend</label><br>

					<div class= "partner_preferences" style="display: none;"> 
							
							<input type="text"  style="display: none;" value="Partner" class="form__name" name="pfirstname" placeholder="Введите полное имя">
							<input type="text" style="display: none;" value="<?=$default_lastname?><?=$default_firstname?>" class="form__name" name="plastname"  placeholder="Введите вашу фамилию">
							
							<?php
								if($_POST['partner'] == 2 && isset($errors["6"])) {
									echo "<span class = 'errors'>".$errors[6]."</span>";
								}
							?>
							<hr>
							<h4>My partner will drink...</h4>
							<label class="form__choice"><input type="checkbox" name="pdrink[0]" value="1">beer</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[1]" value="1">white wine</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[2]" value="1">red wine</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[3]" value="1">champagne</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[4]" value="1">vodka</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[5]" value="1">cognac</label><br>
							<label class="form__choice"><input type="checkbox" name="pdrink[6]" value="1">alcohol-free beverages</label><br>
							<?php
								if($_POST['partner'] == 2 && isset($errors["5"])) {
									echo "<span class = 'errors'>".$errors[5]."</span>";
								}
							?>
							<h4>My partner prefers to eat...</h4>
							<label class="form__choice"><input type="checkbox" name="pfood[0]" value="1">meat</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[1]" value="1">seafood</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[2]" value="1">He/she is a vegetarian</label><br>
							<label class="form__choice"><input type="checkbox" name="pfood[3]" value="1">He/she likes everything!</label><br>

							<textarea class= "food_comment" placeholder="If your partner has allergy, any food or beverage restrictions or just wishes to wedding organization, please write it here." name ="pcommentFood"></textarea>
							<hr>
					</div>

				<h4><label><input type="checkbox" class="form__children" name="children" value="Да">I also bring my children with:</label></h4><br>
			
			
				<div class = "wrapper-form-children">
					<h6 class = "age">between 0 and 5 years </h6>
					<input type="text" class="form__name" name="child-baby" placeholder="Insert the number of children"><br>
					<h6 class = "age">between 6 and 13 years </h6>
					<input type="text" class="form__name" name="child-medium" placeholder="Insert the number of children"><br>
					<h6 class = "age">14 years and elder</h6>
					<input type="text" class="form__name" name="child-teenager" placeholder="Insert the number of children"><br>
				</div>	
			</div>
			
			<input type="submit" class="form__button" name="submit" value="SEND">
		
		</form>

		<img src="images/foto4dt.jpg" alt="Кристиан и Алена" class="foto3">
	</div>
</div>

	<p class = "text-information">Here will be later posted full photo report and a wedding video down below. Through the Link you can save files as a keepsake</p>
	<div class = "photoreport">
		<a class= "link" href="#">Watch wedding video </a>
		<a class= "link" href="#"><img src="images/play1.png" alt="" class="play"></a>
		<a class= "link" href="#"><img src="images/load2.png" alt="" class="load"></a>
		<a class= "link" href="#">Download photo report</a>
	</div>
</div>
<script src="script.js"></script>
	
</body>
</html>