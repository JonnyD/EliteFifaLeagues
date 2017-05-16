<?php

namespace EliteFifa\Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $containsUsername = $crawler->filter('html:contains("Username:")')->count();
        $this->assertGreaterThan(0, $containsUsername);

        $containsPassword = $crawler->filter('html:contains("Password:")')->count();
        $this->assertGreaterThan(0, $containsPassword);
    }
}