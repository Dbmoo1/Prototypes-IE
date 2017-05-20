<?php
require_once("sessionmgmt.php");
SessionManager::Logout();
header("Location: index.html");
 ?>
