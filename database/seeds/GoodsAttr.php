<?php

use Illuminate\Database\Seeder;

class GoodsAttr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $database = file_get_contents(base_path("database/seeds")."/.gitignore.sql");
        DB::connection()->getPdo()->exec($database);
    }
}
