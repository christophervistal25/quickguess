<?php

abstract class TokenTester extends TestCase
{
    use UserCredentials;

     /**
     * [it_throw_401_if_token_not_provided description]
     * @test
     * @return [type] [description]
     */
    public function it_throw_401_if_token_not_provided()
    {
        $data = $this->credentials()
             ->withNull('password')
             ->withoutToken()
             ->getAll();

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
        $data = $this->credentials()
                     ->setTheTokenToExpire()
                     ->getAll();

        $response = $this->post('api/userstat',$data);

        $response->assertResponseStatus(400);
        $this->seeJsonEquals(['error' => 'Provided token is expired.']);
    }
}
