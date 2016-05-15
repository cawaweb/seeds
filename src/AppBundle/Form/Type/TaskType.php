<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManager;

class TaskType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class, ['years' => range(date('Y'), date('Y') + 10)]);
        $builder->add('description', TextareaType::class);
        $builder->add('establishment', EntityType::class, [
            'class'       => 'AppBundle:Establishment',
            'placeholder' => '',
        ]);
        $builder->add('lot', EntityType::class, [
            'class'       => 'AppBundle:Lot',
            'placeholder' => ''
        ]);

        $lotModifier = function ($form, $establishmentId = null) {
            $lots = null === $establishmentId ? [] : $this->em->getRepository('AppBundle:Lot')->findByestablishmentid($establishmentId);

            $form->add('lot', EntityType::class, [
                'class'       => 'AppBundle:Lot',
                'placeholder' => '',
                'choices'     => $lots
            ]);
        };

        $sectorModifier = function ($form, $lotId = null) {
            $sectors = null === $lotId ? [] : $this->em->getRepository('AppBundle:Sector')->findBylotid($lotId);

            $form->add('sector', EntityType::class, [
                'class'       => 'AppBundle:Sector',
                'placeholder' => '',
                'choices'     => $sectors
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($lotModifier, $sectorModifier) {
                $data = $event->getData();
                $establishmentId = $data->getEstablishment() != null ? $data->getEstablishment()->getEstablishmentid() : null;
                $lotId = $data->getLot() != null ? $data->getLot()->getLotid() : null;

                $lotModifier($event->getForm(), $establishmentId);
                $sectorModifier($event->getForm(), $lotId);
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($lotModifier, $sectorModifier) {
                $data = $event->getData();
                $lotModifier($event->getForm(), $data['establishment']);
                if (isset($data['lot'])) {
                    $sectorModifier($event->getForm(), $data['lot']);
                }
            }
        );

        $builder->add('submit', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn-lg btn-success']]);
    }
}
