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
        // $lien = "<a href='page/2'>liens vers la page 2</a>";
        // $lien2 = "<a href='page/3'>liens vers la page 3</a>";
        // $page = $this->html("Hello World <br/>"."$lien<br/>"."$lien2", "page d'accueil");
        // return new Response($page);

        return $this->render("home/home.html.twig", []);
    }

    #[Route("/page/{numPage}", name: "page")]
    public function page(string $numPage)
    {
        
        return new Response($this->html("Bienvenue sur la page", "page", $numPage));
    }

    public function aboutbook()
    {
        return new Response("C'est à propos des livres !!");
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