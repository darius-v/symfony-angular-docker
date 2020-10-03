<?php

namespace App\Controller;

use App\Entity\Record;
use App\Repository\RecordRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordsController extends AbstractController
{
    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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
            $toReturn[] = $this->recordToArray($record);
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
        $this->logger->critical('gaidys');
//        die('gaidsizii');
        $record->setName($content['name']);
        $record->setPrice(rand(1, 200));
//        die('bas');
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($record);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

//        return new JsonResponse($this->recordToArray($record));
//        echo $record->getId();die;
        echo 'kas per sudass';
        return new JsonResponse($this->recordToArray($record));
    }

    private function recordToArray(Record $record)
    {
        return [
            'id' => $record->getId(),
            'name' => $record->getName(),
            'price' => $record->getPrice()
        ];
    }
}