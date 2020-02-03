<?php

namespace App\Controller;

use App\Entity\Opportunity;
use App\Form\OpportunityType;
use App\Repository\OpportunityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/opportunity")
 */
class OpportunityController extends AbstractController
{
    /**
     * @Route("/", name="opportunity_index", methods={"GET"})
     */
    public function index(OpportunityRepository $opportunityRepository): Response
    {
        return $this->render('opportunity/index.html.twig', [
            'opportunities' => $opportunityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="opportunity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $opportunity = new Opportunity();
        $form = $this->createForm(OpportunityType::class, $opportunity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opportunity);
            $entityManager->flush();

            return $this->redirectToRoute('opportunity_index');
        }

        return $this->render('opportunity/new.html.twig', [
            'opportunity' => $opportunity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="opportunity_show", methods={"GET"})
     */
    public function show(Opportunity $opportunity): Response
    {
        return $this->render('opportunity/show.html.twig', [
            'opportunity' => $opportunity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="opportunity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Opportunity $opportunity): Response
    {
        $form = $this->createForm(OpportunityType::class, $opportunity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opportunity_index');
        }

        return $this->render('opportunity/edit.html.twig', [
            'opportunity' => $opportunity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="opportunity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Opportunity $opportunity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opportunity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($opportunity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('opportunity_index');
    }
}
