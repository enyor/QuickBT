<?php
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos 5 usuarios de prueba
        factory(User::class)->times(1)->create();
    }
}
