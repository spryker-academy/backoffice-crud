<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeGuiCommunicationFactory  getFactory()
 */
class EditController extends AbstractController
{
    protected const ANTELOPE_GUI_URL = '/antelope-gui';
    protected const ANTELOPE_SUCCESSFULLY_UPDATE = 'Antelope successfully updated';
    protected const ANTELOPE_BADREQUEST_MESSAGE = 'Wrong id antelope';


    protected const URL_PARAM_ID_ANTELOPE = 'id-antelope';

    /**
     * @param Request $request
     * @return array<string,string>|RedirectResponse
     */

    public function indexAction(
        Request $request
    ): array|RedirectResponse {
        $idAntelope = $this->getIdAntelope($request);
        if (!$idAntelope) {
            return $this->redirectWithError();
        }

        $antelopeConditions = new AntelopeConditionTransfer();
        $antelopeConditions->setIdAntelope($idAntelope);
        $antelopeCriteria = new AntelopeCriteriaTransfer();
        $antelopeCriteria->setAntelopeConditions($antelopeConditions);
        $antelopeTransfer = $this->getFactory()->createAntelopeDataProvider()->getData($antelopeCriteria);
        $options = $this->getOptions();
        $antelopeForm = $this->getFactory()->createAntelopeCreateForm($antelopeTransfer,
            $options)->handleRequest($request);
        if ($antelopeForm->isSubmitted() && $antelopeForm->isValid()) {
            return $this->updateAntelope($antelopeForm);
        }
        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeForm->createView(),
        ]);
    }

    /**
     * @param FormInterface $antelopeForm
     * @return RedirectResponse
     */
    public function updateAntelope(
        FormInterface $antelopeForm
    ): RedirectResponse {
        /**
         * @var AntelopeTransfer $antelopeTransfer
         */
        $antelopeTransfer = $antelopeForm->getData();
        // $antelopeTransfer->setTypeId(1);
        // $antelopeTransfer->setLocationId(1);
        $this->getFactory()->getAntelopeFacade()->updateAntelope($antelopeTransfer);
        $this->addSuccessMessage(static::ANTELOPE_SUCCESSFULLY_UPDATE);
        return $this->redirectResponse(static::ANTELOPE_GUI_URL);
    }

    /**
     * @return mixed[]
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
