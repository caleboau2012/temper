<?php

namespace App\Repositories;

use App\Data;

/**
 * This repository is the store house for all present and future queries for the model
 */
class DataRepository
{
    protected $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    /**
     * Fetches the required graph data by start and stop dates
     *
     * @return Collection
     */
    public function fetchByDateRange($start, $stop)
    {
        return $this->data
            ->select('onboarding_percentage', \DB::raw('count(*) as total'))
            ->groupBy('onboarding_percentage')
            ->where('created_at', '>=', $start)
            ->where('created_at', '<', $stop)
            ->get();
    }
}
