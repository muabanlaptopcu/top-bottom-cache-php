# topbottomcache
Create Cache file for Website

Begin: Create "cached" folders and Chmod 777 in root hosting

Example:

index.php :

session_start();

include "top-cache.php";

and bottom page

include('bottom-cache.php');
