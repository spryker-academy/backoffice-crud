<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function deleteAntelope(
        AntelopeTransfer $antelopeTransfer
    ): bool;
}
