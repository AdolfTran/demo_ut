<?php

namespace Tests\Unit;

use App\Services\DemoService;
use App\Models\ManageUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginFunctionTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware; // use this trait

    private $users;

    /*
     * create data default for test.
     */
    private function getMock(){
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

    /*
     * delete data test
     */
    private function deleteMock(){
        if($this->users){
            $this->users->forceDelete();
        }
    }

    public function loginForTest()
    {
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $this->actingAs($admin);
    }

    public function testLoginSuccess()
    {
        $this->getMock();
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $this->actingAs($admin);
        $response = $this->call('GET','/user');
        $this->seeIsAuthenticated();
        $this->assertEquals(200, $response->getStatusCode());
        $this->deleteMock();
    }

    public function testLoginFailWithoutPass()
    {
        $this->getMock();
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $response = $this->call('POST','/login', [
            'email' => $admin->email,
            'password' => ''
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
        $this->deleteMock();
    }

    public function testLoginFailWithInvalidUser()
    {
        $this->getMock();
        $admin = ManageUser::where('email', 'test@dac.co.jp')->first();
        $response = $this->call('POST','/login', [
            'email' => $admin->email,
            'password' => 'invalid'
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->dontSeeIsAuthenticated();
        $this->deleteMock();
    }
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


    /**
     *
     * @dataProvider dataForFunctionService
     *
     */
    public function testFunctionService($data, $result)
    {
        $this->getMock();
        $this->loginForTest();
        $this->assertEquals(DemoService::getData($data), $result);
        $this->deleteMock();
    }

    public function dataForFunctionService(){
        return [
            [12, 12],
            [true, true],
            ['test_string', 'test_string']
        ];
    }
}
