<?php 
$host = "localhost";
$dbname = "blog";
$kadi = "root";
$sifre = "";
try {
	$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$kadi","$sifre");
}catch (PDOexception $mesaj){ ## Burada Bize yanlış yaptığımız bir şey olursa uyarı verecektir.
	echo $mesaj->getmessage();
	
}
?>