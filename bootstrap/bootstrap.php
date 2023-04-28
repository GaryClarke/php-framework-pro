<?php

$providers = [
    \App\Provider\EventServiceProvider::class
];

foreach ($providers as $providerClass) {
    $provider = $container->get($providerClass);
    $provider->register();
}