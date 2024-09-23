<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\ActiveQuery\Criteria as CriteriaAlias;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
    public function getAntelopeCollection(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        $antelopeEntities = $this->getFactory()->createAntelopeQuery();
        $antelopeEntities->joinWithPyzAntelopeLocation()
            ->joinWithPyzAntelopeType();
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $paginationTransfer = $antelopeCriteriaTransfer->getPagination();
        $this->applySearch($antelopeEntities, $antelopeCriteriaTransfer);
        $this->applySorting($antelopeEntities, $antelopeCriteriaTransfer);
        if ($paginationTransfer) {
            $this->applyPagination($paginationTransfer, $antelopeEntities);
        }
        $antelopeCollectionTransfer->setPagination($paginationTransfer);

        $antelopeCollection = $antelopeEntities->find();

        return $this->getFactory()->createAntelopeMapper()
            ->mapAntelopeCollectionToAntelopeCollectionTransfer(
                $antelopeCollection,
                $antelopeCollectionTransfer,
            );
    }


    private function applySearch(
        PyzAntelopeQuery $antelopeEntities,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): void {
        $antelopeConditions = $antelopeCriteriaTransfer->getAntelopeConditions();
        if (!$antelopeConditions) {
            return;
        }
        if ($idAntelope = $antelopeConditions->getIdAntelope()) {
            $antelopeEntities->_or()->filterByIdantelope($idAntelope);
        }
        if ($name = $antelopeConditions->getName()) {
            $likePattern = "%$name%";
            $antelopeEntities->_or()->filterByName_Like($likePattern);
        }
        if ($antelopeIds = $antelopeConditions->getAntelopeIds()) {
            $antelopeEntities->_or()->filterByIdantelope_In($antelopeIds);
        }
        if ($idLocation = $antelopeConditions->getLocationId()) {
            $antelopeEntities->_or()->filterByLocationId($idLocation);
        }
        if ($idType = $antelopeConditions->getTypeId()) {
            $antelopeEntities->_or()->filterByTypeId($idType);
        }
    }


    protected function applySorting(
        PyzAntelopeQuery $antelopeEntities,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): void {
        foreach ($antelopeCriteriaTransfer->getSortCollection() as $sortTransfer) {
            $columnName = $sortTransfer->getField();
            $order = $sortTransfer->getIsAscending() ? CriteriaAlias::ASC : CriteriaAlias::DESC;
            $antelopeEntities->orderBy($columnName, $order);
        }
    }

    
    private function applyPagination(
        PaginationTransfer $paginationTransfer,
        PyzAntelopeQuery $antelopeEntities,
    ): void {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() > 0) {
            $paginationTransfer->setNbResults($antelopeEntities->count());
            $antelopeEntities->setOffset(+$paginationTransfer->getOffset());
            $antelopeEntities->setLimit(+$paginationTransfer->getLimit());

            return;
        }
        if ($paginationTransfer->getPage() !== null && $paginationTransfer->getMaxPerPage()) {
            $pager = $antelopeEntities->paginate(
                $paginationTransfer->getPage(),
                $paginationTransfer->getMaxPerPage(),
            );
            $paginationTransfer->setNbResults($pager->getNbResults())
                ->setFirstIndex($pager->getFirstIndex())
                ->setLastIndex($pager->getLastIndex())
                ->setNextPage($pager->getNextPage())
                ->setPreviousPage($pager->getPreviousPage())
                ->setFirstPage($pager->getFirstPage())
                ->setLastPage($pager->getLastPage());
        }
    }
}
