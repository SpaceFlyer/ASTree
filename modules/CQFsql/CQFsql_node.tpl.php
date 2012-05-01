<?php foreach($itemset as $table_name=>$recommend_set){
echo "<div id='add_table_dialog_".$table_name."' class='astree_dialog' >";?>
<?php if (count($recommend_set) > 0){ ?>
<label><?= t('From related questions:') ?></label>
<ul>

	<?php foreach ($recommend_set as $child) { ?>
<li>
<?php echo $child['title'] ?>
<div class="actions">
<?php echo $child['action'] ?>
</div>
</li>
<?php }?> 
</ul>
<hr/>
<?php } ?>

<label><?= t('Create a new question:') ?></label>
<?php	echo render($nodeset[$table_name]); ?>
</div>
<script>
jQuery(document).ready(function(){
<?php echo "jQuery('#add_table_dialog_".$table_name."').dialog({autoOpen:false, width: 600, height: 450 });";?>
			});
		</script>
<?php echo "<a href='javascript:void(0)' onclick=\"jQuery('#add_table_dialog_".$table_name."').dialog('open')\">Describe ".$table_name." or choose a similar description</a>";?>
<?php }?>
		
		
	
