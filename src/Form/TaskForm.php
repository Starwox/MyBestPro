<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 06/02/2020
 * Time: 01:38
 */

namespace App\Form;


use App\Entity\Status;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [ 'placeholder' => 'Titre' ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [ 'placeholder' => 'Description' ]
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name'
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}