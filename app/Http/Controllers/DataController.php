<?php

namespace App\Http\Controllers;

use App\Data;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataRequest;
use App\Services\DataService;

class DataController extends Controller
{
    protected $dataservice;

    public function __construct(DataService $dataservice)
    {
        $this->dataservice = $dataservice;
    }

    /**
     * Fetch the graph data for the given date range.
     *
     * @return JSON
     */
    public function fetch(DataRequest $request)
    {
        $response = $this->dataservice->fetch($request);

        return response()->json($response);
    }
}
