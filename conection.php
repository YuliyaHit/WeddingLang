<?php
$mysqli = new mysqli('localhost', 'root', '', 'guests');

	if (mysqli_connect_errno()) {
		echo '<br>'.'Ошибка соединения: ' . mysqli_connect_error() . '<br>';
        echo 'Код ошибки: ' . mysqli_connect_errno();
			exit();
	}

	$mysqli->set_charset('utf8');

?>