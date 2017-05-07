<?php

namespace Domain\Item;

interface ItemRepository
{
    /**
     * Find many items
     *
     * @param FindItemsRequest $request
     * @return iterable
     */
    public function findMany(FindItemsRequest $request): iterable;

    /**
     * Save an item
     *
     * @param Item $item
     */
    public function save(Item $item): void;

    /**
     * Delete an item
     *
     * @param Item $item
     */
    public function delete(Item $item): void;
}
