<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritesController extends AbstractController
{
    /**
     * @Route("/my/favorites", name="app_favorites")
     */
    public function index(): Response
    {
        $favorites = []; // TODO: Implement favorite

        return $this->render('favorites/index.html.twig', compact('favorites'));
    }
}
