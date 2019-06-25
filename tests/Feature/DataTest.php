<?php

// namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\DataRepository;

class DataTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mockedDataRepo = Mockery::mock(DataRepository::class);
        app()->instance(DataRepository::class, $this->mockedDataRepo);
    }

    /**
     * A basic feature test for the homepage.
     *
     * @return void
     */
    public function testHomepageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testValidRequest()
    {
        $data = [
            "start" => "2019-01-02",
            "stop" => "2019-01-09"
        ];

        $this->mockedDataRepo->shouldReceive('fetchByDateRange')->once();

        $response = $this->json('GET', '/api/report', $data);

        $response->assertStatus(200);
    }

    public function testStopDateBeforeStartDate()
    {
        $data = [
            "start" => "2019-01-02",
            "stop" => "2018-03-04"
        ];

        $response = $this->json('GET', '/api/report', $data);

        $response->assertStatus(422);
    }

    public function testNoStopDate()
    {
        $data = [
            "start" => "2019-01-02"
        ];

        $response = $this->json('GET', '/api/report', $data);

        $response->assertStatus(422);
    }

    public function testNoStartDate()
    {
        $data = [
            "start" => "2019-01-02"
        ];

        $response = $this->json('GET', '/api/report', $data);

        $response->assertStatus(422);
    }
}
