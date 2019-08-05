<?php

namespace App\Form;

use App\Entity\BusStation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BusStationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, ['label'=>'Address', 'required' => true, 'translation_domain' => 'messages'])
            ->add('description', TextareaType::class, ['required' => true])
            ->add('attachments', FileType::class, [
                'label'=> 'Attachments (png, jpg, jpg, bmp)',
                'multiple' => true,
                'required' => true, 'translation_domain' => 'messages'
            ])
            ->add('save', SubmitType::class,['translation_domain' => 'messages']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusStation::class,
        ]);
    }
}
