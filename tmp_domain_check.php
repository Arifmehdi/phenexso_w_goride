<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    new Symfony\Component\Console\Input\ArrayInput(['command' => 'domain:check']),
    new Symfony\Component\Console\Output\BufferedOutput()
);
echo $status;
