<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    /**
     * @param \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface $antelopeRepository
     */
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeCollectionTransfer
     */
    public function getAntelopeCollection(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeCollectionTransfer {
        return $this->antelopeRepository
            ->getAntelopeCollection($antelopeCriteriaTransfer);
    }
}
