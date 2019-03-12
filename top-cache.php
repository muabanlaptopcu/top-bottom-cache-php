<?php
//settings
$cache_time     = 3600*24;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder   = 'cached/'; //folder to store Cache files
$ignore_pages   = array('cart.html', 'member-register.html','member-login.html','lien-he.html','member-edit-account.html');

$site_url = "http://".$_SERVER['SERVER_NAME']."";
$dynamic_url    = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ; // requested dynamic page (full url)
$dynamic_url    = str_replace($site_url."/","",$dynamic_url);
$dynamic_url    = str_replace("/","-",$dynamic_url);  // requested dynamic page (full url)
$cache_file     = $cache_folder.$dynamic_url; // construct a cache file
$ignore = (in_array($dynamic_url,$ignore_pages))?true:false; //check if url is in ignore list
if($site_url."/"=='http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
	$cache_file     = $cache_folder."index.html"; // construct a cache file
}else {
	$cache_file     = $cache_folder.$dynamic_url; // construct a cache file
}
if (!$ignore && file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) { //check Cache exist and it's not expired.
    //ob_start('ob_gzhandler'); //Turn on output buffering, "ob_gzhandler" for the compressed page with gzip.
    readfile($cache_file); //read Cache file
    echo '<!-- cached page - '.date('l jS \of F Y h:i:s A', filemtime($cache_file)).', Page : '.$dynamic_url.' -->';
    //ob_end_flush(); //Flush and turn off output buffering
    exit(); //no need to proceed further, exit the flow.
}
//Turn on output buffering with gzip compression.
if (!in_array('ob_gzhandler', ob_list_handlers())) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
######## Your Website Content Starts Below #########
?>