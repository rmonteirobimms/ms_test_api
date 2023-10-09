<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Deliverable;
use App\Models\Task;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            Profile::factory(2)->create(['user_id' => $user->id]);
        });

        $ricardo_u = User::factory()->create([
            'username' => 'monte1ro',
            'first_name' => 'Ricardo',
            'last_name' => 'Monteiro',
            'password' => 'password'
        ]);

        $joao_u = User::factory()->create([
            'username' => 'papi_ribeiro',
            'first_name' => 'João',
            'last_name' => 'Ribeiro',
            'password' => 'jribeiro'
        ]);

        $isabela_u = User::factory()->create([
            'username' => 'isamacena',
            'first_name' => 'Isabela',
            'last_name' => 'Macena',
            'password' => 'imacena'
        ]);

        $ricardo_p = Profile::factory()->create([
            'user_id' => $ricardo_u->id,
            'name' => $ricardo_u->first_name,
            'email' => strtolower($ricardo_u->first_name[0] . $ricardo_u->last_name . '@bimms.net'),
            'imageURL' => '/images/user-default.png',
        ]);
        $joao_p = Profile::factory()->create([
            'user_id' => $joao_u->id,
            'name' => $joao_u->first_name,
            'email' => strtolower($joao_u->first_name[0] . $joao_u->last_name . '@bimms.net'),
            'imageURL' => '/images/user-default.png',
        ]);
        $isabela_p = Profile::factory()->create([
            'user_id' => $isabela_u->id,
            'name' => $isabela_u->first_name,
            'email' => strtolower($isabela_u->first_name[0] . $isabela_u->last_name . '@bimms.net'),
            'imageURL' => '/images/user-default.png',
        ]);

        Task::factory(50)->create();

        $isabela_t = Task::factory()->create([
            'creator_id' => $joao_p->id,
            'assigned_to' => $isabela_p->id
        ]);

        $ricardo_t = Task::factory()->create([
            'creator_id' => $isabela_p->id,
            'assigned_to' => $ricardo_p->id
        ]);

        Deliverable::factory(150)->create();

        Deliverable::factory()->create([
            'task_id' => $isabela_t->id
        ]);

        Deliverable::factory()->create([
            'task_id' => $ricardo_t->id
        ]);
    }
}
