<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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

    // #[Route("/page/{numPage}", name: "page")]
    // public function page(string $numPage)
    // {
        
    //     return new Response($this->html("Bienvenue sur la page", "page", $numPage));
    // }

  
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