<?php

namespace Tests\Application\Controller;

use Application\Controller\ItemController;
use Domain\Item\InMemoryItemRepository;
use Domain\Item\Item;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Tests\BaseTestCase;

class ItemControllerTest extends BaseTestCase
{
    public function testIndex()
    {
        $client = self::createClient();
        self::createSchema();
        $crawler = $client->request('GET', '/');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $crawler->filter('h1:contains("Hello World")')->count());
    }

    public function testItemListIsRendered()
    {
        self::bootKernel();
        $twig = self::$kernel->getContainer()->get('twig');
        $repository = new InMemoryItemRepository();
        $repository->save(Item::fromName('Item 1'));
        $repository->save(Item::fromName('Item 2'));
        $repository->save(Item::fromName('Item 3'));
        $repository->save(Item::fromName('Item 4'));
        $controller = new ItemController($twig, $repository);
        $response = $controller->index(new Request());
        $crawler = new Crawler($response->getContent());
        $nodeList = $crawler->filter('ul>li');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(4, $nodeList->count());
        $this->assertEquals('Item 1', $nodeList->first()->text());
        $this->assertEquals('Item 4', $nodeList->last()->text());
    }
}
