<?php
	if ($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da") {
	    header("HTTP/1.1 403 Forbidden");
	    exit();
	  }

	$finalsource = json_decode($_POST['finalsource']);
	$finalhelp = json_decode($_POST['finalhelp']);
	$finalhelp = (array)$finalhelp;

	$date_day = $finalhelp["date_day"];		echo $date_day."<br>";
    $date_month = $finalhelp["date_month"];	echo $date_month."<br>";
    $date_year = $finalhelp["date_year"];	echo $date_year."<br>";
    $code_source = $finalhelp["code_source"];echo $code_source."<br>";
    $code_uz = $finalhelp["code_UZ"];		echo $code_uz."<br>";
	$name_uz = $finalhelp["name_uz"];		echo $name_uz."<br>";
    $url_source = $finalhelp["url_source"];	echo $url_source."<br>";
    $count_students = $finalhelp["count_students"];echo $count_students."<br>";
    
    if ((strlen($code_source)==0)or(strlen($code_uz)==0)or(strlen($name_uz)==0)or(strlen($url_source)==0)or(strlen($date_day)==0)or(strlen($date_month)==0)or(strlen($date_year)==0)or(strlen($count_students)==0)or($date_day<1)or($date_day>31)or($date_month<1)or($date_month>12)or($date_year<2015)or($date_year>2020)){echo "Не всё! Как ты смог сделать такую ошибку?";exit();}

    

	echo "200";
?>