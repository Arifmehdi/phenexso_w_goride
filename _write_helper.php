<?php
$code = file_get_contents('php://stdin');
file_put_contents('app/Http/Controllers/Api/ProfileCompletionController.php', $code);
echo 'Written: ' . strlen($code) . ' bytes';
