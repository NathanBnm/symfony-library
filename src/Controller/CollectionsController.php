<?php

namespace App\Controller;

use App\Repository\BookCollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CollectionsController
 * @package App\Controller
 */
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

    /**
     * @Route("/collections/{id<[0-9]+>}", name="app_collection_show")
     * @param BookCollectionRepository $collectionRepository
     * @param int $id
     * @return Response
     */
    public function show(BookCollectionRepository $collectionRepository, int $id): Response
    {
        $collection = $collectionRepository->find($id);

        return $this->render("collection/index.html.twig", compact('collection'));
    }
}
