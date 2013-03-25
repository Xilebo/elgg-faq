<?php

/* faq skeleton
 *
 * A Plugin to create a customizable FAQ page
 * @package faq
 *
 * @author Till Hülsemann <elgg.th@gmail.com>
 * @copyright Copyrigh (c) 2013, Till Hülsemann
 */

elgg_register_event_handler('init', 'system', 'faq_init');

function faq_init() {
/*	$current_user = elgg_get_logged_in_user_entity();
	if ($current_user) {
		if ($current_user->isAdmin()) {
			//TODO add menu to edit/add faq entrys
		}
	}
*/
	elgg_extend_view('css', 'faq/css/faq.css');

	elgg_register_menu_item('site', array(
	    'name' => 'faq',
	    'text' => elgg_echo('faq:faq'),
	    'href' => 'faq',
	));
	elgg_register_page_handler('faq', 'faq_page_handler');

	$action_path = elgg_get_plugins_path() . 'faq/actions/faq';
	elgg_register_action('faq/save', $action_path . '/save.php');
}

function faq_page_handler($subPage) {
	if (count($subPage) == 0) {
		$params = array();
		$params['filter_context'] = 'all';
		$params['title'] = elgg_echo('faq:title');
		$list_params = array(
			'type' => 'object',
			'subtype' => 'faq',
			'order_by' => 'guid',
		);
		$params['content'] = elgg_list_entities($list_params);
		if ('' == $params['content']) {
			$params['content'] = elgg_echo('faq:none');
		}
		$body = elgg_view_layout('one_sidebar', $params);

		echo elgg_view_page($params['title'], $body);
		return true;
	} else {
		if ('add' == $subPage[0]) {
			admin_gatekeeper();

			$title = elgg_echo('faq:add:title');
			$content = elgg_view_title($title);
			$content .= elgg_view_form("faq/save");
			$body = elgg_view_layout('one_sidebar', array(
				'content' => $content,
			));
			 
			echo elgg_view_page($title, $body);
			return true;
		}
	}

}

function generateDummys($start, $end) {
	for ($i = $start; $i <= $end; $i++) {
		$object = new ElggObject();
		$object->subtype = 'faq';
		$object->access_id = 2;
		$object->title = 'Wenn ich jetzt Frage Nr.'.$i.' stelle, wie lautet dann die Antwort?';
		$object->description = 'Allgemein formuliert muss die Antwort natürlich 42 lauten. Etwas präzisiert wäre aber in diesem Fall auch '.$i.' richtig. Das sollte aber nicht unbedingt verallgemeinert werden, da es sonst zu erheblichen Missverständnissen kommen kann.';
		$object->save();
	}
}

?>

