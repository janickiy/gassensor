<?php

namespace application\Url\Service;

use application\Shared\Service\CrudService;
use application\Url\Form\UrlFormModelProviderInterface;
use domain\Url\DataMapper\UrlDataMapperInterface;
use domain\Url\Repository\UrlRepositoryInterface;

class UrlService extends CrudService
{
    public function __construct(
        UrlRepositoryInterface $repository,
        UrlDataMapperInterface $dataMapper,
        UrlFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
