<?php 
	# Language select
	include('languages/'. $LANGUAGE .'.php');
?>
<div id="storage_box">
	<div class="schema">
		<div class="used" style="width:<?php $used = disk_total_space("/"); $free = disk_free_space("/"); $ratio = round(1-$free/$used,2); $width = floor(775 * $ratio); echo $width; ?>px;">
		</div>
	</div>
	<?php
		$used = round(disk_total_space("/")/pow(2,30),2);
		$free = round(disk_total_space("/")/pow(2,30),2) - round(disk_free_space("/")/pow(2,30),2);
		$percent = disk_free_space("/")/disk_total_space("/");
		echo '<p>'. $LANGUAGE_STORAGE['storage'] .' : ' . $free . '/' . $used . 'GB</p>';
	?> 
</div>
