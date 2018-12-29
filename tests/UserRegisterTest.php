<?php

class UserRegisterTest extends UserValidationTest
{
    /**
     * [it_can_register_a_user description]
     * @test
     * @return [type] [description]
     */
    public function it_can_register_a_user()
    {
        $data = $this->credentials()
                     ->refreshUsername()
                     ->withoutToken()
                     ->getAll();

        $response = $this->call('POST', '/api/register',$data);
        $this->seeStatusCode(201)
             ->seeJsonStructure(['success','id','token'])
             ->seeJsonEquals([
                'success' => true,
                'id'      => $response->getData()->id,
                'token'   => $response->getData()->token,
            ]);
    }

       /**
     * [it_throw_422_if_username_is_null description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_username_is_null()
    {
        $data = $this->credentials()
                     ->withNull('username')
                     ->getAll();

        $this->post('api/register',$data)
              ->assertResponseStatus(422);
    }

    /**
     * [it_throws_422_if_password_is_null description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_password_is_null()
    {
       $data = $this->credentials()
                     ->withNull('password')
                     ->getAll();

        $this->post('api/register',$data)
             ->assertResponseStatus(422);
    }

    /**
     * [it_throws_422_if_password_is_already_hashed description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_password_is_already_hashed()
    {
         $data = $this->credentials()
                     ->hashThePassword()
                     ->getAll();

        $this->post('api/register',$data)
              ->assertResponseStatus(422);
    }

    /**
     * [it_hrows_422_if_username_and_password_is_null description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_username_and_password_is_null()
    {
        $data = $this->credentials()
                    ->withNull(['username','password'])
                    ->getAll();

        $this->post('api/register',$data)
              ->assertResponseStatus(422);
    }

    /**
     * [it_throws_422_if_username_is_already_exists description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_username_is_already_exists()
    {
        $data = $this->credentials()
                    ->withoutToken()
                    ->getAll();
        $this->post('api/register',$data)
              ->assertResponseStatus(422);
    }

}
