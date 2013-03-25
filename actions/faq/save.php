<?php

admin_gatekeeper();

$title = get_input('title');
$body = get_input('body');
$tags = string_to_tag_array(get_input('tags'));

$faq = new ElggObject();
$faq->subtype = "faq";
$faq->title = $title;
$faq->description = $body;
$faq->access_id = ACCESS_PUBLIC;

$faq_guid = $faq->save();

if ($faq_guid) {
	system_message(elgg_echo('faq:save:success'));
	forward('faq');
} else {
	register_error(elgg_echo('faq:save:failed'));
	forward(REFERER); // REFERER is a global variable that defines the previous page
}

?>
