<?php

namespace Tests\Infrastructure\Doctrine\Repository;

use Domain\Item\Item;
use Tests\BaseTestCase;

class DoctrineItemRepository extends BaseTestCase
{
    public function testPersist()
    {
        self::bootKernel();
        self::createSchema();
        $manager = static::$kernel->getContainer()->get('doctrine')->getManager();

        $item = Item::fromName('Test');
        $manager->persist($item);
        $manager->flush();

        $this->assertEquals(1, $item->getId());
        $this->assertSame('Test', $item->getName());
    }
}
