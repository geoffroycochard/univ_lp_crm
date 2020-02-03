<?php

namespace App\Form;

use App\DBAL\EnumStatusType;
use App\Entity\Opportunity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpportunityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('topic')
            ->add('date')
            ->add('status', ChoiceType::class, [
                'choices' => EnumStatusType::getValuesForm()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Opportunity::class,
        ]);
    }
}
