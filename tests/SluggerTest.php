<?php

namespace App\Tests;

use App\Service\SluggerService;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    private SluggerService $slugger;

    protected function setUp(): void
    {
        $this->slugger = new SluggerService();
    }

    public function testSlugifyBasic(): void
    {
        $result = $this->slugger->slugify('Hello World');
        $this->assertEquals('hello-world', $result);
    }

    public function testSlugifyAlreadyLowercase(): void
    {
        $result = $this->slugger->slugify('hello world');
        $this->assertEquals('hello-world', $result);
    }

    public function testSlugifyNoSpaces(): void
    {
        $result = $this->slugger->slugify('HelloWorld');
        $this->assertEquals('helloworld', $result);
    }
}
