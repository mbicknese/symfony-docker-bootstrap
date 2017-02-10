<?php

namespace App\Controller;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Registry;
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
     * @param Registry $doctrine
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
        $items = $this->doctrine->getManager()->getRepository(Item::class)
            ->findAll();

        return new Response(
            $this->twig->render(':Default:index.html.twig', compact('items'))
        );
    }
}
