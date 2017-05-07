<?php

namespace Domain\Item;

class FindItemsRequest
{
    private $page;
    private $limit;

    public function __construct($page = 1, $limit = 10)
    {
        $this->setPage($page);
        $this->setLimit($limit);
    }

    public function setPage($page): void
    {
        $page = intval($page);
        $this->page = $page > 0 ? $page : 1;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setLimit($limit): void
    {
        $limit = intval($limit);
        $this->limit = $limit > 0 && $limit < 100 ? $limit : 10;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
