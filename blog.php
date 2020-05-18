<?php include "dbayar.php" ?>
<?php session_start(); ## session başlatmak için
ob_start();

?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Cyber Security</title>
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/reset.css" />
</head>
<body>
	<div class="genel"> 
	<div class="header"> 
	<h2><span style="color:blue;">Cyber</span> <span style="color:red;">Security BLOG</span></h2> 
	<div class="reklam"> 
	<img src="images/reklam" alt="" />
	</div>
	</div>
	
	<div class="menu"> 
	<ul> 
	<li><a href="blog.php">Anasayfa</a></li>
	<li><a href="http://localhost/blog.php?do=kategori&id=1">Eğitim</a></li>
	<li><a href="http://localhost/blog.php?do=kategori&id=2">TOOL	</a></li>
	<li><a href="">Hakkımızda</a></li>
	<li><a href="">İletişim</a></li>
	
	</ul>
	<form action="?do=ara" method="post">
	<span><input type="text" name="ara" /><button type="submit">Ara</button></span> 
	</form>
	</div>
	<div style="clear:both;"></div>
	<div class="content"> 
	<div class="sol"> 
<?php 
$do = @$_GET ["do"];
	switch	($do){
		case "iletisim":
		break;
		
		
		case "kategori":
		include ("kategori_liste.php"); # kategori listesini görmek için buraya bağlanıyoruz.
		break;
		
		
		case "ara":
		include ("ara.php"); # Sayfa içerisinde arama yapmak için 
		break;
		
		
		case "uye":
		include ("uye_giris.php"); # Buradan Üye girişlerini görmek için bağlanıyoruz.
		break;
		
		
		case "cikis":
		session_destroy();   # Burada yarattığımız sessionu sonlandırdık.
		header("refresh: 3; url=blog.php");
		echo '<div class="basarili2">Başarılı bir şekilde çıkış yaptınız.</div>';
		break;
		
		
		case "devam":
		include ("devam.php");	# Buradan Atılan Gönderilerin devamını görmek için bağlanıyoruz
		break;
		
		default:
		include ("anasayfa.php"); 	#Buradan Bloğun anasayfasına bağlanıyoruz
		break;
	}

	?>
	
	
	
	
	</div>
	

	
	<?php include("uye.php") ;    ## Üyeleri çağırmak için
	?>
	
	
	<?php include("kategori.php");  ### Kategorileri çağırmak için ?>
	<?php include("populer.php"); ### Popüler konuları görüntülemek için ?>
	</div>
	
	
	</div>
	<div style="clear:both;"></div>
	

	<div class="footer"> 
	<h2>Copyright 2019 LulzSecurity Theme By Ferhat Durgun & Gülce Kızıl </h2>
	</div>
	
	</div>
	
</body>
</html>