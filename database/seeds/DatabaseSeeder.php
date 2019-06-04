<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FormatosSeeder::class);
        $this->call(ArchivosSeeder::class);
        $this->call(RegionesSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(FacultadesSeeder::class);
    }
}
