<?php

namespace Database\Factories;

use App\Models\Contact;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'contact' => "\Closure"
    ])]
    public function definition(): array
    {
        return [
            'contact' => function(array $attributes) {
                return $attributes['type'] == Contact::TYPE['email']
                    ? $this->faker->unique()->email()
                    : $this->faker->unique()->e164PhoneNumber();
            }
        ];
    }
}
