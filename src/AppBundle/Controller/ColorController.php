<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Color;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Color controller.
 *
 * @Route("color")
 */
class ColorController extends Controller
{
    /**
     * Lists all color entities.
     *
     * @Route("/", name="color_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colors = $em->getRepository('AppBundle:Color')->findAll();

        return $this->render('back/color/index.html.twig', array(
            'colors' => $colors,
        ));
    }

    /**
     * Creates a new color entity.
     *
     * @Route("/new", name="color_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $color = new Color();
        $form = $this->createForm('AppBundle\Form\ColorType', $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('color_show', array('id' => $color->getId()));
        }

        return $this->render('back/color/new.html.twig', array(
            'color' => $color,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing color entity.
     *
     * @Route("/{id}/edit", name="color_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Color $color)
    {
        $editForm = $this->createForm('AppBundle\Form\ColorType', $color);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('color_edit', array('id' => $color->getId()));
        }

        return $this->render('back/color/edit.html.twig', array(
            'color' => $color,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a color entity.
     *
     * @Route("/delete/{id}", name="color_delete")
     *
     */
    public function deleteAction(Request $request, Color $color)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($color);
        $em->flush();

        return $this->redirectToRoute('color_index');
    }


}
