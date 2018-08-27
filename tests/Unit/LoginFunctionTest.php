<?php

namespace Tests\Unit;

use App\Models\ManageUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginFunctionTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    /**
     * An user without pass cannot be logged in.
     *
     * @return void
     */
    public function testDoesNotLoginWithoutPassword()
    {
        $user = factory(ManageUser::class)->create();
        $response = $this->call('POST','/login', [
            'email' => $user->email,
            'password' => ''
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
    }
    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function testDoesNotLoginAnInvalidUser()
    {
        $user = factory(ManageUser::class)->create();
        $response = $this->call('POST','/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
    }

    public function testLoginSuccess()
    {
        $user = factory(ManageUser::class)->create();
        $this->actingAs($user);
        $response = $this->call('GET','/user');
        $this->seeIsAuthenticated();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
