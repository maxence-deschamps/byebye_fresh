<?php

namespace App\Controller\Securite;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Deconnexion extends AbstractController
{
    #[Route(path: '/deconnexion', name: 'securite_deconnexion')]
    public function __invoke(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
