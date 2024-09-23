<?php

namespace Pyz\Zed\Antelope\Business\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeDeleterInterface
{
    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool;
}
