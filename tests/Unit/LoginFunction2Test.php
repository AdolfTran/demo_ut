<?php

namespace Tests\Unit;

use App\Models\ManageUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginFunction2Test extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    private $users;
    public function setUp()
    {
        parent::setUp();
        $this->moking();
    }
    public function tearDown()
    {
        if($this->users){
            $this->users->forceDelete();
        }
    }

    /*
     * create data default for test.
     */
    private function moking(){
        $this->users = ManageUser::create(
            [
                'manage_role_id'      => \App\Models\ManageRole::ROLE_ADMIN,
                'email'               => 'test@dac.co.jp',
                'password'            => 'Password1234!@',
                'user_last_name'      => 'Test',
                'user_first_name'     => 'test',
            ]
        );
    }

    public function testLoginFailWithoutPass()
    {
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $response = $this->call('POST','/login', [
            'email' => $admin->email,
            'password' => null,
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
    }

    public function testLoginFailWithInvalidPass()
    {
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $response = $this->call('POST','/login', [
            'email' => $admin->email,
            'password' => 'invalid'
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
    }

    public function testLoginFailWithInvalidUser()
    {
        $response = $this->call('POST','/login', [
            'email' => 'invalid@gmail.com',
            'password' => 'secret'
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
    }

    public function testLoginSuccess()
    {
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $this->actingAs($admin);
        $response = $this->call('GET','/user');
        $this->seeIsAuthenticated();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
