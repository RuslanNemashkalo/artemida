<?php

if((strlen($_POST['username']) == 0) || (strlen($_POST['username']) == 'username')){
	$error = 'Введите правельнй логин';
}

if(isset($_POST['username']) && isset($_POST['password'])){

	require_once 'connection_db.php'; // подключаем скрипт
	// подключаемся к серверу

	$link = mysqli_connect($host, $user, $password, $database) 
	    or die("Ошибка " . mysqli_error($link));
	 
	 // экранирования символов для mysql
    $username = htmlentities(mysqli_real_escape_string($link, $_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($link, $_POST['password']));
    $email = htmlentities(mysqli_real_escape_string($link, $_POST['email']));

     // создание строки запроса
    $query ="INSERT INTO user VALUES(NULL, '$username','$email','$password')";

	 // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
	 
	// закрываем подключение
	mysqli_close($link);
	header('Location: /artemida/artemida/public/index.html');

} else {
	header('Location: /artemida/public/login.html');
}
?>