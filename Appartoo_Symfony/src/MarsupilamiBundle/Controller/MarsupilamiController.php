<?php

namespace MarsupilamiBundle\Controller;

use MarsupilamiBundle\Entity\Marsupilami;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Marsupilami controller.
 *
 */
class MarsupilamiController extends Controller
{
    /**
     * Lists all marsupilami entities.
     *
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $utilisateur=$em->getRepository("MarsupilamiBundle:Marsupilami")->find($user);

        return $this->render('marsupilami/index.html.twig', array(
            'marsupilamis' => $user,
        ));
    }

    /**
     * Finds and displays a marsupilami entity.
     *
     */
    public function showAction(Marsupilami $marsupilami)
    {

        return $this->render('marsupilami/Default:index.html.twig', array(
            'marsupilami' => $marsupilami,
        ));
    }



}
