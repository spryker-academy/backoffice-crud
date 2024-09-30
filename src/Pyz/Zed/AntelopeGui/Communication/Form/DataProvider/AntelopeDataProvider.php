<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;

class AntelopeDataProvider
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade
    ) {
    }

    public function getData(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        return $this->antelopeFacade->getAntelopeCollection($antelopeCriteriaTransfer)
            ->getAntelopes()->getIterator()->current();
    }

    /**
     * @param array $types <int,string>
     * @param array $locations <int,string>
     * @return array<string,mixed>
     */
    public function getOptions(array $types, array $locations): array
    {
        return [
            AntelopeCreateForm::LABEL_COLOR => 'Color',
            AntelopeCreateForm::LABEL_NAME => 'Name',
            AntelopeCreateForm::LABEL_GENDER => 'Gender',
            AntelopeCreateForm::LABEL_WEIGHT => 'Weight',
            AntelopeCreateForm::LABEL_AGE => 'Age',
            AntelopeCreateForm::TYPE_CHOICES => $types,
            AntelopeCreateForm::LOCATION_CHOICES => $locations
        ];
    }
}
