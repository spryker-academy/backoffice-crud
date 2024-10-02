<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 */
class DeleteController extends AbstractController
{
    /**
     * @var string
     */
    protected const ANTELOPE_GUI_URL = '/antelope-gui';

    /**
     * @var string
     */
    protected const ANTELOPE_SUCCESSFULLY_DELETED = 'Antelope successfully deleted';

    /**
     * @var string
     */
    protected const ANTELOPE_BADREQUEST_MESSAGE = 'Wrong id antelope';

    /**
     * @var string
     */
    protected const URL_PARAM_ID_ANTELOPE = 'id-antelope';

    public function indexAction(Request $request): array
    {
        $idAntelope = $this->getIdAntelope($request);
        if (!$idAntelope) {
            return $this->redirectWithError();
        }

        $antelopeConditions = new AntelopeConditionTransfer();
        $antelopeConditions->setIdAntelope($idAntelope);
        $antelopeCriteria = new AntelopeCriteriaTransfer();
        $antelopeCriteria->setAntelopeConditions($antelopeConditions);
        $antelopeTransfer = $this->getFactory()->createAntelopeDataProvider()->getData($antelopeCriteria);

        $antelopeForm = $this->getFactory()->createAntelopeDeleteForm(
            $antelopeTransfer,
            [],
        )->handleRequest($request);
        if ($antelopeForm->isSubmitted() && $antelopeForm->isValid()) {
            return $this->deleteAntelope($antelopeForm);
        }

        return $this->viewResponse([
            'antelope' => $antelopeTransfer,
            'antelopeDeleteForm' => $antelopeForm->createView(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $antelopeForm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAntelope(
        FormInterface $antelopeForm,
    ): RedirectResponse {
        /**
         * @var \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
         */
        $antelopeTransfer = $antelopeForm->getData();
        // $antelopeTransfer->setTypeId(1);
        // $antelopeTransfer->setLocationId(1);
        $res = $this->getFactory()->getAntelopeFacade()->deleteAntelope($antelopeTransfer);
        if ($res) {
            $this->addSuccessMessage(static::ANTELOPE_SUCCESSFULLY_DELETED);
        } else {
            $this->addErrorMessage(static::ANTELOPE_BADREQUEST_MESSAGE);
        }

        return $this->redirectResponse(static::ANTELOPE_GUI_URL);
    }

    /**
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        $types = $this->getFactory()->getAntelopeTypes();
        $locations = $this->getFactory()->getAntelopeLocations();

        return $this->getFactory()->createAntelopeDataProvider()
            ->getOptions($types, $locations);
    }

    protected function getIdAntelope(Request $request): int
    {
        return $request->query->getInt(static::URL_PARAM_ID_ANTELOPE);
    }

    protected function redirectWithError(): RedirectResponse
    {
        $this->addErrorMessage(static::ANTELOPE_BADREQUEST_MESSAGE);

        return $this->redirectResponse(static::ANTELOPE_GUI_URL);
    }
}
