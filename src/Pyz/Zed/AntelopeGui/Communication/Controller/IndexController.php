<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method AntelopeGuiCommunicationFactory  getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction(): array
    {
        $table = $this->getFactory()->createAntelopeTable();
        return $this->viewResponse(
            ['antelopeTable' => $table->render()],
        );
    }

    public function tableAction(): JsonResponse
    {
        return $this->jsonResponse(
            $this->getFactory()->createAntelopeTable()->fetchData()
        );
    }
}
