<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction(): array
    {
        return $this->viewResponse(
            ['antelopeTable' => []],
        );
    }
}
