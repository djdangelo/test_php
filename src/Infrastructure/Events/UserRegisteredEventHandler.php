<?php
namespace App\Infrastructure\EventHandler;

use App\Domain\User\Event\UserRegisteredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisteredEventHandler implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisteredEvent::NAME => 'onUserRegistered',
        ];
    }

    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();

        // Simular el envío de un correo electrónico de bienvenida
        $email = $user->getEmail()->getValue();
        $name = $user->getName()->getValue();

        echo sprintf("Enviando correo de bienvenida a %s (%s)...\n", $name, $email);
    }
}
?>