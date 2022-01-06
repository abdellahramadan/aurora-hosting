<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Arrayy\create as a;

class DomainController extends AbstractController
{
    const OAUTH = 'Y2M1NTE0YjE3ZWU2M2ZiMjU=';
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/domain', name: 'domain')]
    public function index(): Response
    {
        return $this->render('domain/index.html.twig', [
            'controller_name' => 'DomainController',
        ]);
    }

    #[Route('/domain-search', name: 'domain_search')]
    public function searchDomain(Request $request): Response
    {

        if ($request->request->get('domain')) {

            $domainTerm = $request->request->get('domain');

            $response = $this->client->request('GET', 'https://api.20i.com/domain-search/' . $domainTerm, [
                'auth_bearer' => self::OAUTH
            ]);

            $domainName = $response->toArray();

            if (a($domainName)->first()->get('header')->first()->first() === $domainTerm &&
                a($domainName)[1]->get('name') === $domainTerm && a($domainName)[1]->get('can') === 'register'
            ) {
                return $this->render('domain/search.html.twig', [
                    'domainFound' => true,
                    'domainName' => a($domainName)[1]->get('name'),
                ]);
            }

            return $this->render('domain/search.html.twig', [
                'domainFound' => false,
                'domainName' => a($domainName)[1]->get('name'),
            ]);
        }

        return $this->render('domain/search.html.twig', [

        ]);
    }
}
