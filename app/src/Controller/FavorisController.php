<?php


namespace App\Controller;


use App\Entity\Favoris;
use App\Form\FavorisType;
use App\Repository\FavorisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Définit le préfixe de route pour toutes les fonctions du contrôleur
#[Route('/favoris')]
class FavorisController extends AbstractController
{
    // Route pour afficher la liste des favoris
   #[Route('/', name: 'app_favoris_index', methods: ['GET'])]
   public function index(FavorisRepository $favorisRepository): Response
   {
       return $this->render('favoris/index.html.twig', [
           'favoris' => $favorisRepository->findAll(),
       ]);
   }

   // Route pour créer un nouveau favori
   #[Route('/new', name: 'app_favoris_new', methods: ['GET', 'POST'])]
   public function new(Request $request, EntityManagerInterface $entityManager): Response
   {
       $favori = new Favoris();
       $form = $this->createForm(FavorisType::class, $favori);
       $form->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->persist($favori);
           $entityManager->flush();


           return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
       }


       return $this->render('favoris/new.html.twig', [
           'favori' => $favori,
           'form' => $form,
       ]);
   }

    // Route pour afficher un favori spécifique
   #[Route('/{id}', name: 'app_favoris_show', methods: ['GET'])]
   public function show(Favoris $favori): Response
   {
       return $this->render('favoris/show.html.twig', [
           'favori' => $favori,
       ]);
   }

   // Route pour modifier un favori existant
   #[Route('/{id}/edit', name: 'app_favoris_edit', methods: ['GET', 'POST'])]
   public function edit(Request $request, Favoris $favori, EntityManagerInterface $entityManager): Response
   {
       $form = $this->createForm(FavorisType::class, $favori);
       $form->handleRequest($request);


       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->flush();


           return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
       }


       return $this->render('favoris/edit.html.twig', [
           'favori' => $favori,
           'form' => $form,
       ]);
   }

   // Route pour supprimer un favori
   #[Route('/{id}', name: 'app_favoris_delete', methods: ['POST'])]
   public function delete(Request $request, Favoris $favori, EntityManagerInterface $entityManager): Response
   {
       if ($this->isCsrfTokenValid('delete'.$favori->getId(), $request->request->get('_token'))) {
           $entityManager->remove($favori);
           $entityManager->flush();
       }


       return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
   }
}
