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
     * [it_throws_422_if_the_prev_user_life_is_null description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_the_prev_user_life_is_null()
    {
        $data = $this->userHistoryCredentials()
                     ->withNull('prev_user_life')
                     ->getAll();

        $response = $this->post('api/userhistory',$data);

        $response->assertResponseStatus(422);
    }


    /**
     * [it_throws_422_if_the_username_is_null description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_the_username_is_null()
    {
        $data = $this->userHistoryCredentials()
                     ->withNull('username')
                     ->getAll();

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
             ->seeJsonStructure(['username'])
             ->seeJsonEquals(['username' => ['the user is unauthorized.']]);
    }

}
