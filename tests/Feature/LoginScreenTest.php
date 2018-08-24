<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginScreenTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testIndex()
    {
        $this->visit('/login')
            ->see('ログイン');
    }

    public function testLogin()
    {
        $this->visit('login')
            ->type('manage@dac.co.jp', 'email')
            ->type('Password1234!@', 'password')
            ->press('ログイン')
            ->see('UU数見積もり');
    }
}
