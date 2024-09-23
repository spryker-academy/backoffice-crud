<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeFacadeInterface
{
    /**
     * @return \Pyz\Zed\Antelope\Business\AntelopeCollectionTransfer
     * @api
     *
     */
    public function getAntelopeCollection(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer;

    public function createAntelope(
        AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer);

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer);
}
