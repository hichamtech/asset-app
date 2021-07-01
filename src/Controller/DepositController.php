<?php

namespace App\Controller;

use App\Entity\Deposit;
use App\Form\DepositType;
use App\Repository\DepositRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/deposit")
 */
class DepositController extends AbstractController
{
    /**
     * @Route("/admin", name="deposit_index", methods={"GET"})
     */
    public function index(DepositRepository $depositRepository): Response
    {
        return $this->render('deposit/index.html.twig', [
            'deposits' => $depositRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="deposit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $deposit = new Deposit();
        $form = $this->createForm(DepositType::class, $deposit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deposit);
            $entityManager->flush();

            return $this->redirectToRoute('deposit_index');
        }

        return $this->render('deposit/new.html.twig', [
            'deposit' => $deposit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deposit_show", methods={"GET"})
     */
    public function show(Deposit $deposit): Response
    {
        return $this->render('deposit/show.html.twig', [
            'deposit' => $deposit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deposit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deposit $deposit): Response
    {
        $form = $this->createForm(DepositType::class, $deposit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deposit_index');
        }

        return $this->render('deposit/edit.html.twig', [
            'deposit' => $deposit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deposit_delete", methods={"POST"})
     */
    public function delete(Request $request, Deposit $deposit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deposit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deposit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deposit_index');
    }
}
