<?php
use App\Users\Repositories\UserHistoryRepository;
use App\Users\Repositories\UserRepository;
use App\Users\User;
use App\Users\UserSwitch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class UserHistoryTest extends TokenTester
{
    use UserCredentials;

    // 1. it throws 422 if the user is null
    // 2. it throws 422 if the prev_user_life is null

    /**
     * [it_can_store_user_history description]
     * @test
     * @return [type] [description]
     */
    public function it_can_store_user_history()
    {
        $data = $this->userHistoryCredentials()
                     ->getAll();

        $response = $this->post('api/userhistory',$data);
        $response->assertResponseStatus(201);
        $this->seeJsonStructure(['code']);
    }

    /**
     * [it_fails_if_no_parameters_pass description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_a_422_if_validation_fails()
    {
        $data = $this->getStubForValidation();
        $response = $this->post('api/userhistory',$data);
        $response->assertResponseStatus(422);
    }


    /**
     * [it_throws_a_422_if_user_not_exists description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_a_422_if_user_not_exists()
    {
        $data = $this->userHistoryCredentials()
                     ->refreshUsername()
                     ->getAll();

        $response = $this->post('api/userhistory',$data);
        $this->seeStatusCode(422)
             ->seeJsonStructure(['code','message'])
             ->seeJsonEquals([
                'code' => 422,
                'message' => 'user not exists.'
            ]);
    }

}
