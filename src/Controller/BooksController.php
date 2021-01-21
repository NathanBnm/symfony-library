<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/books", name="app_books")
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('books/index.html.twig', compact('books'));
    }

    /**
     * @Route("/books/{id<[0-9]+>}", name="app_book_show")
     * @param BookRepository $bookRepository
     * @param int $id
     * @return Response
     */
    public function show(BookRepository $bookRepository, int $id): Response
    {
        $book = $bookRepository->find($id);

        return $this->render("book/index.html.twig", compact('book'));
    }
}
