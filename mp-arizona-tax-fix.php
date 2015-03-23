<?php
/*
Plugin Name: Fix for MarketPress Tax Calculation (Arizona State)
Version: 1.0.1
Description: Just specify your base state as Arizona and set the tax rate, the state tax calculation automatically applies to any purchases made in the store including overseas
Plugin URI: http://premium.wpmudev.org/
Author: Jude (WPMU DEV)
*/

add_filter('mp_tax_price','arizona_tax_fix', 4,4);

function arizona_tax_fix($tax, $total, $selected_cart, $country, $state)
{
	global $mp;

	if('US' == $mp->get_setting('base_country')
	&& 'AZ' == $mp->get_setting('base_province')) :
		if ($mp->get_setting('tax_shipping'))
		 	$tax = $total * $mp->get_setting('tax->rate');
		else {
				foreach ($selected_cart as $cart) {
					foreach ($cart as $item) {
						$totals[] = $item['price'] * $item['quantity'];
					}
				}
			$tax = array_sum($totals) * $mp->get_setting('tax->rate');	
		}
	endif;
	return $tax ;
}

?>