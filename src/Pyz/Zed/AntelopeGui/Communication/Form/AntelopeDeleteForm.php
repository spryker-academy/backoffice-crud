<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 */
class AntelopeDeleteForm extends AbstractType
{
 /**
  * @var string
  */
    protected const DELETE_METHOD = 'DELETE';

    /**
     * @var string
     */
    protected const FIELD_ID_ANTELOPE = 'id_antelope';

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    /**
     * @return void
     */
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $builder->setMethod(static::DELETE_METHOD);
        $builder->add(static::FIELD_ID_ANTELOPE, HiddenType::class);
    }
}
