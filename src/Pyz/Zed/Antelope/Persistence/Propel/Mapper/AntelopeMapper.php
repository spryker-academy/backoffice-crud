<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Orm\Zed\Antelope\Persistence\Base\PyzAntelope;
use Orm\Zed\AntelopeLocation\Persistence\Base\PyzAntelopeLocation;
use Orm\Zed\AntelopeType\Persistence\PyzAntelopeType;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeMapper implements AntelopeMapperInterface
{
    public function mapAntelopeTransferToAntelopeEntity(
        AntelopeTransfer $antelopeTransfer,
        PyzAntelope $antelope,
    ): PyzAntelope {
        return $antelope->fromArray($antelopeTransfer->toArray());
    }

    public function mapAntelopeCollectionToAntelopeCollectionTransfer(
        ObjectCollection $antelopeCollection,
        AntelopeCollectionTransfer $antelopeCollectionTransfer,
    ): AntelopeCollectionTransfer {
        foreach ($antelopeCollection as $antelope) {
            $antelopeDto = $this->mapAntelopeEntityToAntelopeTransfer($antelope, new AntelopeTransfer());
            $antelopeCollectionTransfer->addAntelope($antelopeDto);
        }

        return $antelopeCollectionTransfer;
    }

    public function mapAntelopeEntityToAntelopeTransfer(
        PyzAntelope $antelope,
        AntelopeTransfer $antelopeTransfer,
    ): AntelopeTransfer {
        $antelopeTransfer->fromArray($antelope->toArray(), true);
        $type = $this->mapAntelopeTypeEntityToAntelopeTypeTransfer(
            $antelope->getPyzAntelopeType(),
            new AntelopeTypeTransfer(),
        );

        $antelopeTransfer->setType($type);
        $location = $this->mapAntelopeLocationEntityToAntelopeLocationTransfer(
            $antelope->getPyzAntelopeLocation(),
            new AntelopeLocationTransfer(),
        );

        $antelopeTransfer->setLocation($location);

        return $antelopeTransfer;
    }

    public function mapAntelopeTypeEntityToAntelopeTypeTransfer(
        PyzAntelopeType $antelopeType,
        AntelopeTypeTransfer $antelopeTypeTransfer,
    ): AntelopeTypeTransfer {
        return $antelopeTypeTransfer->fromArray($antelopeType->toArray(), true);
    }

    public function mapAntelopeLocationEntityToAntelopeLocationTransfer(
        PyzAntelopeLocation $antelopeLocation,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $antelopeLocationTransfer->fromArray($antelopeLocation->toArray(), true);
    }
}
