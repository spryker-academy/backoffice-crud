<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @return non-empty-array<string,\Generated\Shared\Transfer\AntelopeTransfer>
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class IndexController extends AbstractController
{
    /**
     * @return array<string, mixed>
     */
    public function indexAction(): array
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopes = $this->getFacade()->getAntelopeCollection($antelopeCriteriaTransfer)->getAntelopes();

        return $this->viewResponse(['antelopes' => $antelopes]);
    }
}
