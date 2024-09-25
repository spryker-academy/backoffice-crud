<?php

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    public function __construct(protected PyzAntelopeQuery $antelopeQuery)
    {
    }

    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            PyzAntelopeTableMap::COL_IDANTELOPE => 'Id',
            PyzAntelopeTableMap::COL_NAME => 'Name',
            PyzAntelopeTableMap::COL_COLOR => 'Color',
            PyzAntelopeTableMap::COL_LOCATION_ID => 'LocationId',
        ]);
        $config->setSortable([
            PyzAntelopeTableMap::COL_IDANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
            PyzAntelopeTableMap::COL_LOCATION_ID
        ]);
        $config->setSearchable([
            PyzAntelopeTableMap::COL_IDANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR
        ]);
        return $config;
    }

    /**
     * @param TableConfiguration $config
     * @return array<int,mixed>
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeCollection = $this->runQuery($this->antelopeQuery, $config,
            true);
        $results = [];
        foreach ($antelopeCollection as $antelopeEntity) {
            $result[PyzAntelopeTableMap::COL_IDANTELOPE] = $antelopeEntity->getIdAntelope();
            $result[PyzAntelopeTableMap::COL_COLOR] = $antelopeEntity->getColor();
            $result[PyzAntelopeTableMap::COL_NAME] = $antelopeEntity->getName();
            $result[PyzAntelopeTableMap::COL_LOCATION_ID] = $antelopeEntity->getLocationId();
            $results[] = $result;
        }
        return $results;
    }
}
