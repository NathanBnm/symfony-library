<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Subscription;
use App\Repository\BookRepository;
use App\Repository\SubscriptionRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SubscriptionsController
 * @package App\Controller
 */
class SubscriptionsController extends AbstractController
{
    /**
     * @Route("/my/books", name="app_subscriptions")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $subscriptions = $em->getRepository(Subscription::class)->findBy(
            [
                "user" => $user
            ]
        );

        return $this->render('subscriptions/index.html.twig', compact('subscriptions'));
    }

    /**
     * @Route("/my/books/add/{bookId<[0-9]+>}", name="app_subscription_add")
     * @param EntityManagerInterface $em
     * @param int $bookId
     * @return Response
     */
    public function add(EntityManagerInterface $em, int $bookId): Response
    {
        $book = $em->getRepository(Book::class)->find($bookId);
        $user = $this->getUser();

        $subscription = $em->getRepository(Subscription::class)->findOneBy(
            [
                "book" => $book,
                "user" => $user
            ]
        );

        if (!$subscription) {
            $subscription = new Subscription();
            $subscription->setBook($book);
            $subscription->setUser($user);
            $subscription->setSubscriptionDate(new DateTimeImmutable());
        } else {
            $subscription->setRenewalDate(new DateTimeImmutable());
        }

        $em->persist($subscription);
        $em->flush();

        $this->addFlash('success', 'You successfully subscribed to this book for one year');

        return $this->redirectToRoute('app_book_show', ['id' => $bookId]);
    }

    /**
     * @Route("/my/books/remove/{bookId<[0-9]+>}", name="app_subscription_remove")
     * @param EntityManagerInterface $em
     * @param int $bookId
     * @return Response
     */
    public function remove(EntityManagerInterface $em, int $bookId): Response
    {
        $book = $em->getRepository(Book::class)->find($bookId);
        $user = $this->getUser();

        $subscription = $em->getRepository(Subscription::class)->findOneBy(
            [
                "book" => $book,
                "user" => $user
            ]
        );

        $em->remove($subscription);
        $em->flush();

        $this->addFlash('success', 'You successfully unsubscribed from this book');

        return $this->redirectToRoute('app_book_show', ['id' => $bookId]);
    }
}
