<script>
	jQuery(document).ready(function(){
		jQuery('#astree_tabs').tabs();
	});
</script>

<div id="astree_tabs">
	<ul>
		<li><a href="#tabs-1">
            <?php if ($children['#child_type'] == 'answer_sql') echo 'SQL solutions'; else echo 'Subqueries'; ?>
            <?php echo "({$children['#count']})" ?>
        </a></li>
        <?php if ($children['#child_type'] == 'answer_sql') { ?> 
		<li>
        <a href="#tabs-2">
            Related
            <?php echo "({$related['#count']})" ?>
        </a></li>
        <?php } ?>
		<li><a href="#tabs-3">
            Comments
            <?php echo "({$comments['#comment_count']})" ?>
        </a></li>
	</ul>
	
	<div id="tabs-1">
		<?php 
			hide($children['new_child_form']); 
			hide($children['recommend_child_list']);
			echo render($children); 
		?>
        <?php if ($children['#child_type'] == "answer_sql") { ?>
        <?php if (FALSE) { ?>
		<div id="add_existed_child_tab" class="astree_dialog">
			<h2 class="title"><?= t('Add existed node as child') ?></h2>
			<form action="?q=add_child/<?= $children['#parent_id'] ?>" method="post">
				<label><?= t('From link or id of the node:') ?></label>
				<input type="text" name="child_link_or_nid" id="child_link_or_nid"/>
				<input type="submit" value="Submit">
			</form>
			<hr/>
			<label><?= t('From recommend list:') ?></label>
			<ul>
				<?php foreach ($children['recommend_child_list'] as $child) { ?>
				<li>
					<?php echo $child['title'] ?>
					<div class="actions">
						<?php echo $child['action'] ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#add_existed_child_tab').dialog({ autoOpen: false, width: 600, height: 450 });
			});
		</script>
		<a href="javascript:void(0)" onclick="jQuery('#add_existed_child_tab').dialog('open')">Add new child from existed node</a>
        <?php } ?>
		<h2 class="title child-form"><?php echo t('Create new SQL solution'); ?></h2>
		<?php echo render($children['new_child_form']); ?>
        <?php } ?>
	</div>
	
    <?php if ($children['#child_type'] == 'answer_sql') { ?> 
	<div id="tabs-2">
		<?php 
			hide($related['new_related_form']); 
			hide($related['recommend_related_list']);
			echo render($related); 
		?>
		<div id="add_existed_related_tab" class="astree_dialog">
			<h2 class="title"><?= t('Add existed question as related') ?></h2>
			<form action="?q=add_related/<?= $related['#from_id'] ?>" method="post">
				<label><?= t('From link or id of the question:') ?></label>
				<input type="text" name="related_link_or_nid" id="related_link_or_nid"/>
				<input type="submit" value="Submit">
			</form>
			<hr/>
			<label><?= t('From recommend list:') ?></label>
			<ul>
				<?php foreach ($related['recommend_related_list'] as $related_node) { ?>
                <?php if ($related_node['title'] == NULL) continue; ?>
				<li>
					<?php echo $related_node['title'] ?>
					<div class="actions">
						<?php echo $related_node['action'] ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#add_existed_related_tab').dialog({ autoOpen: false, width: 600, height: 450 });
			});
		</script>
		<a href="javascript:void(0)" onclick="jQuery('#add_existed_related_tab').dialog('open')">Add existed question as related</a>
		<h2 class="title related-form"><?php echo t('Create new question as related'); ?></h2>
		<?php echo render($related['new_related_form']); ?>
	</div>
    <?php } ?>
	
	<div id="tabs-3">
		<?php echo render($comments); ?>
	</div>
	
</div>
