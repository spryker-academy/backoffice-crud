<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeLocation\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeType\Persistence\Map\PyzAntelopeTypeTableMap;
use Orm\Zed\AntelopeType\Persistence\PyzAntelopeTypeQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\AntelopeGuiDependencyProvider;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Pyz\Zed\AntelopeGui\Communication\Form\DataProvider\AntelopeDataProvider;
use Pyz\Zed\AntelopeGui\Communication\Table\AntelopeTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;


class AntelopeGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAntelopeTable(): AntelopeTable
    {
        return new AntelopeTable($this->getAntelopePropelQuery());
    }

    public function getAntelopePropelQuery(): PyzAntelopeQuery
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::PROPEL_QUERY_ANTELOPE);
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE);
    }

    protected function createAntelopeTypeQuery(): PyzAntelopeTypeQuery
    {
        return PyzAntelopeTypeQuery::create();
    }

    protected function createAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return PyzAntelopeLocationQuery::create();
    }

    public function getAntelopeTypes(): array
    {
        $types = $this->createAntelopeTypeQuery()
            ->orderBy(PyzAntelopeTypeTableMap::COL_TYPE_NAME)
            ->find();
        $result = [];
        foreach ($types as $type) {
            $result[$type->getIdantelopetype()] = $type->getTypeName();
        }
        return $result;
    }

    public function getAntelopeLocations(): array
    {
        $types = $this->createAntelopeLocationQuery()
            ->orderBy(PyzAntelopeLocationTableMap::COL_LOCATION_NAME)
            ->find();
        $result = [];
        foreach ($types as $type) {
            $result[$type->getIdantelopelocation()] = $type->getLocationName();
        }
        return $result;
    }

    public function createAntelopeCreateForm(
        AntelopeTransfer $antelopeTransfer,
        array $options = []
    ): FormInterface {
        return $this->getFormFactory()->create(AntelopeCreateForm::class,
            $antelopeTransfer, $options);
    }

    public function createAntelopeDataProvider(): AntelopeDataProvider
    {
        return new AntelopeDataProvider($this->getAntelopeFacade());
    }
}
