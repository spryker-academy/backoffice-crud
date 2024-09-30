<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeGuiCommunicationFactory  getFactory()
 */
class CreateController extends AbstractController
{
    protected const ANTELOPE_GUI_URL = '/antelope-gui';
    protected const ANTELOPE_SUCCESSFULLY_CREATED = 'Antelope successfully created';


    public function indexAction(Request $request): array|RedirectResponse
    {
        $antelopeTransfer = new AntelopeTransfer();
        $options = [
            AntelopeCreateForm::LABEL_COLOR => 'Color',
            AntelopeCreateForm::LABEL_NAME => 'Name',
            AntelopeCreateForm::LABEL_GENDER => 'Gender',
            AntelopeCreateForm::LABEL_WEIGHT => 'Weight',
            AntelopeCreateForm::LABEL_AGE => 'Age',
            AntelopeCreateForm::TYPE_CHOICES => $this->getFactory()
                ->getAntelopeTypes(),
            AntelopeCreateForm::LOCATION_CHOICES => $this->getFactory()->getAntelopeLocations()
        ];

        $antelopeForm = $this->getFactory()->createAntelopeCreateForm($antelopeTransfer,
            $options)->handleRequest($request);
        if ($antelopeForm->isSubmitted() && $antelopeForm->isValid()) {
            return $this->createAntelope($antelopeForm);
        }
        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeForm->createView(),
        ]);
    }

    /**
     * @param FormInterface $antelopeForm
     * @return RedirectResponse
     */
    public function createAntelope(
        FormInterface $antelopeForm
    ): RedirectResponse {
        /**
         * @var AntelopeTransfer $antelopeTransfer
         */
        $antelopeTransfer = $antelopeForm->getData();
        // $antelopeTransfer->setTypeId(1);
        // $antelopeTransfer->setLocationId(1);
        $this->getFactory()->getAntelopeFacade()->createAntelope($antelopeTransfer);
        $this->addSuccessMessage(static::ANTELOPE_SUCCESSFULLY_CREATED);
        return $this->redirectResponse(static::ANTELOPE_GUI_URL);
    }
}
