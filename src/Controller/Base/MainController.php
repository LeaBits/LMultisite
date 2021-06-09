<?php

namespace App\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(
     *     name="catchAll",
     *     host="{host}",
     *     "/{path}",
     *     defaults={"host"="", "path"=""},
     *     requirements={"host"=".+", "path"=".+"}
     * )
     */
    public function catchAllAction($host, $path): Response
    {
        dump($host);
        dump($path);

        return $this->render('base/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
