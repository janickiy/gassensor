<?php

namespace application\News\Service;

use application\News\Form\NewsFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\News\DataMapper\NewsDataMapperInterface;
use domain\News\Repository\NewsRepositoryInterface;

class NewsService extends CrudService
{
    public function __construct(
        NewsRepositoryInterface $repository,
        NewsDataMapperInterface $dataMapper,
        NewsFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
