<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordsController
{
    /**
     * @Route("/save", name="save")
     */
    public function save()
    {
        $number = 1;

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}