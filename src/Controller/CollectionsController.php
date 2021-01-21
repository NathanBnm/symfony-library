<?php

namespace App\Controller;

use App\Repository\BookCollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionsController extends AbstractController
{
    /**
     * @Route("/collections", name="app_collections")
     * @param BookCollectionRepository $collectionRepository
     * @return Response
     */
    public function index(BookCollectionRepository $collectionRepository): Response
    {
        $collections = $collectionRepository->findAll();

        return $this->render('collections/index.html.twig', compact('collections'));
    }
}
