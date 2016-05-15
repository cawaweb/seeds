<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LotsController extends Controller
{
    public function indexAction(Request $request)
    {
        $error = null;
        $form = $this->createFormBuilder()
            ->add('text', SearchType::class, [
                'label'     => '',
                'required'  => true
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Search',
                'attr'  => ['class' => 'btn btn-default']
            ])
            ->getForm();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Lot');

        if ($request->isMethod('POST')) {
            try {
                $searchText = $request->get('form')['text'];
                $lots = $repository->findByName($searchText);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $lots = $repository->findAll();
        }

        return $this->render('AppBundle:lots:index.html.twig', [
            'lots'   => $lots,
            'form'   => $form->createView(),
            'error'  => $error
        ]);
    }
}
