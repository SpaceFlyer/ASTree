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
		<?php echo render($children); ?>
	</div>
	
	<div id="tabs-2">
		<?php echo render($related); ?>
	</div>
	
	<div id="tabs-3">
		<?php echo render($comments); ?>
	</div>
	
</div>
