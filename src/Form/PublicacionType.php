<?php

namespace App\Form;

use App\Entity\Publicacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imagen',FileType::class,
                ['label' => 'Seleccione una imagen',
                'mapped' => false,
                'required' => false])
            ->add('titulo')
            ->add('descripcion', TextareaType::class)
            ->add('Guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publicacion::class,
        ]);
    }
}
