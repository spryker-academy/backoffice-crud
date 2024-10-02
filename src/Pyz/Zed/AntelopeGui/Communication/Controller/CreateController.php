<?php

declare(strict_types=1);

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 */
class CreateController extends AbstractController
{
    /**
     * @var string
     */
    protected const ANTELOPE_GUI_URL = '/antelope-gui';

    /**
     * @var string
     */
    protected const ANTELOPE_SUCCESSFULLY_CREATED = 'Antelope successfully created';

    public function indexAction(Request $request): array|RedirectResponse
    {
        $antelopeTransfer = new AntelopeTransfer();
        $options = $this->getOptions();
        $antelopeForm = $this->getFactory()->createAntelopeCreateForm(
            $antelopeTransfer,
            $options,
        )->handleRequest($request);
        if ($antelopeForm->isSubmitted() && $antelopeForm->isValid()) {
            return $this->createAntelope($antelopeForm);
        }

        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeForm->createView(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $antelopeForm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAntelope(
        FormInterface $antelopeForm,
    ): RedirectResponse {
        /**
         * @var \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
         */
        $antelopeTransfer = $antelopeForm->getData();
        // $antelopeTransfer->setTypeId(1);
        // $antelopeTransfer->setLocationId(1);
        $this->getFactory()->getAntelopeFacade()->createAntelope($antelopeTransfer);
        $this->addSuccessMessage(static::ANTELOPE_SUCCESSFULLY_CREATED);

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
}
