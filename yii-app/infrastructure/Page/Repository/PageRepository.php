<?php

namespace infrastructure\Page\Repository;

use domain\Page\DataMapper\PageDataMapperInterface;
use domain\Page\Entity\Page;
use domain\Page\Repository\PageRepositoryInterface;
use infrastructure\Page\ActiveRecord\PageAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class PageRepository extends ActiveRecordCrudRepository implements PageRepositoryInterface
{
    public function __construct(PageDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return PageAR::class;
    }

    protected function entityName(): string
    {
        return 'Page';
    }

    public function get(int $id): Page
    {
        return $this->getEntity($id);
    }

    public function save(Page $entity): Page
    {
        return $this->saveEntity($entity);
    }
}
