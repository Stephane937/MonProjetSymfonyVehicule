<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\ReservationUtil;
use App\Entity\Voiture;
use App\Entity\Utilisateur;
use App\Form\ReservationType;
use App\Form\ReservationUtilType;
use App\Repository\ReservationUtilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ReservationUtilController extends AbstractController
{
    /**
     * @Route("/reservationutilitaire", name="reservation_index_util", methods={"GET"})
     * @param ReservationUtilRepository $reservationRepository
     * @return Response
     */
    public function index(ReservationUtilRepository $reservationRepository): Response
    {
        return $this->render('reservation_util/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newReservationutilitaire", name="reservation_new_util", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $reservation = new ReservationUtil();
        //$user = $this->getUser();
        $form = $this->createForm(ReservationUtilType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index_util');
        }

        return $this->render('reservation_util/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }


}
