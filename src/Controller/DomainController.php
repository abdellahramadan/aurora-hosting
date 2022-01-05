<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/domain')]
class DomainController extends AbstractController
{
    #[Route('/', name: 'domain')]
    public function index(): Response
    {
        return $this->render('domain/index.html.twig', [
            'controller_name' => 'DomainController',
        ]);
    }

    #[Route('/search/', name: 'domain_search')]
    public function searchDomain(Request $request): Response
    {
        $domainTerm = $request->request->get('domain');

        dump($domainTerm);

        return $this->render('domain/search.html.twig', [

        ]);
    }
}
