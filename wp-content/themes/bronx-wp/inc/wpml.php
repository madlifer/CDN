<?php

/* Custom Language Switcher */
function thb_language_switcher() {
	if ( function_exists('icl_get_languages') || defined('THB_DEMO_SITE') || function_exists('pll_the_languages')) {
		$permalink = get_permalink();
	?>
		<div class="select-wrapper">
		<select class="thb_language_selector">
			<?php
				if (defined('THB_DEMO_SITE')) {
					$languages = array(
						"en" => array(
							"language_code" => "en",
							"active" => 1,
							"url" => $permalink,
							"native_name" => "English"
						),
						"fr" => array(
							"language_code" => "fr",
							"active" => 0,
							"url" => $permalink,
							"native_name" => "Français"
						),
						"de" => array(
							"language_code" => "de",
							"active" => 0,
							"url" => $permalink,
							"native_name" => "Deutsch"
						)
					);
				} elseif (function_exists('pll_the_languages')) {
					$languages = pll_the_languages(array('raw'=>1));
				} elseif (function_exists('icl_get_languages')) {
					$languages = icl_get_languages('skip_missing=0');
				}
				if(1 < count($languages)){
					if (function_exists('pll_the_languages')) { // Polylang
						foreach($languages as $l){
							$selected = $l['current_lang'] ? ' selected' : '';
							echo '<option value="'.esc_attr($l['url']).'"'.$selected.'>'.esc_html($l['slug']).'</option>';
						}
					} else { // WPML
						foreach($languages as $l){
							$selected = $l['active'] ? ' selected' : '';
							echo '<option value="'.esc_attr($l['url']).'"'.$selected.'>'.esc_html($l['native_name']).'</option>';
						}
					}
				} else {
					echo '<option value="">'. esc_html__('Add Languages', 'bronx' ).'</option>';
				}
			?>
			</select>
		</div>
	<?php
	}
}
add_action( 'thb_language_switcher', 'thb_language_switcher', 3 );