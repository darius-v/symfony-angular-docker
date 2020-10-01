<?php

namespace App\Controller;

use App\Entity\Record;
use App\Repository\RecordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordsController extends AbstractController
{

    /** @var RecordRepository */
    private $recordRepository;

    public function __construct(/*RecordRepository $recordRepository*/)
    {
//        $this->recordRepository = $recordRepository;
    }

    /**
     * @Route("/", name="single_page")
     * @return Response
     */
    public function  singlePageAction()
    {
        return $this->render('single_page.html.twig', [

        ]);
    }

    /**
     * @Route("/list", name="list")
     * @return Response
     */
    public function listAction()
    {
        $records = $this->getDoctrine()->getRepository(Record::class)->findAll();

        $toReturn = [];
        foreach ($records as $record) {
            $toReturn[] = [
                'id' => $record->getId(),
                'name' => $record->getName(),
                'price' => $record->getPrice()
            ];
        }

        return new JsonResponse($toReturn);
    }

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