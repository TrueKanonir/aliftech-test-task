<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)
            ->has(
                Contact::factory()
                    ->count(10)
                    ->state(new Sequence(
                        ['type' => Contact::TYPE['phone']],
                        ['type' => Contact::TYPE['email']]
                    ))
            )
            ->create();
    }
}
