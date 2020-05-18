<?php
		$id= $_GET["id"];
		$konu 	= $db->prepare("select * from konular inner join kategoriler on 
		kategoriler.kategori_id = konular.konu_kategori where konu_id"); #databaseten konular tablomuza bağlanıyoruz.
		$konu->execute(array($id)); 						#  databaseten gelenleri Dizi haline çeviriyoruz.
	$x= $konu->fetchALL(PDO::FETCH_ASSOC);				# İndis numaralarından kurtuluyoruz ve bu konuları böylece listeleyebiliyoruz.

## BİRDEN ÇOK KONU OLABİLECEĞİNDEN FOREACH DÖNGÜMÜZÜ BAŞLATIYORUZ.

// Konu HİT BÖLÜMÜ

	$hit = $db->prepare("update konular set konu_hit = konu_hit +1 where konu_id=?");
	$hit->execute(array($id));




foreach($x as $m){	
$yorum = $db->prepare("select * from yorumlar where yorum_konu_id=?");
			$yorum->execute(array($m["konu_id"]));
			$yorum->fetchALL(PDO::FETCH_ASSOC);
			$x = $yorum->rowCount();	
	?> 
		<div class="sol2"> 
	<h2><?php  echo $m["konu_baslik"];?> 
</h2>
	<div class="bilgi">
	<span style="color:blue;"> Kategori:</span> <?php  echo $m["kategori_adi"];?>
	<span style="color:blue;"> Yazan:</span>  <?php  echo $m["konu_ekleyen"];?>
	<span style="color:blue;"> Okuyan:</span>  <?php  echo $m["konu_hit"];?>
	<span style="color:blue;"> Yorum:</span><?php echo $x;?>
	<span style="float:right;">
	<span style="color:blue;"> Tarih:</span> <?php  echo $m["konu_tarih"];?></span></div>

	<p> 
	<img src="<?php echo $m["konu_resim"]; # RESİMLERİMİZİ BURADAN UPLOAD EDİYORUZ.
	?>" alt="" />
<?php  echo nl2br($m["konu_aciklama"]); ## ÖNCEKİ ANASAYFA.PHP DOSYAMIZDAN FARKI BURADA SUBSTR OLMAMASI ÇÜNKÜ BİZE KONUNUN TAMAMINI GÖSTERMESİNİ İSTEDİK.
?>

	</p>

	<div style="clear:both;"></div>
	</div>
	<?php 
	
	
}

	$yorum = $db->prepare("select * from yorumlar where yorum_konu_id=?"); # hazırla demek prepare
$yorum->execute(array($id));  # bunu bir dizi haline getirdik
$b = $yorum->fetchALL(PDO::FETCH_ASSOC); ## indislerden kurtulduk asssoc ile fetchALL ile bütün hepsini seçtik
$x = $yorum->rowCount(); ## yorum diye bir yer var mı yok mu  diye kontrol etmesi için  rowCount yazıyoruz.

	if($x){
		foreach($b as $m){
			?>
	<div class="yorumlar">
	<h2>Ekleyen : <?php echo $m["yorum_ekleyen"]; ?> <span style="float:right;">
	Tarih : <?php echo $m["yorum_tarih"]; ?> </span> </h2>
	<p> <?php echo $m["yorum_mesaj"];?></p>
			
			<?php
		}
		
	}
	else {
		echo '<div class="bilgi">İLK YORUM YAPAN SEN OL.</div>';
	}


if($_POST){
	$isim = trim($_POST["isim"]);
	$mesaj = $_POST["mesaj"];
	$mail = trim($_POST["mail"]);
	
	if(!$mesaj || !$mail || !$isim){
		echo '<div class="hata">Gerekli Alanları Doldurunuz Lütfen...</div>';
		
	}
	else {
		$yorum = $db->prepare("insert into yorumlar set 
		yorum_ekleyen=?,
		yorum_eposta=?,
		yorum_mesaj=?,
		yorum_konu_id=? ");
		$ekle = $yorum->execute(array($isim,$mail,$mesaj,$id));
		if($ekle){
			echo '<div class="basarili2">Yorum Başarılı Bir Şekilde Eklendi...</div>';
			
			$url = $_SERVER["HTTP_REFERER"];
			header("refresh: 2; url=$url");
		}
		else {
			echo '<div class="hata">Yorum Eklenirken Bir hata oluştu...</div>';
		}
	}
}
else {
	?>
	<div style="font-size:19px;padding:10px;background:lightgreen;">Mesaj Gönder</div>
<div class="sol2">	
<form action="" method="post">
	<ul> 
	<li>Adınız</li>
	<li><input type="text" name="isim" /></li>
	<li>Email</li>
	<li><input type="text" name="mail" /></li>
	<li><textarea name="mesaj" id="" cols="50" rows="10"></textarea></li>
	<li><button type="submit">Gönder</button></li>
	</ul>
	</form>
	</div>
	<?php
}
	?>
