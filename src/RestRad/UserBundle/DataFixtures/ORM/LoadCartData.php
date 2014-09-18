<?php
/**
 * Created by PhpStorm.
 * User: atom
 * Date: 9/13/14
 * Time: 5:15 PM
 */

namespace RestRad\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\RadBundle\DataFixtures\AbstractFixture;
use RestRad\UserBundle\Entity\Cart;

class LoadCartData extends AbstractFixture
{

    function load(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++) {
            $manager->persist( $this->createCart('cart#'.$i) );
        }
        $manager->flush();
    }

    private function createCart($name)
    {
        $cart = new Cart();
        $cart->setName($name);
        $cart->setDescription('This is '.$cart);

        return $cart;
    }

} 