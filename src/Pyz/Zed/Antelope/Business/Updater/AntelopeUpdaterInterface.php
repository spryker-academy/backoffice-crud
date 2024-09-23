<?php

namespace Pyz\Zed\Antelope\Business\Updater;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeUpdaterInterface
{
    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

}
