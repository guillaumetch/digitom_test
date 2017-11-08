<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Car controller.
 *
 * @Route("car")
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     *
     * @Route("/", name="car_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('AppBundle:Car')->findAll();

        return $this->render('back/car/index.html.twig', array(
            'cars' => $cars,
        ));
    }

    /**
     * Creates a new car entity.
     *
     * @Route("/new", name="car_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('AppBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_show', array('id' => $car->getId()));
        }

        return $this->render('back/car/new.html.twig', array(
            'car' => $car,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("/{id}/edit", name="car_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Car $car)
    {

        $editForm = $this->createForm('AppBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', array('id' => $car->getId()));
        }

        return $this->render('back/car/edit.html.twig', array(
            'car' => $car,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a car entity.
     *
     * @Route("/delete/{id}", name="car_delete")
     *
     */
    public function deleteAction(Request $request, Car $car)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($car);
        $em->flush();

        return $this->redirectToRoute('car_index');
    }
}
