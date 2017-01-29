<?php

namespace App\Controller;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * DefaultController constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig, Registry $doctrine)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    /**
     * @return Response
     */
    public function index()
    {
        // test connection
        $this->doctrine->getManager()->getConnection()->connect();

        return new Response(
            $this->twig->render(':Default:index.html.twig')
        );
    }
}
