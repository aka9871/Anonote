<?php

namespace Remarque\NoteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Remarque\NoteBundle\Form\ParticipantType;


class RemarqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre');
        $builder->add('contenu', 'textarea');
        $builder->add('email');
       

        
        $builder->add('participants', 'collection', array(
        'type' => new ParticipantType(),
        'allow_add' => true,
        'by_reference' => false,
    ));
     $builder->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Remarque\NoteBundle\Entity\Remarque',
        ));
    }

    public function getName()
    {
        return 'Remarque';
    }
}