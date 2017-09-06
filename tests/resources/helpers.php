<?php

if( !function_exists('site_url') )
{
	function site_url()
	{
		return '';
	}
}

if( !function_exists('wp_redirect') )
{
	function wp_redirect($url)
	{
		return 'Redirect to ' . $url;
	}
}