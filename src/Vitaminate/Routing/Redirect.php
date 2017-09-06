<?php
 
 namespace Vitaminate\Routing;

 class Redirect
 {
 	/**
 	 * Use the WP redirect function
 	 * to create a redirection to specific route name.
 	 *
 	 * @param string $url
 	 * @return void
 	 */
 	public static function to($url)
 	{
 		wp_redirect($url); exit;
 	}
 }