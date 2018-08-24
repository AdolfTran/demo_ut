<?php

namespace Tests\Unit;

use App\Services\DemoService;
use App\Models\ManageUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginFunctionTest extends TestCase
{
    use DatabaseTransactions;

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

    public function testIndex()
    {
        $this->getMock();
        $this->loginForTest();
        $response = $this->call('GET','/user');
        $this->seeIsAuthenticated();
        $this->assertEquals(200, $response->getStatusCode());
        $this->deleteMock();
    }

    public function testHttpUser()
    {
        $this->getMock();
        $this->loginForTest();
        $response = $this->call('GET','/user');
        $this->assertEquals(200, $response->getStatusCode());
        $this->deleteMock();
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
