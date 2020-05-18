<?php
		$sayfa = intval(@$_GET["sayfa"]); ## İntval fonksiyonu sayıdan başka değerlerin girilmesine izin vermez
		
		if(!$sayfa){
			$sayfa = 1;
		}
		$v = $db->prepare("select * from konular");
		$v->execute(array());
		$v->fetchALL(PDO::FETCH_ASSOC);
		$toplam = $v->rowCount();
		$limit= 3; ## gösterilecek yazıların limitini belirttik
		$goster= $sayfa*$limit-$limit;  ## sayfa aralığını buluyoruz 
		$sayfasayisi = ceil($toplam/$limit); ## ceil ile yuvarlama yapılıyor. ve bu sayede sayfa sayısı bulunabiliyor.
		$forlimit=2;
		
		

		$konu 	= $db->prepare("select * from konular inner join kategoriler on 
		kategoriler.kategori_id = konular.konu_kategori order by konu_id desc limit $goster,$limit"); #databaseten konular tablomuza bağlanıyoruz. İnner join ile alt içeriğe bağlanıyoruz.
		$konu->execute(array()); 						#  databaseten gelenleri Dizi haline çeviriyoruz.
	$x= $konu->fetchALL(PDO::FETCH_ASSOC);				# İndis numaralarından kurtuluyoruz ve bu konuları böylece listeleyebiliyoruz.

## BİRDEN ÇOK KONU OLABİLECEĞİNDEN FOREACH DÖNGÜMÜZÜ BAŞLATIYORUZ.
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
	<span style="color:blue;"> Kategori:</span> <?php  echo $m["kategori_adi"]; #buradaki her şeyi veritabanındakilere göre çekiyoruz?>
	<span style="color:blue;"> Yazan:</span>  <?php  echo $m["konu_ekleyen"];?>
	<span style="color:blue;"> Okuyan:</span>  <?php  echo $m["konu_hit"]; # devam butonuna tıklandıkça okunma sayısı artıyor.?>  
	<span style="color:blue;"> Yorum: </span><?php echo $x;?>
	<span style="float:right;">
	<span style="color:blue;"> Tarih:</span> <?php  echo $m["konu_tarih"];?></span></div> 
	<div class="resim"> 
	<img src="<?php echo $m["konu_resim"]; # RESİMLERİMİZİ BURADAN UPLOAD EDİYORUZ. 
	?>" alt="" />
	</div>
	<p> 
<?php  echo mb_substr($m["konu_aciklama"],0,475);# BURADA DATABASEDEN GİRİLMİŞ OLAN KONU AÇIKLAMALARII ALIYORUZ
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
	echo '<div class="sayfalama">';
		for($i = $sayfa - $forlimit; $i<$sayfa + $forlimit +1; $i++){
			if($i>0 && $i<=$sayfasayisi){
				if($i == $sayfa){
					echo '<span class="aktif">'.$i.'</span>';
				}
				else {
					echo '<span class="sayfa"><a href="?sayfa='.$i.'">'.$i.'</a></span>';
					
				}
			}
		}
	?>
