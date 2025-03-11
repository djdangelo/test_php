<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use App\Infrastructure\EventHandler\UserRegisteredEventHandler;
    use Symfony\Component\EventDispatcher\EventDispatcher;
    
    $eventDispatcher = new EventDispatcher();
    $eventDispatcher->addSubscriber(new UserRegisteredEventHandler());
    
?>