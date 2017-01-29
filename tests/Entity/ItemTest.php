<?php

namespace App\Tests\Entity;

use App\AppKernel;
use App\Entity\Item;
use App\Tests\BaseTestCase;

class ItemTest extends BaseTestCase
{
    public function testPersist()
    {
        /** @var AppKernel $kernel */
        self::bootKernel();
        $manager = static::$kernel->getContainer()->get('doctrine')->getManager();

        $item = new Item();
        $item->setName('Test');
        $manager->persist($item);
        $manager->flush();

        $this->assertEquals(1, $item->getId());
        $this->assertSame('Test', $item->getName());
    }
}
