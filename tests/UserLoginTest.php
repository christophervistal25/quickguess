<?php

class UserLoginTest extends UserValidationTest
{
    /** @test */
    public function it_can_log_in()
    {
        $data = $this->credentials()
                     ->getAll();
        $this->post('api/login',$data)
            ->assertResponseStatus(200);
        $this->seeJsonStructure(['success','id','name','token','stat','user_history']);
    }

    /**
     * [it_throws_422_if_username_is_not_in_database description]
     * @test
     * @return [type] [description]
     */
    public function it_throws_422_if_username_is_not_in_database()
    {
        $data = $this->credentials()
                     ->refreshUsername()
                     ->getAll();

        $this->notSeeInDatabase('users',['name' => $this->credentials['username']]);

        $this->post('api/login',$data)
              ->assertResponseStatus(422);
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

        $this->post('api/login',$data)
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

        $this->post('api/login',$data)
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

        $this->post('api/login',$data)
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

        $this->post('api/login',$data)
              ->assertResponseStatus(422);
    }
}
