<?php

namespace application\Seo\Service;

use application\Seo\Form\SeoFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Seo\DataMapper\SeoDataMapperInterface;
use domain\Seo\Repository\SeoRepositoryInterface;

class SeoService extends CrudService
{
    public function __construct(
        SeoRepositoryInterface $repository,
        SeoDataMapperInterface $dataMapper,
        SeoFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
