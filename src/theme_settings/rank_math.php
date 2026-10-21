<?php

add_action('rank_math/vars/register_extra_replacements', function () {
	rank_math_register_var_replacement(
		'parent_category',
		[
			'name'        => esc_html__('Parent Category Name', 'rank-math'),
			'description' => esc_html__('Displays the parent category name of the current product or term.', 'rank-math'),
			'variable'    => 'parent_category',
			'example'     => 'Example Parent Category',
		],
		'rank_math_parent_category_call_back'
	);
});
function rank_math_parent_category_call_back() {
	$object = get_queried_object();
	// Caso 1: Archivio categoria prodotto (product_cat)
	if ($object instanceof WP_Term && $object->taxonomy === 'product_cat') {
		if ($object->parent != 0) {
			$parent_term = get_term($object->parent, 'product_cat');
			return $parent_term ? esc_html($parent_term->name) : '';
		}
	}
	// Caso 2: Scheda prodotto singolo
	if ($object instanceof WP_Post && $object->post_type === 'product') {
		$terms = wp_get_post_terms($object->ID, 'product_cat', ['orderby' => 'parent', 'order' => 'DESC']);
		if (!empty($terms) && !is_wp_error($terms)) {
			// Prendo la categoria principale (prima trovata)
			$cat = $terms[0];
			if ($cat->parent != 0) {
				$parent_term = get_term($cat->parent, 'product_cat');
				return $parent_term ? esc_html($parent_term->name) : '';
			}
		}
	}
	return '';
}

?>
