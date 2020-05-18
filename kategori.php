<div class="sag3"> 
	<h2>Kategoriler</h2>
	<ul> 
<?php
$kategori = $db->prepare("select * from kategoriler"); # hazırla demek prepare
$kategori->execute(array()); # bunu bir dizi haline getirdik
$v = $kategori->fetchALL(PDO::FETCH_ASSOC); ## indislerden kurtulduk asssoc ile fetchALL ile bütün hepsini seçtik
$x = $kategori->rowCount(); ## kategori diye bir yer var mı yok mu  diye kontrol etmesi için  rowCount yazıyoruz.
	if($x){
		foreach($v as $m){
			echo '<li><a href="?do=kategori&id='.$m["kategori_id"].'">'.$m["kategori_adi"].'</a></li>';
		}
		
	}
	else {
		echo '<div class="hata"Şuan Hiç  Kategori Bulunmuyor. </div>';
		
	}
	?>
