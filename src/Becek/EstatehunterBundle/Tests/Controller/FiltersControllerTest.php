<?php

namespace Becek\EstatehunterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiltersControllerTest extends WebTestCase
{
    public function testNewfilter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/filter');
    }

}
