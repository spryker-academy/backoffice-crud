<?php

declare(strict_types=1);

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
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
            $this->getFactory()->createAntelopeTable()->fetchData(),
        );
    }
}
