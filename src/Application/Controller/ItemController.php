<?php

namespace Application\Controller;

use Domain\Item\FindItemsRequest;
use Domain\Item\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class ItemController
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * DefaultController constructor.
     *
     * @param Twig_Environment $twig
     * @param ItemRepository $itemRepository
     */
    public function __construct(Twig_Environment $twig, ItemRepository $itemRepository)
    {
        $this->twig = $twig;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $items = $this->itemRepository->findMany(new FindItemsRequest(
            $request->query->get('page')
        ));

        return new Response(
            $this->twig->render('Item/index.html.twig', compact('items'))
        );
    }
}
