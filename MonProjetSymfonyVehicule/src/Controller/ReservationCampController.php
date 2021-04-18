<?php

namespace App\Controller;

use App\Entity\ReservationCamp;
use App\Form\ReservationCampType;
use App\Repository\ReservationCampRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationCampController extends AbstractController
{
    /**
     * @Route("/reservationcampingcars", name="reservation_index_camp")
     * @param ReservationCampRepository $reservationRepository
     * @return Response
     */
    public function index(ReservationCampRepository $reservationRepository): Response
    {
        return $this->render('reservation_camp/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newReservationcampingcar", name="reservation_new_camping", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $reservation = new ReservationCamp();
        //$user = $this->getUser();
        $form = $this->createForm(ReservationCampType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index_camp');
        }

        return $this->render('reservation_camp/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
}
