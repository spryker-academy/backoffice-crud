<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    protected const FIELD_LOCATION = 'location_id';
    protected const FIELD_NAME = 'name';
    protected const FIELD_COLOR = 'color';
    protected const FIELD_GENDER = 'gender';
    protected const FIELD_WEIGHT = 'weight';
    protected const FIELD_TYPE = 'type_id';
    protected const FIELD_AGE = 'age';

    public const LABEL_AGE = 'Age';
    public const LABEL_NAME = 'Name';
    public const LABEL_GENDER = 'Gender';
    public const LABEL_WEIGHT = 'Weight';
    public const LABEL_LOCATION = 'Location';
    public const LABEL_TYPE = 'Type';
    public const LABEL_COLOR = 'Color';
    public const TYPE_CHOICES = 'types';
    public const LOCATION_CHOICES = 'locations';

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined([
            static::LABEL_COLOR,
            static::LABEL_AGE,
            static::LABEL_NAME,
            static::LABEL_GENDER,
            static::LABEL_WEIGHT,
            static::LABEL_LOCATION,
            static::LABEL_TYPE,
            static::TYPE_CHOICES,
            static::LOCATION_CHOICES,
        ]);
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
    }

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->addFieldColor($builder, $options)
            ->addFieldName($builder, $options)
            ->addFieldGender($builder, $options)
            ->addFieldWeight($builder, $options)
            ->addFieldAge($builder, $options)
            ->addFieldType($builder, $options)
            ->addFieldLocation($builder, $options);
    }

    protected function addFieldName(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => $options[static::LABEL_NAME] ?? self::LABEL_NAME,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldColor(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_COLOR, TextType::class, [
            'label' => $options[static::LABEL_COLOR] ?? self::LABEL_COLOR,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldWeight(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_WEIGHT, TextType::class, [
            'label' => $options[static::LABEL_WEIGHT] ?? self::LABEL_WEIGHT,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldGender(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_GENDER, TextType::class, [
            'label' => $options[static::LABEL_GENDER] ?? self::LABEL_GENDER,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldAge(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_AGE, TextType::class, [
            'label' => $options[static::LABEL_AGE] ?? self::LABEL_AGE,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldType(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_TYPE, ChoiceType::class, [
            'label' => $options[static::LABEL_TYPE] ?? self::LABEL_TYPE,
            'required' => true,
            'placeholder' => '-select-',
            'choices' => array_flip($options[static::TYPE_CHOICES] ?? []),
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    protected function addFieldLocation(
        FormBuilderInterface $builder,
        array $options
    ): static {
        $builder->add(static::FIELD_LOCATION, ChoiceType::class, [
            'label' => $options[static::LABEL_LOCATION] ?? self::LABEL_LOCATION,
            'required' => true,
            'placeholder' => '-select-',
            'choices' => array_flip($options[static::LOCATION_CHOICES] ?? []),
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }
}
