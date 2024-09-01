<?php

session_start();
session_unset();
session_destroy();

header("Location: /studweb/indstud.php");
exit();