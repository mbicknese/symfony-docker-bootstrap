<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository
{
    /**
     * @param iterable $items
     */
    public function saveMany(iterable $items): void
    {
        $manager = $this->getEntityManager();

        foreach ($items as $item) {
            $manager->persist($item);
        }

        $manager->flush();
    }
}
