<?php


namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class UserController
 * @package AppBundle\Controller
 * @author Tiko Banyini
 */
class UserController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(Request $request, User $user){
        $logger = $this->get('logger');
        $logger->info("DashboardController homeAction()");

        $profileForm = $this->createForm('PartyShowType', $user);
        return $this->render('@App/user/profile.html.twig', array(
            'form' => $profileForm->createView()
        ));
    }

}