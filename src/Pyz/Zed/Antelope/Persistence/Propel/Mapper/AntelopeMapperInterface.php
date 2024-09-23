<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Orm\Zed\Antelope\Persistence\Base\PyzAntelope;
use Orm\Zed\AntelopeLocation\Persistence\Base\PyzAntelopeLocation;
use Orm\Zed\AntelopeType\Persistence\PyzAntelopeType;
use Propel\Runtime\Collection\ObjectCollection;

interface AntelopeMapperInterface
{
    public function mapAntelopeTransferToAntelopeEntity(
        AntelopeTransfer $antelopeTransfer,
        PyzAntelope $antelope,
    ): PyzAntelope;

    public function mapAntelopeCollectionToAntelopeCollectionTransfer(
        ObjectCollection $antelopeCollection,
        AntelopeCollectionTransfer $antelopeCollectionTransfer,
    ): AntelopeCollectionTransfer;

    public function mapAntelopeEntityToAntelopeTransfer(
        PyzAntelope $antelope,
        AntelopeTransfer $antelopeTransfer,
    ): AntelopeTransfer;

    public function mapAntelopeLocationEntityToAntelopeLocationTransfer(
        PyzAntelopeLocation $antelopeLocation,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;

    public function mapAntelopeTypeEntityToAntelopeTypeTransfer(
        PyzAntelopeType $antelopeType,
        AntelopeTypeTransfer $antelopeTypeTransfer,
    ): AntelopeTypeTransfer;
}
