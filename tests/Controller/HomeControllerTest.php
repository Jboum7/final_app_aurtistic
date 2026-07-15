<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HomeControllerTest extends WebTestCase
{
    public function testHomePageIsSuccessful(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }

    public function testAboutPageIsSuccessful(): void
    {
        $client = static::createClient();

        $client->request('GET', '/about');

        self::assertResponseIsSuccessful();
    }

    public function testLoginPageIsSuccessful(): void
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        self::assertResponseIsSuccessful();
    }

    public function testDashboardRedirectsAnonymousUserToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/dashboard');

        self::assertResponseRedirects('/login');
    }
}
