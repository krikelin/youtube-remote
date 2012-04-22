<?php
setcookie("sess_id", "", time()-3600);
header("location: index.php");
?>