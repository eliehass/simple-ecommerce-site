<?php // signup.php 
include_once 'header.php';
echo<<<_END
 <script>
 function submitProviderForm()
 {
 	document.getElementById('viewprovider').submit();
 }
 </script>
_END;
$searchTerm = sanitizeString($_POST['searchTerm']);
$categories = sanitizeString($_POST['categories']);
echo "Search Results:<br />";
$result = queryMysql("select businessname, username from provider where category = '$categories' and match(description) against ('$searchTerm')");
$num = mysql_num_rows($result);
for($i = 0; $i < $num; $i++)
{
    $row = mysql_fetch_row($result);
    $business = $row[0];
    $username = $row[1];
    $resultnum = $i+1;
    echo "<form id='viewprovider' action='viewprovider.php method='post' style='float: left;'>" .
    	 "<input name='provider' value='$provider' style='visibility:hidden;'></input>" .
    	  "<input name='prov_user' value='$username' style='visibility:hidden;'></input>";
    echo "$resultnum.&nbsp&nbsp<a onclick='submitProviderForm()' href='""'>$business</a><br /><br />";
}
?>