<?php

namespace App\Controller;

use App\Entity\Sauvetage;
use App\Form\SauvetageType;
use App\Repository\SauvetageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sauvetage')]
class SauvetageController extends AbstractController
{
    #[Route('/', name: 'sauvetage_index', methods: ['GET'])]
    public function index(SauvetageRepository $sauvetageRepository): Response
    {
        return $this->render('sauvetage/index.html.twig', [
            'sauvetages' => $sauvetageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sauvetage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sauvetage = new Sauvetage();
        $form = $this->createForm(SauvetageType::class, $sauvetage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sauvetage);
            $entityManager->flush();

            return $this->redirectToRoute('sauvetage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sauvetage/new.html.twig', [
            'sauvetage' => $sauvetage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sauvetage_show', methods: ['GET'])]
    public function show(Sauvetage $sauvetage): Response
    {
        return $this->render('sauvetage/show.html.twig', [
            'sauvetage' => $sauvetage,
        ]);
    }

    #[Route('/{id}/edit', name: 'sauvetage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sauvetage $sauvetage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SauvetageType::class, $sauvetage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sauvetage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sauvetage/edit.html.twig', [
            'sauvetage' => $sauvetage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sauvetage_delete', methods: ['POST'])]
    public function delete(Request $request, Sauvetage $sauvetage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sauvetage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sauvetage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sauvetage_index', [], Response::HTTP_SEE_OTHER);
    }
}
