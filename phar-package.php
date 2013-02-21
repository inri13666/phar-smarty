<?php
$archive = new Phar('smarty-3.1.13.phar', 0, 'smarty-3.1.13.phar');
$archive->buildFromDirectory('libs');
$archive->setStub(file_get_contents('phar-bootstrap.php'));
