<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('front/base.html.twig');
    }

    /**
     * @Route("/preference",name="preference")
     *
     */
    public function preferencesAction(Request $request){

        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($request->isXmlHttpRequest()){
            $id = $request->get('id');
            $array = array();
            if(!$id){
                $array = array('id'=>null,'name'=>'Couleurs');
            }
            $car = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:Car')
                    ->find($id);
            $colors = $car->getColors();


            for($i=0;$i<count($colors);$i++){
                $color = array();
                $color['id'] = $colors[$i]->getId();
                $color['name'] = $colors[$i]->getName();
                array_push($array,$color);
            }

            return new JsonResponse(array('colors'=>$array));
        }
        if($form->isSubmitted()&& $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                '<strong>Merci</strong> d\'avoir répondu à notre questionnaire :)'
            );

            return $this->redirectToRoute('preference');
        }

        return $this->render('front/index.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/back", name="backoffice")
     */
    public function backofficeAction(Request $request){
        return $this->render('back/index.html.twig');
    }
}
