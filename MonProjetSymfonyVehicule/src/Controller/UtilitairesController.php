<?php

namespace App\Controller;

use App\Entity\Utilitaires;
use App\Form\RechercheUtilitaireType;
use App\Form\UtilitairesType;
use App\Repository\UtilitairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class UtilitairesController extends AbstractController
{

    /**
     * @Route("/utilitairesRecherche", name="utilitaires_recherche", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function rechercheUtilitaire(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $utilitaire=$em->getRepository(Utilitaires::class)->findAll();
        if($request->isMethod("POST"))
        {
            $marqueU = $request->get('marqueU');
            $utilitaire = $em->getRepository(Utilitaires::class)->searchUtilitaires2(array('marqueU'=>$marqueU));
        }

        return $this->render('utilitaires/utilitairesRecherche.html.twig',array('utilitaires'=>$utilitaire));
    }

    /**
     * @Route("/utilitairesRechercheAvancee", name="utilitaires_rechercheAvancee")
     * @param Request $request
     * @param UtilitairesRepository $utilitairesRepository
     * @return Response
     */
    public function rechercheAvanceeU(Request $request, UtilitairesRepository $utilitairesRepository): Response
    {
        $utilitaires = [];
        $searchUtilitairesForm = $this->createForm(RechercheUtilitaireType::class);

        if($searchUtilitairesForm->handleRequest($request)->isSubmitted() && $searchUtilitairesForm->isValid()){
            $criteria = $searchUtilitairesForm->getData();

            $utilitaires = $utilitairesRepository->searchUtilitaires($criteria);

            //dd($utilitaires);  pour dump(voir contenu)
        }
        return $this->render('utilitaires/utilitaireRechercheAvancce.html.twig', [
            'search_form' => $searchUtilitairesForm->createView(),
            'utilitaires' => $utilitaires,
        ]);
    }

    /**
     * @Route("/utilitaires", name="utilitaires_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Utilitaires::class)->findAll();

        $utilitaires = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),6
        );
        return $this->render('utilitaires/index.html.twig', [
            'utilitaires' => $utilitaires
        ]);
    }

    /**
     * @Route("/newutilitaires", name="utilitaires_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $utilitaire = new Utilitaires();
        $form = $this->createForm(UtilitairesType::class, $utilitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilitaire);
            $entityManager->flush();

            return $this->redirectToRoute('utilitaires_index');
        }

        return $this->render('utilitaires/new.html.twig', [
            'utilitaire' => $utilitaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/utilitaires/{id}", name="utilitaires_show", methods={"GET"})
     * @param Utilitaires $utilitaire
     * @return Response
     */
    public function show(Utilitaires $utilitaire): Response
    {
        return $this->render('utilitaires/show.html.twig', [
            'utilitaire' => $utilitaire,
        ]);
    }

    /**
     * @Route("/utilitaires/{id}/edit", name="utilitaires_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Utilitaires $utilitaire
     * @return Response
     */
    public function edit(Request $request, Utilitaires $utilitaire): Response
    {
        $form = $this->createForm(UtilitairesType::class, $utilitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilitaires_index');
        }

        return $this->render('utilitaires/edit.html.twig', [
            'utilitaire' => $utilitaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/utilitaires/{id}", name="utilitaires_delete", methods={"DELETE"})
     * @param Request $request
     * @param Utilitaires $utilitaire
     * @return Response
     */
    public function delete(Request $request, Utilitaires $utilitaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilitaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilitaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('utilitaires_index');
    }
}
