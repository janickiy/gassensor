<?php

namespace infrastructure\News\Repository;

use domain\News\DataMapper\NewsDataMapperInterface;
use domain\News\Entity\News;
use domain\News\Repository\NewsRepositoryInterface;
use infrastructure\News\ActiveRecord\NewsAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class NewsRepository extends ActiveRecordCrudRepository implements NewsRepositoryInterface
{
    public function __construct(NewsDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return NewsAR::class;
    }

    protected function entityName(): string
    {
        return 'News';
    }

    public function get(int $id): News
    {
        return $this->getEntity($id);
    }

    public function save(News $entity): News
    {
        return $this->saveEntity($entity);
    }
}
