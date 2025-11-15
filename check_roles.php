<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Role management location:\n";
$resources = Filament\Facades\Filament::getPanel('admin')->getResources();
foreach($resources as $resource) {
    if (str_contains($resource, 'Role')) {
        echo $resource . ' - Group: ' . ($resource::getNavigationGroup() ?? 'None') . "\n";
        echo 'Navigation Label: ' . ($resource::getNavigationLabel() ?? 'None') . "\n";
        echo 'Slug: ' . ($resource::getSlug() ?? 'None') . "\n";
    }
}
