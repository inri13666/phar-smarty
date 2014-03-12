<?php
Phar::mapPhar();

$basePath = 'phar://' . __FILE__ . '/';
require_once $basePath . 'Smarty.class.php';

$debug_tpl_dir = __DIR__ . DIRECTORY_SEPARATOR;
if (!is_writable($debug_tpl_dir)) {
    $debug_tpl_dir = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}
if ((!is_readable($debug_tpl_dir . 'debug.tpl'))) {
    file_put_contents($debug_tpl_dir . 'debug.tpl', file_get_contents($basePath . 'debug.tpl'));
};
define('SMARTY_DEBUG_TPL', $debug_tpl_dir . 'debug.tpl');

__HALT_COMPILER();
