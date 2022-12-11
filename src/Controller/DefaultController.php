<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\HomepageType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();
        $form = $this->createForm(HomepageType::class, $customer);

        $form->handleRequest($request);

        // Si le formulaire a été validé, on redirige vers la page du client
        if ($form->isSubmitted() && $form->isValid()) {
            if ($customerRepository->findOneBy(['code' => $customer->getCode()])) {
                return $this->redirectToRoute('customer_show', ['code' => $customer->getCode()]);
            }

            $this->addFlash('danger', 'Le code client n\'existe pas.');
        }

        return $this->render('default/index.html.twig', ['form' => $form->createView()]);
    }
}
