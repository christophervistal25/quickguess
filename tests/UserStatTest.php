<?php

class UserStatTest extends TokenTester
{
    use UserCredentials;
    /**
     * [it_can_store_user_stat description]
     * @test
     * @return [type] [description]
     */
    public function it_can_store_user_stat()
    {
        $data = $this->userStatusCredentials()
                      ->getAll();

        $this->expectsEvents('App\Events\GetPoints');

        $response = $this->post('api/userstat',$data);

        $response->assertResponseStatus(201);
        $this->seeJsonStructure(['code','message']);
    }

    /**
     * [it_throws_422_if_user_data_status_is_not_encoded_to_json description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_user_data_status_is_not_encoded_to_json()
    {
        $data = $this->userStatusCredentials()
                     ->decodeJsonStatus()
                     ->getAll();

        $response = $this->post('api/userstat',$data);

        $response->assertResponseStatus(422);
        $this->seeJsonStructure(['data'])
            ->seeJsonEquals(['data' => ['The data is not valid.']]);
    }

    /**
     * [it_fails_if_no_parameters_pass description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_username_is_null()
    {
        $data = $this->userStatusCredentials()
                     ->withNull('username')
                     ->getAll();

        $response = $this->post('api/userstat',$data);

        $response->assertResponseStatus(422);
    }

}
