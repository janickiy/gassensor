<?php

namespace application\Redirect\Service;

use application\Redirect\Form\RedirectFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Redirect\DataMapper\RedirectDataMapperInterface;
use domain\Redirect\Repository\RedirectRepositoryInterface;

class RedirectService extends CrudService
{
    public function __construct(
        RedirectRepositoryInterface $repository,
        RedirectDataMapperInterface $dataMapper,
        RedirectFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
