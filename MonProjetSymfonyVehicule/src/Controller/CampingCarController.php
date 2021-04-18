<?php

namespace App\Controller;

use App\Entity\CampingCar;
use App\Form\CampingCarType;
use App\Form\RechercheCampingCarType;
use App\Repository\CampingCarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CampingCarController extends AbstractController
{

    /**
     * @Route("/campingcarRecherche", name="campingcar_recherche", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function rechercheCampingcar(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $camping_car=$em->getRepository(CampingCar::class)->findAll();
        if($request->isMethod("POST"))
        {
            $marque = $request->get('marque');
            $camping_car = $em->getRepository(CampingCar::class)->searchCampingCar2(array('marque'=>$marque));
        }

        return $this->render('camping_car/campingcarRecherche.html.twig',array('camping_car'=>$camping_car));
    }

    /**
     * @Route("/campingcarRechercheAvancee", name="campingcar_rechercheAvancee")
     * @param Request $request
     * @param CampingCarRepository $campingcarsRepository
     * @return Response
     */
    public function rechercheAvancee(Request $request, CampingCarRepository $campingcarsRepository): Response
    {
        $campingcars = [];
        $searchCampingCarForm = $this->createForm(RechercheCampingCarType::class);

        if($searchCampingCarForm->handleRequest($request)->isSubmitted() && $searchCampingCarForm->isValid()){
            $criteria = $searchCampingCarForm->getData();

            $campingcars = $campingcarsRepository->searchCampingCar($criteria);

            //dd($campingcars);  pour dump(voir contenu)
        }
        return $this->render('camping_car/campingcarRechercheAvancce.html.twig', [
            'search_form' => $searchCampingCarForm->createView(),
            'campingcars' => $campingcars,
        ]);
    }

    /**
     * @Route("/campingcar", name="camping_car_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(CampingCar::class)->findAll();

        $camping_cars = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),6
        );
        return $this->render('camping_car/index.html.twig', [
            'camping_cars' =>$camping_cars
        ]);
    }

    /**
     * @Route("/newcampingcar", name="camping_car_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $campingCar = new CampingCar();
        $form = $this->createForm(CampingCarType::class, $campingCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campingCar);
            $entityManager->flush();

            return $this->redirectToRoute('camping_car_index');
        }

        return $this->render('camping_car/new.html.twig', [
            'camping_car' => $campingCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/campingcar/{id}", name="camping_car_show", methods={"GET"})
     */
    public function show(CampingCar $campingCar): Response
    {
        return $this->render('camping_car/show.html.twig', [
            'camping_car' => $campingCar,
        ]);
    }

    /**
     * @Route("/campingcar/{id}/edit", name="camping_car_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CampingCar $campingCar): Response
    {
        $form = $this->createForm(CampingCarType::class, $campingCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('camping_car_index');
        }

        return $this->render('camping_car/edit.html.twig', [
            'camping_car' => $campingCar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/campingcar/{id}", name="camping_car_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CampingCar $campingCar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campingCar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campingCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('camping_car_index');
    }
}
