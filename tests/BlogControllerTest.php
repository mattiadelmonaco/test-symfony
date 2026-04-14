<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testHomepageReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testHomepageContainsSymblog(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSelectorTextContains('h1', 'SymBlog');
    }

    public function testNewPostRedirectsIfNotLoggedIn(): void
    {
        $client = static::createClient();
        $client->request('GET', '/post/new');

        $this->assertResponseRedirects('/login');
    }
}
