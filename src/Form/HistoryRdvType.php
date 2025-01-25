<?php

namespace App\Form;

use App\Entity\HistoryRdv;
use App\Entity\PatientAccount;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoryRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('horaires')
            ->add('motif')
            ->add('nomPatient')
            ->add('conclusionDuMedecin')
            ->add('id_history', EntityType::class, [
                'class' => PatientAccount::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoryRdv::class,
        ]);
    }
}
