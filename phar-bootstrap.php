<?php
Phar::mapPhar();

$basePath = 'phar://' . __FILE__ . '/';
require $basePath . 'Smarty.class.php';
__HALT_COMPILER();
