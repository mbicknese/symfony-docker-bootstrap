<?php

namespace Domain\Item;

class InMemoryItemRepository implements ItemRepository
{
    private $stack = [];

    public function findMany(FindItemsRequest $request): iterable
    {
        return $this->stack;
    }

    public function save(Item $item): void
    {
        if (!in_array($item, $this->stack)) {
            $this->stack[] = $item;
        }
    }

    public function delete(Item $item): void
    {
        if (($key = array_search($item, $this->stack)) !== false) {
            unset($this->stack[$key]);
        }
    }
}
