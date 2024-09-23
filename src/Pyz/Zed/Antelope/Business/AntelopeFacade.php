<?php

declare(strict_types=1);

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @return  \Generated\Shared\Transfer\AntelopeCollectionTransfer
     * @api
     *
     */
    public function getAntelopeCollection(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelopeCollection($antelopeCriteriaTransfer);
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->getFactory()->createAntelopeUpdater()->updateAntelope($antelopeTransfer);
    }

    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeTransfer);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer)
    {
        return $this->getFactory()->createAntelopeDeleter()->deleteAntelope($antelopeTransfer);
    }
}
