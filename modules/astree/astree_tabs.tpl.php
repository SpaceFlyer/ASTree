<script>
	jQuery(document).ready(function(){
		jQuery('#astree_tabs').tabs();
	});
</script>

<div id="astree_tabs">
	<ul>
		<li><a href="#tabs-1">Children</a></li>
		<li><a href="#tabs-2">Related</a></li>
		<li><a href="#tabs-3">Comments</a></li>
	</ul>
	
	<div id="tabs-1">
		<?php 
			hide($children['new_child_form']); 
			hide($children['recommend_child_list']);
			echo render($children); 
		?>
		<div id="add_existed_child_tab">
			<h2 class="title"><?= t('Add existed node as child') ?></h2>
			<form action="?q=add_child/<?= $children['#parent_id'] ?>" method="post">
				<label><?= t('The link or id of the node') ?></label>
				<input type="text" name="child_link_or_nid" id="child_link_or_nid"/>
				<input type="submit" value="Submit">
			</form>
			<hr/>
			<ul>
				<?php foreach ($children['recommend_child_list'] as $child) { ?>
				<li>
					<?php echo $child['title'] ?>
					</br>
					<?php echo $child['action'] ?>
				</li>
				<?php } ?>
			</ul>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#add_existed_child_tab').dialog({ autoOpen: false });
			});
		</script>
		<a href="javascript:void(0)" onclick="jQuery('#add_existed_child_tab').dialog('open')">Add new child from existed node</a>
		<h2 class="title child-form"><?php echo t('Create new node as child'); ?></h2>
		<?php echo render($children['new_child_form']); ?>
	</div>
	
	<div id="tabs-2">
		<?php hide($related['new_related_form']); echo render($related); ?>
		<h2 class="title related-form"><?php echo t('Add new related'); ?></h2>
		<?php echo render($related['new_related_form']); ?>
		</div>
	
	<div id="tabs-3">
		<?php echo render($comments); ?>
	</div>
	
</div>
