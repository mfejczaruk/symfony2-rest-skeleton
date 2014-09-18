<?php
/**
 * Created by PhpStorm.
 * User: atom
 * Date: 9/13/14
 * Time: 5:22 PM
 */

namespace RestRad\UserBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use RestRad\UserBundle\Entity\Cart;
use RestRad\UserBundle\Form\CartType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class CartController extends FOSRestController
{
    public function getCartsAction()
    {
        $carts = $this->getDoctrine()->
            getRepository('RestRadUserBundle:Cart')
            ->findAll();

        return $carts;
    }

    /**
     * @ParamConverter("cart", class="RestRadUserBundle:Cart")
     */
    public function getCartAction($cart)
    {
        return $cart;
    }

    public function postCartAction(Request $request)
    {
        $cart = new Cart();
        $form = $this->createForm(new CartType(), $cart);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($cart);
            $em->flush();

            return ['id' => $cart->getId()];
        }

        return ['errors' => $form->getErrors()];
    }

    /**
     * @ParamConverter("cart", class="RestRadUserBundle:Cart")
     */
    public function putCartAction($cart, Request $request)
    {
        $form = $this->createForm(new CartType(), $cart);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($cart);
            $em->flush();

            return [];
        }

        return ['errors' => $form->getErrors()];
    }

    /**
     * @ParamConverter("cart", class="RestRadUserBundle:Cart")
     */
    public function deleteCartAction($cart, Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $em->remove($cart);
        $em->flush();

        return [];
    }

}