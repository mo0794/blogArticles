<?php
namespace App\Security;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// Pour checker si le compte est Active ou pas avant de s'enregistrer
class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user): Void
    {

        if (!$user->isActive()) {
            throw new CustomUserMessageAuthenticationException(" Votre compte n'est pas Active  !");

        }
    }

    public function checkPostAuth(UserInterface $user): Void
    {

    }
}
