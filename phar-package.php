<?php
if (!is_dir(__DIR__ . DIRECTORY_SEPARATOR . 'compiled')) {
    if (!mkdir(__DIR__ . DIRECTORY_SEPARATOR . 'compiled')) {
        throw new Exception('Cant Create Folder');
    };
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'libs/Smarty.class.php';

$filename = __DIR__ . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR . strtolower(Smarty::SMARTY_VERSION);
/**
 * Remove Previous Compiled Archives
 */
if (is_readable($filename)) {
    unlink($filename);
}

$archive = new Phar($filename . '.phar', 0, 'Smarty');
$archive->buildFromDirectory('libs');
$bootstrap = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'phar-bootstrap.php');
$archive->setStub($bootstrap);
$archive = null;
unset($archive);
file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR . 'smarty.phar', file_get_contents($filename . '.phar'));

//Create GZ Archive, That will use Phar's Stub
if (function_exists('gzopen')) {
    if (is_readable($filename . '.gz')) {
        unlink($filename . '.gz');
    }
    $gz = gzopen($filename . '.gz', 'w');
    gzwrite($gz, gzcompress(file_get_contents($filename . '.phar'), 9));
    gzclose($gz);
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR . 'smarty.gz', file_get_contents($filename . '.gz'));
}

//Create BZ2 Archive, That will use Phar's Stub
if (function_exists('bzopen')) {
    if (is_readable($filename . '.bz2')) {
        unlink($filename . '.bz2');
    }
    $bz2 = bzopen($filename . '.bz2', 'w');
    bzwrite($bz2, bzcompress(file_get_contents($filename . '.phar'), 9));
    bzclose($bz2);
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR . 'smarty.bz2', file_get_contents($filename . '.bz2'));
}