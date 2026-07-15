<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PrintShopController extends AbstractController
{
    #[Route('/print-shop', name: 'app_print_shop')]
    public function index(): Response
    {
        return $this->render('print_shop/index.html.twig');
    }
}
