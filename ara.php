<?php
$ara = $_POST["ara"];



		$konu 	= $db->prepare("select * from konular inner join kategoriler on 
		kategoriler.kategori_id = konular.konu_kategori where konu_baslik like ?");
		# Like komutu ile istenilen yazı başlğını sayfada aramak için kullanıyoruz.
		#databaseten konular tablomuza bağlanıyoruz. İnner join ile alt içeriğe bağlanıyoruz.
		$konu->execute(array('%'.$ara.'%')); 
		# '%'.$ara.'%' kısımı başındaki ve sonundakine göre de ara oluyor sadece aynı başlığı yazınca olmasın diye böyle bir şey yazıyoruz	
					# ve databaseten gelenleri Dizi haline çeviriyoruz.
		
		$x= $konu->fetchALL(PDO::FETCH_ASSOC);				# İndis numaralarından kurtuluyoruz ve bu konuları böylece listeleyebiliyoruz.

## BİRDEN ÇOK KONU OLABİLECEĞİNDEN FOREACH DÖNGÜMÜZÜ BAŞLATIYORUZ.
$v = $konu->rowCount();
	if($v){
		foreach($x as $m){		
	?> 
		<div class="sol2"> 
	<h2><?php  echo $m["konu_baslik"];?> 
</h2>
	<div class="bilgi"><span style="color:blue;"> KATEGORİ:</span> <?php  echo $m["kategori_adi"];?>  | 
	<span style="color:blue;"> YAZAN:</span>  <?php  echo $m["konu_ekleyen"];?> |
	<span style="color:blue;"> YORUM:</span>2
	<span style="float:right;"><span style="color:blue;"> TARİH:</span> <?php  echo $m["konu_tarih"];?></span></div>
	<div class="resim"> 
	<img src="<?php echo $m["konu_resim"]; # RESİMLERİMİZİ BURADAN UPLOAD EDİYORUZ.
	?>" alt="" />
	</div>
	<p> 
<?php  echo substr($m["konu_aciklama"],0,475);# BURADA DATABASEDEN GİRİLMİŞ OLAN KONU AÇIKLAMALARII ALIYORUZ
								# VE SUBSTR KOMUTU İLE SAYFAYA GELEN DATABASE VERİSİNİ 0 İLA 475 ARASINDA ALINMASINI İSTİYORUZ VE DEVAM KISIMINDAN GERİ KALANINA ULAŞMASINI SAĞLAYACAĞIZ.. 

	?>
	 .....
	</p>
	
	<div class="devam"> 
	<a href="?do=devam&id=<?php echo $m["konu_id"]; 
	# DO komutu ile blog.php de bulunan Switch case ile konumuzu database id'sine göre çekiyoruz.
	?>">Devam...</a>
	</div>
	<div style="clear:both;"></div>
	</div>
	<?php 
	
	
}
	}
	else{
		echo '<div class="hata"> Aramanıza Ait Hiçbir Konu Bulunmamaktadır...</div>';
	}
	?>