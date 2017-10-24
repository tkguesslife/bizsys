<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 * @author Tiko Banyini
 */
class SecurityController extends Controller
{
    /**
     * @author Tiko Banyini <admin@tkbean.co.za>
     */
    public function loginAction(Request $request){

        $this->get('logger')->info('SecurityController loginAction()');
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:security:login.html.twig', array(
            'error' => $error
        ));
    }

}