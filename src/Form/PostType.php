<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'trim' => true,
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'trim' => true,
            ])

            ->add('published', TextareaType::class, [
                'required' => false,
                'trim' => true,
            ])
            ->add('tags' , EntityType::class, [
                'class' => Tag::class,
                'required' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
