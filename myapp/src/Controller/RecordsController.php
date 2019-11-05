<?php

namespace App\Controller;

use App\Entity\Record;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordsController extends AbstractController
{
    /**
     * @Route("/save", name="save")
     * @param Request $request
     * @return Response
     */
    public function save(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $content = json_decode($request->getContent(), true);

        $record = new Record();
        $record->setName($content['name']);
        $record->setPrice(rand(1, 200));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($record);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$record->getId());
    }
}