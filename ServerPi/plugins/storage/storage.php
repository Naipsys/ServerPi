<div id="espace">
	<div id="barre">
		<div id="libre">
		</div>
	</div>
	<?php
		$used = round(disk_total_space("/")/pow(2,30),2);
		$free = round(disk_total_space("/")/pow(2,30),2) - round(disk_free_space("/")/pow(2,30),2);
		$percent = disk_free_space("/")/disk_total_space("/");
		echo '<p>Storage : ' . $free . '/' . $used . 'GB</p>';
	?> 
</div>