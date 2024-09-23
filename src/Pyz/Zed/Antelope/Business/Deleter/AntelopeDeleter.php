<?php

namespace Pyz\Zed\Antelope\Business\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeDeleter implements AntelopeDeleterInterface
{
    public function __construct(
        protected readonly AntelopeEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool
    {
        return $this->antelopeEntityManager->deleteAntelope($antelopeTransfer);
    }

}
