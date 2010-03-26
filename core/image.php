<?php

$url=$_GET['url'];

include ("includes/header.php");
?>
<center>
 <img src='<?php echo $url;?>' />
 <br>
 <input type="button" value="return" onclick="javascript:history.back();" />
</center>