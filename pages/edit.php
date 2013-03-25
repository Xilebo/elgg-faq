<?php

admin_gatekeeper();

$title = elgg_echo('faq:edit:title');
$content = elgg_view_title($title);
$content .= elgg_view_form("faq/save");
$body = elgg_view_layout('one_sidebar', array(
	'content' => $content,
));
 
echo elgg_view_page($title, $body);

?>
