<?php

use App\Users\User;
use App\Users\UserStat;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\CreatesApplication;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    protected $faker;
    protected $user_data_status  ,  $user , $validation_data;
    use CreatesApplication , DatabaseTransactions;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function artisanMigrateRefresh()
    {
        $this->artisan('migrate:refresh');
    }

    public function artisanMigrateReset()
    {
       $this->artisan('migrate:reset');
    }

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->createApplication();
        $this->artisanMigrateRefresh();
        $this->faker = Faker::create();
        $this->user = factory(User::class)->create();
        $this->user_data_status = factory(UserStat::class,5)->create();
    }

    public function getStubForValidation()
    {
        return [
            'username' => $this->user->name,
            'token' => $this->user->jwt($this->user),
        ];
    }
    /**
     * Reset the migrations
     */
    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}



