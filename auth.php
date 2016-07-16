<?php

if($_COOKIE["passer"]<>"325373c671bd18c9c526be384516c5da"){
	setcookie('passer', "325373c671bd18c9c526be384516c5da", time()+60*60*24*365);
	echo "Cookies set";
		}//header( 'Location: /' );
else{header( 'Location: /forspec' );}

?>