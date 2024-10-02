<?php

declare(strict_types=1);

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeLocation\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\AntelopeType\Persistence\Map\PyzAntelopeTypeTableMap;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    /**
     * @var string
     */
    protected const TABLE_COL_ACTION = 'Actions';

    public function __construct(protected PyzAntelopeQuery $antelopeQuery)
    {
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            PyzAntelopeTableMap::COL_IDANTELOPE => 'Id',
            PyzAntelopeTableMap::COL_NAME => 'Name',
            PyzAntelopeTableMap::COL_COLOR => 'Color',
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME => 'Location',
            PyzAntelopeTypeTableMap::COL_TYPE_NAME => 'Type',
            static::TABLE_COL_ACTION => 'Actions',
        ]);
        $config->setSortable([
            PyzAntelopeTableMap::COL_IDANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
            PyzAntelopeTableMap::COL_LOCATION_ID,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
            PyzAntelopeTypeTableMap::COL_TYPE_NAME,
        ]);
        $config->setSearchable([
            PyzAntelopeTableMap::COL_IDANTELOPE,
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
            PyzAntelopeTypeTableMap::COL_TYPE_NAME,
        ]);
        $config->addRawColumn(self::TABLE_COL_ACTION);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array<int, mixed>
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeCollection = $this->runQuery(
            $this->antelopeQuery,
            $config,
            true,
        );
        $results = [];

        foreach ($antelopeCollection as $antelopeEntity) {
            /**
             * @var \Orm\Zed\AntelopeLocation\Persistence\Base\PyzAntelopeLocation $location
             * @var \Orm\Zed\AntelopeType\Persistence\PyzAntelopeType $type
             */
            $location = $antelopeEntity->getPyzAntelopeLocation();
            $type = $antelopeEntity->getPyzAntelopeType();
            $result[PyzAntelopeTableMap::COL_IDANTELOPE] = $antelopeEntity->getIdAntelope();
            $result[PyzAntelopeTableMap::COL_COLOR] = $antelopeEntity->getColor();
            $result[PyzAntelopeTableMap::COL_NAME] = $antelopeEntity->getName();
            $result[PyzAntelopeTableMap::COL_LOCATION_ID] = $antelopeEntity->getLocationId();
            $result[PyzAntelopeLocationTableMap::COL_LOCATION_NAME] = $location->getLocationName();
            $result[PyzAntelopeTypeTableMap::COL_TYPE_NAME] = $type->getTypeName();
            $result[static::TABLE_COL_ACTION] = $this->createButtons($antelopeEntity);
            $results[] = $result;
        }

        return $results;
    }

    protected function createButtons(PyzAntelope $antelopeEntity): string
    {
        $buttons = [];
        $urlEdit = Url::generate(
            '/antelope-gui/edit',
            ['id-antelope' => $antelopeEntity->getIdantelope()],
        );
        $urlRemove = Url::generate(
            '/antelope-gui/delete',
            ['id-antelope' => $antelopeEntity->getIdantelope()],
        );
        $urlView = Url::generate(
            '/antelope-gui/view',
            ['id-antelope' => $antelopeEntity->getIdantelope()],
        );

        $buttons[] = $this->generateRemoveButton($urlRemove, 'Delete antelope');
        $buttons[] = $this->generateEditButton($urlEdit, 'Edit antelope');
        $buttons[] = $this->generateViewButton($urlView, 'View antelope');

        return implode(' ', $buttons);
    }
}
