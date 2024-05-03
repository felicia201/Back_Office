<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('client_nom')
            ->add('client_adresse')
            ->add('client_email')
            ->add('date_devis')
            ->add('montant_total')
            ->add('description')
            ->add('duree_validite')
            ->add('statut')
            ->add('termes_conditions')
            ->add('informations_supplementaires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
