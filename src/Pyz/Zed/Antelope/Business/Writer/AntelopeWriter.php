<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

/**
 *
 */
class AntelopeWriter implements AntelopeWriterInterface
{
    public function __construct(
        protected AntelopeEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->antelopeEntityManager->createAntelope($antelopeTransfer);
    }
}
