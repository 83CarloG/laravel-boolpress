<?php

use Illuminate\Database\Seeder;
// Importo la possibilità di usare i Faker
use Faker\Generator as Faker;
// Importo la possibilità di usare gli Hash
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * run
     *
     * @param  mixed $faker
     * @return void
     *
     * Dependecy Injection
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {

            $newuser = new User;
            $newuser->name = $faker->name();
            $newuser->email = $faker->freeEmail();
            // Uso il metodo della classe Hash
            $newuser->password = Hash::make($faker->password());

            $newuser->save();
        }
    }
}
