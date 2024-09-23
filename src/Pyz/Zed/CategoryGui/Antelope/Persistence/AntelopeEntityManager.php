<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeMapper;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements
    AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->createAntelopeMapper()
            ->mapAntelopeTransferToAntelopeEntity($antelopeTransfer,
                new PyzAntelope());
        $antelopeEntity->save();
        return $this->createAntelopeMapper()
            ->mapAntelopeEntityToAntelopeTransfer($antelopeEntity,
                $antelopeTransfer);
    }

    protected function createAntelopeMapper(): AntelopeMapperInterface
    {
        return new AntelopeMapper();
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()
            ->filterByIdAntelope($antelopeTransfer->getIdAntelope())->findOne();
        if (!$antelopeEntity) {
            return $antelopeTransfer;
        }
        $mapper = $this->getFactory()->createAntelopeMapper();
        $antelopeEntity = $mapper->mapAntelopeTransferToAntelopeEntity($antelopeTransfer,
            $antelopeEntity);
        $antelopeEntity->save();
        return $mapper->mapAntelopeEntityToAntelopeTransfer($antelopeEntity,
            $antelopeTransfer);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool
    {
        $antelopeEntity = $this->getFactory()->createAntelopeMapper()->mapAntelopeTransferToAntelopeEntity($antelopeTransfer,
            new PyzAntelope());
        $antelopeEntity->delete();
        return $antelopeEntity->isDeleted();
    }
}
