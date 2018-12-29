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

        $this->post('api/userstat',$data)
            ->assertResponseStatus(201);

        $this->seeJsonStructure(['code','message']);
    }

    /*public function it_throws_422_if_user_data_status_is_not_encoded_to_json()
    {

    }*/

    /**
     * [it_fails_if_no_parameters_pass description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_a_422_if_validation_fails()
    {
        $data = $this->getStubForValidation();
        $response = $this->post('api/userstat',$data);
        $response->assertResponseStatus(422);
    }

}
