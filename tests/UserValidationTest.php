<?php
abstract class UserValidationTest extends TestCase
{
    use UserCredentials;
    abstract public function it_throws_422_if_username_is_null();
    abstract public function it_throws_422_if_password_is_null();
    abstract public function it_throws_422_if_password_is_already_hashed();
    abstract public function it_throws_422_if_username_and_password_is_null();
}


