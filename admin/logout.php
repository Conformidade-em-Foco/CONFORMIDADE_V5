<?php
session_start();
session_destroy();

// Redireciona para a página inicial do site
header("Location: /lgpd/index.php");
exit;
