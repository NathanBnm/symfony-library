<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionsController extends AbstractController
{
    /**
     * @Route("/my/books", name="app_subscriptions")
     */
    public function index(): Response
    {
        $subscriptions = []; // TODO: Implement subscriptions

        return $this->render('subscriptions/index.html.twig', compact('subscriptions'));
    }
}
