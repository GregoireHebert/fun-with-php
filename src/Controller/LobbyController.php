<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LobbyController extends AbstractController
{
    /**
     * @Route("/lobby", name="lobby")
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(): Response
    {
        return $this->render('lobby/index.html.twig', [
            'controller_name' => 'LobbyController',
        ]);
    }
}
