<?php

namespace Pyz\Zed\Antelope\Business\Updater;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        protected AntelopeEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->antelopeEntityManager->updateAntelope($antelopeTransfer);
    }
}
