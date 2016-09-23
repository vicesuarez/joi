<?php 

get_header();
get_sidebar();

if(is_home()) {   
	include_once('site.php');  
}   
else if(is_page('sales')) {   
	include_once('sales.php');
}  
else if(is_page('rentals')) {  
	include_once('rentals.php');
}

get_footer();

?>
