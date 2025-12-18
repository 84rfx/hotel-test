<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rooms = App\Models\Room::all();
echo 'Room images:' . PHP_EOL;
foreach ($rooms as $room) {
    echo $room->name . ': ' . $room->image . PHP_EOL;
}
