<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route("/accueil", name: "accueil")]
    public function home()
    {
        return $this->render("home/home.html.twig", []);
    }


    #[Route("/annonces", name: "annonces")]
    public function index()
    {
        return $this->render("annonces/annonce.html.twig", []);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connececté
     *
     * @Route("/account", name="account_index")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    #[Route("/profile", name: "profile")]
    public function profile()
    {
        return $this->render("account/profile.html.twig", [
            'user' => $this->getUser()
        ]);
    }
 

  
    /**
     * function de construction de la page
     * @param $titre
     * @return String
     */

    private function html($message, $titre, $number = ""): String
    {
        $html ="<html><head><title>$titre</title></head><body><p>$message</p>"
        ."<p>$number</p></body></html>";

        return $html;
    }
}