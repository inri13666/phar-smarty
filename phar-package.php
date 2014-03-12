<?php
$smarty_version = '3.1.13';
$filename = __DIR__ . DIRECTORY_SEPARATOR . 'smarty-' . $smarty_version . '.phar';
/**
 * Remove Previous Compiled Archives
 */
if (is_readable($filename)) {
    unlink($filename);
}
if (is_readable($filename . '.bz2')) {
    unlink($filename . '.bz2');
}
if (is_readable($filename . '.gz')) {
    unlink($filename . '.gz');
}

$archive = new Phar($filename, 0, 'Smarty');
$archive->buildFromDirectory('libs');
$archive->setStub(file_get_contents('phar-bootstrap.php'));

$class = "Phar";
foreach (Phar::getSupportedCompression() as $compression) {
    switch ($compression) {
        case 'BZIP2':
            $archive->compress(Phar::BZ2);
            break;
        case 'GZ':
            $archive->compress(Phar::GZ);
            break;
        default:
            echo "Untracked compression : " . $compression . PHP_EOL;
            break;
    }
};