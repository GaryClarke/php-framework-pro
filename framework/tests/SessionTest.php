<?php

namespace GaryClarke\Framework\Tests;

use GaryClarke\Framework\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        unset($_SESSION);
    }

    public function testSetAndGetFlash(): void
    {
        $session = new Session();
        $session->setFlash('success', 'Great job!');
        $session->setFlash('error', 'Bad job!');
        $this->assertTrue($session->hasFlash('success'));
        $this->assertTrue($session->hasFlash('error'));
        $this->assertEquals(['Great job!'], $session->getFlash('success'));
        $this->assertEquals(['Bad job!'], $session->getFlash('error'));
        $this->assertEquals([], $session->getFlash('warning'));
    }
}