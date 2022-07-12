<?php
session_start();
session_unset();
session_destroy();
header("location: /crud/index.php/?logout=true");

?>