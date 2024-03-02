<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    
    // Affiche les réservations en fonction du rôle de l'utilisateur.
    #[Route('/indexauth', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        
        // Vérifiez si l'utilisateur a le rôle AUTHOR
        $this->denyAccessUnlessGranted('ROLE_AUTHOR');

        if ($this->isGranted('ROLE_ADMIN')) {
            $reservations = $reservationRepository->findAll(); // Admins see all reservations
        } else {
            $reservations = $reservationRepository->findByAnnonceOwner($user); // Authors see only their reservations
        }

        return $this->render('reservation/indexauth.html.twig', [
            'reservations' => $reservations, // Pass the filtered reservations here
        ]);
    }


    // Affiche les réservations de l'utilisateur connecté.
    #[Route('/', name: 'app_reservation_index_user', methods: ['GET'])]
    public function userindex(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();

        $reservations = $reservationRepository->findByUser($user);

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
    // Crée une nouvelle réservation.
    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();

        $user = $this->getUser();
        $annonceId = $request->get('id');
        $annonce = $entityManager->getRepository(Annonce::class)->find($annonceId);
        // Associe l'annonce et l'utilisateur à la nouvelle réservation.
        $reservation->setAnnonce($annonce);
        $reservation->setUser($this->getUser());
        // Crée le formulaire de réservation.
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
     // Affiche une réservation spécifique.
    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }
    // Modifie une réservation existante.
    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        // recupérer l'id de l'utilisateur connecté
        $user = $this->getUser();

        // // Vérifier si l'utilisateur connecté est le créateur de la réservation
        // if ($reservation->getUser() !== $user) {
        // // Si ce n'est pas le cas, renvoyez une réponse d'accès refusé ou redirigez vers une autre page
        // throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cette réservation.');
        // }

        // Vérifier si l'utilisateur connecté est le créateur de la réservation ou un admin
        if ($reservation->getUser() !== $user && !$this->isGranted('ROLE_ADMIN')) {
        // Si ce n'est pas le cas, renvoyez une réponse d'accès refusé ou redirigez vers une autre page
        throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cette réservation.');
        }


        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    // Supprime une réservation.
    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
