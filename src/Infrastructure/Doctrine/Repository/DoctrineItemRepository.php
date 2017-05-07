<?php

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Item\FindItemsRequest;
use Domain\Item\Item;
use Domain\Item\ItemRepository;

class DoctrineItemRepository implements ItemRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findMany(FindItemsRequest $request): iterable
    {
        $qb = $this->em->createQueryBuilder()
            ->select('p')
            ->from(Item::class, 'p');

        // paginate
        $qb->setFirstResult($request->getLimit() * ($request->getPage()-1));
        $qb->setMaxResults($request->getLimit());

        // order
        $qb->orderBy('p.name');

        return new Paginator($qb->getQuery(), false);
    }

    public function save(Item $item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function delete(Item $item): void
    {
        $this->em->remove($item);
        $this->em->flush();
    }
}
