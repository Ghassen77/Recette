<?php

namespace App\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecetteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('aliments', 'choice', array(
                'multiple' => true,
                'expanded' => true,
                'choices' => array(
                    'farine' => 'farine' , 
                    'oeuf' => 'oeuf', 
                    'sucre' => 'sucre', 
                    'poisson' => 'poisson'
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Bundle\Entity\Recette'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_bundle_recette';
    }
}
