<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $client;
    const OAUTH = 'Y2M1NTE0YjE3ZWU2M2ZiMjU=';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $response = $this->client->request('GET', 'https://api.20i.com/domain', [

            'auth_bearer' => self::OAUTH,

        ]);

        dump($response->getContent());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
