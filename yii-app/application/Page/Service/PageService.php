<?php

namespace application\Page\Service;

use application\Page\Form\PageFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Page\DataMapper\PageDataMapperInterface;
use domain\Page\Repository\PageRepositoryInterface;

class PageService extends CrudService
{
    public function __construct(
        PageRepositoryInterface $repository,
        PageDataMapperInterface $dataMapper,
        PageFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
