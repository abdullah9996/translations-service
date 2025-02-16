<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = ['en', 'fr', 'es', 'da']; //English, French, Spanish, Danish
        $tags = ['mobile', 'desktop', 'web'];
        return [
            'key' => Str::random(10) . '_' . $this->faker->randomElement(),
            'locale' => $this->faker->randomElement($locales),
            'tag' => $this->faker->randomElement(['mobile', 'desktop', 'web']),
            'content' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
