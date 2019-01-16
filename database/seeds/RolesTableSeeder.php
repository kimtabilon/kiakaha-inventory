<?php

use Illuminate\Database\Seeder;
use \Faker\Factory;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashier    = factory(App\Role::class)->create(['name' => 'Cashier']);
        $rc         = factory(App\Role::class)->create(['name' => 'Receiving Coordinator']);
        $manager    = factory(App\Role::class)->create(['name' => 'Manager']);
        
        factory(App\User::class)
            ->create([
                'role_id'       => $manager->id,
                'given_name'    => 'Christopher',
                'middle_name'   => '',
                'last_name'     => 'Dickens',
                'email'         => 'christopher.dickens@gmail.com',
                ]);
            
        factory(App\User::class)
            ->create([
                'role_id'       => $rc->id,
                'given_name'    => 'Ryan',
                'middle_name'   => '',
                'last_name'     => 'Welch',
                'email'         => 'ryan.welch@gmail.com',
                ]);
                
        factory(App\User::class)
            ->create([
                'role_id'       => $cashier->id,
                'given_name'    => 'Thomas',
                'middle_name'   => '',
                'last_name'     => 'North',
                'email'         => 'thomas.north@gmail.com',
                ]);
    }
}
