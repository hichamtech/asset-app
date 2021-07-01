<?php

namespace App\Controller;

use App\Entity\Withdraw;
use App\Form\WithdrawType;
use App\Repository\WithdrawRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/withdraw")
 */
class WithdrawController extends AbstractController
{
    /**
     * @Route("/", name="withdraw_index", methods={"GET"})
     */
    public function index(WithdrawRepository $withdrawRepository): Response
    {
        return $this->render('withdraw/index.html.twig', [
            'withdraws' => $withdrawRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="withdraw_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $withdraw = new Withdraw();
        $form = $this->createForm(WithdrawType::class, $withdraw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($withdraw);
            $entityManager->flush();

            return $this->redirectToRoute('withdraw_index');
        }

        return $this->render('withdraw/new.html.twig', [
            'withdraw' => $withdraw,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="withdraw_show", methods={"GET"})
     */
    public function show(Withdraw $withdraw): Response
    {
        return $this->render('withdraw/show.html.twig', [
            'withdraw' => $withdraw,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="withdraw_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Withdraw $withdraw): Response
    {
        $form = $this->createForm(WithdrawType::class, $withdraw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('withdraw_index');
        }

        return $this->render('withdraw/edit.html.twig', [
            'withdraw' => $withdraw,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="withdraw_delete", methods={"POST"})
     */
    public function delete(Request $request, Withdraw $withdraw): Response
    {
        if ($this->isCsrfTokenValid('delete'.$withdraw->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($withdraw);
            $entityManager->flush();
        }

        return $this->redirectToRoute('withdraw_index');
    }
}
