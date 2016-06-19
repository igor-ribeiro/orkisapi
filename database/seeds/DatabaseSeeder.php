<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'users',
        'nurseries',
        'orchids',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->clear();

        $this->call(UserTableSeeder::class);
        $this->call(OrchidTableSeeder::class);
    }

    protected function clear()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Storage::disk('public')->deleteDirectory('codes');
    }
}
