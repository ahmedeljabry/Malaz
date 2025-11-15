<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Available resources:\n";
$resources = Filament\Facades\Filament::getPanel('admin')->getResources();
foreach($resources as $resource) {
    echo $resource . ' - Group: ' . ($resource::getNavigationGroup() ?? 'None') . "\n";
}
