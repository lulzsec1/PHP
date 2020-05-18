	<div class="sag2"> 
	<h2>POPÜLER 3 KONUMUZ </h2>
	
		<?php 
		$v = $db->prepare("select *from konular order by konu_hit desc limit 5"); # BURADA 5 tane konuyu alıp onların hitleri ile karşılaştırıp en yüksek olanı ilk sırada göstertiyoruz.
		$v->execute(array());
		$pop = $v->fetchALL(PDO::FETCH_ASSOC);
		$x = $v->rowCount();
		
		if($x){
			foreach($pop as $m){
				echo '<h3><a href="?do=devam&id='.$m["konu_id"].'">'.$m["konu_baslik"].'</a></h3>';
			}
		}
		else
		{
			echo '<div class="hata">Popüler Konu Bulunamadı...</div>';
			
		}
		
		
		
		?>
		
		
	</div>