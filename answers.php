<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <script type="text/javascript" src="jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleTable.css">

	<title>Ответы гостей</title>
</head>
<body>

<div class="wrapper">	
	<table id = "mainTab">	
	<thead>
		<tr>

			<th rowspan = "2">Имя</th>
			<th rowspan = "2">Фамилия</th>
			<th rowspan = "2">Ответ</th>
			<th rowspan = "2">Сколько взрослых</th>
			<th colspan = "7">Напитки</th>
			<th colspan = "4">Еда</th>
			<th rowspan = "2" style="width: 80px;">Комментарии</th>
			<th colspan = "3">Группы детей</th>
			<th rowspan = "2">Дата</th>
            <th rowspan = "2" style="width: 80px;">Ссылка</th>
		</tr>
		<tr>

			<td>Пиво</td>
			<td>Белое вино</td>
			<td>Красное вино</td>
			<td>Шампанское</td>
			<td>Водка</td>
			<td>Коньяк</td>
			<td style="width: 80px;">Безалкогольные напитки</td>			
			<td>Мясо</td>
			<td>Рыба</td>
			<td>Я вегетерианец</td>
			<td>Я люблю все</td>
			<th>от 0 до 5 лет</th>
			<th>от 6 до 13 лет</th>
			<th>от 14 и старше</th>
           <!--  <th>&nbsp;</th> -->
		</tr>
	</thead>
		<tbody>
<?php

		include 'conection.php';
				
		$query = "SELECT * FROM `guests` ORDER BY `lastname` ASC";

		$result = $mysqli->query($query);
   		
   			while ($row = $result->fetch_assoc()) {
                $data = array('firstname'=>$row['firstname'],
                    'lastname'=>$row['lastname'],
                   );

   				echo "<tr>";
   				echo '<td>'.$row['firstname'].'</td>';
				echo '<td>'.$row['lastname'].'</td>';
				echo '<td>'.$row['answer'].'</td>';
				echo '<td>'.$row['partner'].'</td>';
				echo '<td>'.$row['beer'].'</td>';
				echo '<td>'.$row['white_wine'].'</td>';
				echo '<td>'.$row['red_wine'].'</td>';
				echo '<td>'.$row['champagne'].'</td>';
				echo '<td>'.$row['vodka'].'</td>';
				echo '<td>'.$row['brandy'].'</td>';
				echo '<td>'.$row['soft_drinks'].'</td>';
				echo '<td>'.$row['meat'].'</td>';
				echo '<td>'.$row['fish'].'</td>';
				
				echo '<td>'.$row['vegan'].'</td>';
				echo '<td>'.$row['any_food'].'</td>';
				echo '<td>'.$row['comment_food'].'</td>';
				echo '<td>'.$row['group_of_children1'].'</td>';
				echo '<td>'.$row['group_of_children2'].'</td>';
				echo '<td>'.$row['group_of_children3'].'</td>';			
				echo '<td>'.$row['date'].'</td>';
                /*echo '<td 	style="word-break: break-all;"><a target="_blank" href="http://wedding3.com:8080/invite.php?'.http_build_query($data).'">http://wedding.com:8080/invite.php?'.http_build_query($data).'</a></td>';*/
                if($row['lang'] == 'de') {
					echo '<td 	style="word-break: break-all;"><a target="_blank" href="http://wedding.com:8080/invitede.php?'.http_build_query($data).'">http://wedding.com:8080/invitede.php?'.http_build_query($data).'</a></td>';	
				}else if($row['lang'] == 'en') {
					echo '<td 	style="word-break: break-all;"><a target="_blank" href="http://wedding.com:8080/inviteen.php?'.http_build_query($data).'">http://wedding.com:8080/inviteen.php?'.http_build_query($data).'</a></td>';	
				} else if($row['lang'] == 'ru'){
	                echo '<td 	style="word-break: break-all;"><a target="_blank" href="http://wedding.com:8080/invite.php?'.http_build_query($data).'">http://wedding.com:8080/invite.php?'.http_build_query($data).'</a></td>';
               	} else {
               		echo '<td>'.'</td>';
               	}
                echo "</tr>";
   			}
		
   		/*$mysqli -> close();*/
?>		
	</tbody>
		<tfoot> 
			<tr>
				<th>
				ИТОГО:	
				</th>
				<td>-</td>
				<td>-</td>
				<td class = "adults"> 
						<?php 
						$sumPartner = mysqli_fetch_assoc($mysqli->query("SELECT sum(partner) FROM `guests`"));
						echo ($sumPartner['sum(partner)']);
						?>
				</td>
				<td class = "beer"> 
					<?php 
						$sumBeer = mysqli_fetch_assoc($mysqli->query("SELECT sum(beer) FROM `guests`"));
						echo ($sumBeer['sum(beer)']);
					?>
				</td>
				<td class = "white-wine"> 
					<?php 
						$sumWhiteWine = mysqli_fetch_assoc($mysqli->query("SELECT sum(white_wine) FROM `guests`"));
						echo ($sumWhiteWine['sum(white_wine)']);
					?>
				</td>
				<td class = "red-wine"> 
					<?php 
						$sumRedWine = mysqli_fetch_assoc($mysqli->query("SELECT sum(red_wine) FROM `guests`"));
						echo ($sumRedWine['sum(red_wine)']);
					?>

				</td>
				<td class = "champagne"> 
					<?php 
						$sumChampagne = mysqli_fetch_assoc($mysqli->query("SELECT sum(champagne) FROM `guests`"));
						echo ($sumChampagne['sum(champagne)']);
					?>
				</td>
				<td class = "vodka"> 
					<?php 
						$sumVodka = mysqli_fetch_assoc($mysqli->query("SELECT sum(vodka) FROM `guests`"));
						echo ($sumVodka['sum(vodka)']);
					?>
				</td>				
				<td class = "brandy"> 
					<?php 
						$sumBrandy = mysqli_fetch_assoc($mysqli->query("SELECT sum(brandy) FROM `guests`"));
						echo ($sumBrandy['sum(brandy)']);
					?>
				</td>
				<td class = "soft_drinks"> 
					<?php 
						$sumSoftDrinks = mysqli_fetch_assoc($mysqli->query("SELECT sum(soft_drinks) FROM `guests`"));
						echo ($sumSoftDrinks['sum(soft_drinks)']);
					?>
				</td>
				<td class = "meat"> 
					<?php 
						$sumMeat = mysqli_fetch_assoc($mysqli->query("SELECT sum(meat) FROM `guests`"));
						echo ($sumMeat['sum(meat)']);
					?>
				</td>				
				<td class = "fish"> 
					<?php 
						$sumFish = mysqli_fetch_assoc($mysqli->query("SELECT sum(fish) FROM `guests`"));
						echo ($sumFish['sum(fish)']);
					?>
				</td>
				<td class = "any_food"> 
					<?php 
						$sumAnyFood = mysqli_fetch_assoc($mysqli->query("SELECT sum(any_food) FROM `guests`"));
						echo ($sumAnyFood['sum(any_food)']);
					?>
				</td>
				<td class = "vegan"> 
					<?php 
						$sumVegan = mysqli_fetch_assoc($mysqli->query("SELECT sum(vegan) FROM `guests`"));
						echo ($sumVegan['sum(vegan)']);
					?>
				</td>
				<td>-</td>				
				<td class = "child-baby"> 
					<?php 
						$sumChildBaby = mysqli_fetch_assoc($mysqli->query("SELECT sum(group_of_children1) FROM `guests`"));
						echo ($sumChildBaby['sum(group_of_children1)']);
					?>
				</td>
				<td class = "child-medium"> 
					<?php 
						$sumChildMedium = mysqli_fetch_assoc($mysqli->query("SELECT sum(group_of_children2) FROM `guests`"));
						echo ($sumChildMedium['sum(group_of_children2)']);
					?>
				</td>				
				<td class = "child-teenager"> 
					<?php 
						$sumTeenager = mysqli_fetch_assoc($mysqli->query("SELECT sum(group_of_children3) FROM `guests`"));
						echo ($sumTeenager['sum(group_of_children3)']);
					?>
				</td>
				<td>-</td>
				<td>-</td>			
			</tr>
		</tfoot>
	</table>

	<div class ="result">
		<h3>Гости</h3>
		<div class = "result__field">Взрослых:</div>
		<div class = "total-value"><?php echo ($sumPartner['sum(partner)']);?></div>    
		<div class = "result__field">Детей старше 14 лет:</div>
		<div class = "total-value"><?php echo ($sumTeenager['sum(group_of_children3)']);?></div>
		<div class = "result__field">Детей 5-13 лет:</div>
		<div class = "total-value"><?php echo ($sumChildMedium['sum(group_of_children2)']);?></div>
		<div class = "result__field">Детей до 5 лет</div>
		<div class = "total-value"><?php echo ($sumChildBaby['sum(group_of_children1)']);?></div>
		
		<h3>Напитки</h3>
		<div class = "result__field">Пиво</div>        
		<div class = "total-value beer-value"> <?php echo ($sumBeer['sum(beer)']);?> </div>
		<div class = "result__field">Белое вино</div>
		<div class = "total-value white-wine-value"> <?php echo ($sumWhiteWine['sum(white_wine)']);?> </div>
		<div class = "result__field">Красное вино</div>
		<div class = "total-value red-wine-value"> <?php echo ($sumRedWine['sum(red_wine)']);?>	</div>
		<div class = "result__field">Шампанское</div>      
		<div class = "total-value champagne-value"> <?php echo ($sumChampagne['sum(champagne)']);?>	</div>
		<div class = "result__field">Водка</div>
		<div class = "total-value vodka-value"> <?php echo ($sumVodka['sum(vodka)']);?>	</div>
		<div class = "result__field">Коньяк</div>
		<div class = "total-value brandy-value"> <?php echo ($sumBrandy['sum(brandy)']);?> </div>
		<div class = "result__field">Безалкогольные напитки</div>
		<div class = "total-value soft_drinks-value"> <?php echo ($sumSoftDrinks['sum(soft_drinks)']);?> </div>
		<h3>Еда</h3>
		<div class = "result__field">Мясо:</div>
		<div class = "total-value meat-value"> <?php echo ($sumMeat['sum(meat)']);?> </div>
		<div class = "result__field">Морепродукты:</div>
		<div class = "total-value fish-value"> <?php echo ($sumFish['sum(fish)']);?> </div>
		<div class = "result__field">Едят все:</div>
		<div class = "total-value any_food-value"> <?php echo ($sumAnyFood['sum(any_food)']);?> </div>
		<div class = "result__field">Вегетерианцы:</div>
		<div class = "total-value vegan-value"> <?php echo ($sumVegan['sum(vegan)']); $mysqli -> close();?> </div>
		
	</div>


</div>	




<!--<script>
let guestsValue = document.getElementsByClassName('guests-value'),
	adultsValue = document.getElementsByClassName('adults-value'),
	group1Value = document.getElementsByClassName('group_of_children1'),
	group2Value = document.getElementsByClassName('group_of_children2'),
	group3Value = document.getElementsByClassName('group_of_children3'),
	
	beerValue = document.getElementsByClassName('beer-value'),
	whiteWineValue = document.getElementsByClassName('white-wine-value'),
	redWineValue = document.getElementsByClassName('red-wine-value'),
	champagneValue = document.getElementsByClassName('champagne-value'),
	vodkaValue = document.getElementsByClassName('vodka-value'),
	brandyValue = document.getElementsByClassName('brandy-value'),
	softDrinksValue = document.getElementsByClassName('soft_drinks-value'),

	meatValue = document.getElementsByClassName('meat-value'),
	fishValue = document.getElementsByClassName('fish-value'),
	anyFoodValue = document.getElementsByClassName('any_food-value'),
	veganValue = document.getElementsByClassName('vegan-value');

let guests = document.getElementsByClassName('guests'),
	adults = document.getElementsByClassName('adults'),
	childTeenager = document.getElementsByClassName('child-teenager'),
	childMedium = document.getElementsByClassName('child-medium'),
	childBaby = document.getElementsByClassName('child-baby'),
	
	beer = document.getElementsByClassName('beer'),
	whiteWine = document.getElementsByClassName('white-wine'),
	redWine = document.getElementsByClassName('red-wine'),
	champagne = document.getElementsByClassName('champagne'),
	vodka= document.getElementsByClassName('vodka'),
	brandy = document.getElementsByClassName('brandy'),
	softDrinks = document.getElementsByClassName('soft_drinks'),

	meat = document.getElementsByClassName('meat'),
	fish = document.getElementsByClassName('fish'),
	anyFood = document.getElementsByClassName('any_food'),
	vegan = document.getElementsByClassName('vegan');
</script>-->



<!--<script>
	let table = document.getElementById("mainTab");
	let lastRow = table.rows[table.rows.length - 1];
	
	for (let i = 1; i < table.rows.length - 1; i++) {
 	let row = table.rows[i];
	 	for (let j = 1; j < row.cells.length; j++) {
	    	let cel = row.cells[j];

	    	lastRow.cells[j].innerText =
	      (Number(lastRow.cells[j].innerText) || 0) + 
	      (Number(cel.innerText) || 0);
		}
	}

</script>-->
</body>
</html>