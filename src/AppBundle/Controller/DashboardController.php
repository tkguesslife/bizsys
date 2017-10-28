<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 * @author Tiko Banyini
 */
class DashboardController extends  Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction(Request $request){
        $logger = $this->get('logger');
        $logger->info("DashboardController homeAction()");

        return $this->render('@App/dashboard/home.html.twig', array());
    }

}