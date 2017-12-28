<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ClientController
 * @package AppBundle\Controller
 * @author Tiko Banyini
 */
class ClientController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request){
        $logger = $this->get('logger');
        $logger->info("ClientController addAction");
        $client = new Client();
        $form = $this->createForm('ClientCreateType', $client);

        $createHandler = $this->get('app.client_create.handler');
        if($createHandler->handle($form, $request)){
            return $this->redirect($this->generateUrl('app.client.edit', array('id' =>  $client->getId())).'.html');
        }
        return $this->render('@App/client/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request, $page = 1){
        $logger = $this->get('logger');
        $logger->info("ClientController listAction");
        $listHanler = $this->get("app.client_list.handler");
        $pagination = $listHanler->handle($request, $page);
        return $this->render('@App/client/list.html.twig', array(
            'action' => 'client.list',
            'pagination' => $pagination['pagination'],
            'direction' => $pagination['direction'],
            'showOptions' => $pagination['showOptions'],
            'showSelected' => $pagination['show'],
            'search' => $pagination['search'],
        ));
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Client $client){
        $logger = $this->get('logger');
        $logger->info("ClientController editAction");
        $form = $this->createForm('ClientEditType', $client);
        $editHandler = $this->get("app.client_edit.handler");
        if($editHandler->handle($form, $request)){
            return $this->redirect($this->generateUrl('app.client.list').'.html');
        }

        return $this->render('@App/client/edit.html.twig', array(
            'form' => $form->createView(),
            'client' => $client
        ));
    }

}