<div>
	<label><?php echo elgg_echo("title"); ?></label><br />
	<?php echo elgg_view('input/text',array('name' => 'title')); ?>
</div>

<div>
	<label><?php echo elgg_echo("body"); ?></label><br />
	<?php echo elgg_view('input/longtext',array('name' => 'body')); ?>
</div>

<div>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>

