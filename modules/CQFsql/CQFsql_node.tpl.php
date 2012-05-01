<?php foreach($itemset as $table_name=>$recommend_set){
	echo render($nodeset[$table_name]); 
echo "<div id='add_table_dialog_".$table_name."' class='astree_dialog' >";?>
<label><?= t('From recommend list:') ?></label>
<ul>

	<?php foreach ($recommend_set as $child) { ?>
<li>
<?php echo $child['title'] ?>
<div class="actions">
<?php echo $child['action'] ?>
</div>
</li>
<?php }?> 

</div>
<script>
jQuery(document).ready(function(){
<?php echo "jQuery('#add_table_dialog_".$table_name."').dialog({autoOpen:false, width: 600, height: 450 });";?>
			});
		</script>
<?php echo "<a href='javascript:void(0)' onclick=\"jQuery('#add_table_dialog_".$table_name."').dialog('open')\">Describe ".$table_name." or choose a similar description</a>";?>
</ul>
<?php }?>
		
		
	
