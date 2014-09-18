<?php
/**
 * Created by PhpStorm.
 * User: atom
 * Date: 9/14/14
 * Time: 11:37 PM
 */

namespace RestRad\UserBundle\Tests\Controller;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{

    protected function setUp()
    {
        $this->runCommand('doctrine:schema:drop', ['--force' => true]);
        $this->runCommand('doctrine:schema:update', ['--force' => true]);

        $fixtures = ['RestRad\UserBundle\Tests\DataFixtures\ORM\LoadCartData'];
        $this->loadFixtures($fixtures);
    }

    public function testGetActionReturnsAllCarts()
    {
        $client = $this->createClient();
        $carts = $this->getContainer()
            ->get('doctrine')
            ->getRepository('RestRadUserBundle:Cart')
            ->findAll();
        $jsonData = $this->getContainer()->get('jms_serializer')->serialize($carts, 'json');

        $client->request('GET', 'carts');
        $jsonResponse = $client->getResponse()->getContent();

        $this->assertJson($jsonResponse);
        $this->assertEquals($jsonData, $jsonResponse);
    }

    public function testGetActionReturnOneCart()
    {
        $client = $this->createClient();
        $cart = $this->getContainer()
            ->get('doctrine')
            ->getRepository('RestRadUserBundle:Cart')
            ->find(1);
        $jsonData = $this->getContainer()->get('jms_serializer')->serialize($cart, 'json');

        $client->request('GET', 'carts/1');
        $jsonResponse = $client->getResponse()->getContent();

        $this->assertJson($jsonResponse);
        $this->assertEquals($jsonData, $jsonResponse);
    }

    public function testPostActionCreatesNewEntity()
    {
        $client = $this->createClient();
        $client->request('POST', 'carts', ['name' => 'testCart', 'description' => 'testCartDescription']);
        $jsonResponse = $client->getResponse()->getContent();

        $this->assertJson($jsonResponse);
        $this->assertEquals('{"id":6}', $jsonResponse);

        $cart = $this->getContainer()
            ->get('doctrine')
            ->getRepository('RestRadUserBundle:Cart')
            ->find(6);

        $this->assertEquals('testCart', $cart->getName());
        $this->assertEquals('testCartDescription', $cart->getDescription());
    }

    public function testPutActionUpdatesExistingEntity()
    {
        $client = $this->createClient();
        $client->request('PUT', 'carts/1', ['name' => 'testUpdateCart', 'description' => 'testUpdateCartDescription']);


        $cart = $this->getContainer()
            ->get('doctrine')
            ->getRepository('RestRadUserBundle:Cart')
            ->find(1);

        $this->assertEquals('testUpdateCart', $cart->getName());
        $this->assertEquals('testUpdateCartDescription', $cart->getDescription());
    }

    public function testDeleteActionDeletesExistingEntity()
    {
        $client = $this->createClient();
        $client->request('DELETE', 'carts/2');


        $cart = $this->getContainer()
            ->get('doctrine')
            ->getRepository('RestRadUserBundle:Cart')
            ->find(2);

        $this->assertEquals(false, $cart);
    }


}
 