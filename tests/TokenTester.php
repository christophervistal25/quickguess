<?php

abstract class TokenTester extends TestCase
{
     /**
     * [it_throw_401_if_token_not_provided description]
     * @test
     * @return [type] [description]
     */
    public function it_throw_401_if_token_not_provided()
    {
        $data = ['username' => $this->user->name];
        $response = $this->post('api/userstat',$data);
        $response->assertResponseStatus(401);
    }
    /**
     * [it_throw_400_if_token_expired description]
     * @test
     * @return [type] [description]
     */
    public function it_throw_400_if_token_expired()
    {
        $data = ['username' => $this->user->name , 'password' => 1234, 'token' => $this->user->jwt($this->user,60)];
        $response = $this->post('api/userstat',$data);
        $response->assertResponseStatus(400);
        $this->seeJsonEquals(['error' => 'Provided token is expired.']);
    }
}
