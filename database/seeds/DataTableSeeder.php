<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class DatabaseSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/export.csv';
        $this->tablename = 'data';
        $this->timestamps = false;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        parent::run();
    }
}
