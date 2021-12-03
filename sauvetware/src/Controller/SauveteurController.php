<?php

namespace App\Controller;

use App\Entity\Sauveteur;
use App\Form\SauveteurType;
use App\Repository\SauveteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sauveteur')]
class SauveteurController extends AbstractController
{
    #[Route('/', name: 'sauveteur_index', methods: ['GET'])]
    public function index(SauveteurRepository $sauveteurRepository): Response
    {
        return $this->render('sauveteur/index.html.twig', [
            'sauveteurs' => $sauveteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sauveteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sauveteur = new Sauveteur();
        $form = $this->createForm(SauveteurType::class, $sauveteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sauveteur);
            $entityManager->flush();

            return $this->redirectToRoute('sauveteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sauveteur/new.html.twig', [
            'sauveteur' => $sauveteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sauveteur_show', methods: ['GET'])]
    public function show(Sauveteur $sauveteur): Response
    {
        return $this->render('sauveteur/show.html.twig', [
            'sauveteur' => $sauveteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'sauveteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sauveteur $sauveteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SauveteurType::class, $sauveteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sauveteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sauveteur/edit.html.twig', [
            'sauveteur' => $sauveteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sauveteur_delete', methods: ['POST'])]
    public function delete(Request $request, Sauveteur $sauveteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sauveteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sauveteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sauveteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
