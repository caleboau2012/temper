<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DataService;
use App\Repositories\DataRepository;

class DataTest extends TestCase
{
    protected $dataservice;
    protected $data;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockedDataRepo = \Mockery::mock(DataRepository::class);
        $this->dataservice = new DataService($this->mockedDataRepo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGetWeekLyCohortsAreDatesSpacedByOneWeek()
    {
        $start = "2018-01-01";
        $stop = "2018-01-14";

        $data = $this->dataservice->getWeeklyCohorts($start, $stop);

        $date1 = new \DateTime($data[0]);
        $date2 = new \DateTime($data[1]);
        $interval = $date1->diff($date2);

        $this->assertTrue($interval->d == 7);
    }

    public function testPrepareWithValidData()
    {
        $data = json_decode(
            json_encode([
                [
                    "onboarding_percentage" => 0,
                    "total" => 50
                ],
                [
                    "onboarding_percentage" => 20,
                    "total" => 40
                ],
                [
                    "onboarding_percentage" => 40,
                    "total" => 35
                ],
                [
                    "onboarding_percentage" => 60,
                    "total" => 30
                ],
                [
                    "onboarding_percentage" => 80,
                    "total" => 25
                ],
                [
                    "onboarding_percentage" => 100,
                    "total" => 20
                ]
            ]),
            false
        );

        $response = $this->dataservice->prepare($data);

        $this->assertTrue(sizeof($response) == 8);
    }
}
