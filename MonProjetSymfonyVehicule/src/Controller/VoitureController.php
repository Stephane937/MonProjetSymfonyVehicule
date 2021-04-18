<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\CampingCarRepository;
use App\Repository\VoitureRepository;
use App\Repository\UtilitairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VoitureController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @param VoitureRepository $voitureRepository
     * @param UtilitairesRepository $utilitaireRepository
     * @param CampingCarRepository $camping_carRepository
     * @return Response
     */
    public function accueil(VoitureRepository $voitureRepository, UtilitairesRepository $utilitaireRepository, CampingCarRepository $camping_carRepository ): Response
    {
        return $this->render('accueil.html.twig', [
            'voitures' => $voitureRepository->findAll(),
            'utilitaires' => $utilitaireRepository->findAll(),
            'camping_cars' => $camping_carRepository->findAll(),
        ]);

    }

    /**
     * @Route("/voitureRecherche", name="voiture_recherche", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function rechercheVoiture(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository(Voiture::class)->findAll();
        if($request->isMethod("POST"))
        {
            $marque = $request->get('marque');
            $voiture = $em->getRepository(Voiture::class)->searchcar2(array('marque'=>$marque));
        }

        return $this->render('voiture/voitureRecherche.html.twig',array('voiture'=>$voiture));
    }

    /**
     * @Route("/voitureRechercheAvancee", name="voiture_rechercheAvancee")
     * @param Request $request
     * @param VoitureRepository $carsRepository
     * @return Response
     */
    public function rechercheAvancee(Request $request, VoitureRepository $carsRepository): Response
    {
        $cars = [];
        $searchCarForm = $this->createForm(RechercheVoitureType::class);

        if($searchCarForm->handleRequest($request)->isSubmitted() && $searchCarForm->isValid()){
            $criteria = $searchCarForm->getData();

            $cars = $carsRepository->searchCar($criteria);

            //dd($cars);  pour dump(voir contenu)
        }
        return $this->render('voiture/voitureRechercheAvancce.html.twig', [
            'search_form' => $searchCarForm->createView(),
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/voiture", name="voiture_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Voiture::class)->findAll();

        $voitures = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),6
        );

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,

        ]);
    }

    /**
     * @Route("/new", name="voiture_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voiture_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Voiture $voiture
     * @return Response
     */
    public function edit(Request $request, Voiture $voiture): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_delete", methods={"DELETE"})
     * @param Request $request
     * @param Voiture $voiture
     * @return Response
     */
    public function delete(Request $request, Voiture $voiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index');
    }


}
