<?php

namespace App\Services;

use App\Repositories\DataRepository;
use Illuminate\Http\Request;

/**
 * This service handles the heavy lifting
 */
class DataService
{
    public function __construct(DataRepository $data)
    {
        $this->data = $data;
    }

    /**
     * This method accepts the request from the controller and processes it
     * to get the appropriate result
     *
     * @return array
     */
    public function fetch(Request $request)
    {
        $start = $request->input('start');
        $stop = $request->input('stop');

        $cohorts = $this->getWeeklyCohorts($start, $stop);

        $response = [];

        for ($i = 0; $i < sizeof($cohorts) - 1; $i++) {
            $data = $this->data->fetchByDateRange(
                $cohorts[$i],
                $cohorts[$i + 1]
            );

            if (sizeof($data) == 0) {
                array_push($response, [
                    "name" => $cohorts[$i],
                    "data" => []
                ]);
            } else {
                array_push($response, [
                    "name" => $cohorts[$i],
                    "data" => $this->prepare($data)
                ]);
            }
        }

        return $response;
    }

    /**
     * This method accepts a collection of data pointts
     * and prepares the needed graph data.
     *
     * @return array
     */
    public function prepare($data)
    {
        $response = [
            "0" => 100,
            "20" => 0,
            "40" => 0,
            "50" => 0,
            "70" => 0,
            "90" => 0,
            "99" => 0,
            "100" => 0
        ];
        $sum = 0;

        // get sum of all entries in this cohort
        foreach ($data as $d) {
            $sum += $d->total;
        }

        $current_sum = $sum;

        // compute sum of members that are in or have reached the given onboarding percentage
        foreach ($data as $d) {
            if (array_key_exists($d->onboarding_percentage, $response)) {
                $response[$d->onboarding_percentage] =
                    ($current_sum / $sum) * 100;
            }
            $current_sum -= $d->total;
        }

        $keys = array_keys($response);

        // clean up for onboarding percentages that have no entries in the db
        for ($i = 0; $i < count($keys); ++$i) {
            if ($keys[$i] != "0" && $response[$keys[$i]] == 0) {
                $response[$keys[$i]] = $response[$keys[$i - 1]];
            }
        }

        // remove keys
        return array_values($response);
    }

    /**
     * Function to get weekly cohorts from given start and stop dates
     *
     * @return array
     */
    public function getWeeklyCohorts($start, $stop)
    {
        $current = new \DateTime($start);
        $stop = new \DateTime($stop);

        $cohorts = [$current->format("Y-m-d")];

        do {
            $current = clone $current;
            $current->modify('+1 week');
            array_push($cohorts, $current->format("Y-m-d"));
        } while ($current < $stop);

        return $cohorts;
    }
}
