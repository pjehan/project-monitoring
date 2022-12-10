<?php

namespace App\Controller;

use App\Form\HomepageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $form = $this->createForm(HomepageType::class);

        return $this->render('default/index.html.twig', ['form' => $form->createView()]);
    }
}
