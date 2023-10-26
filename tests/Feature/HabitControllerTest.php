<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class HabitControllerTest extends TestCase
{
    public function test_an_authenticated_user_can_list_habits()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/habits');

        $response->assertOk();
    }

    public function test_an_unauthenticated_user_cannot_create_a_habit()
    {
        $response = $this->postJson('/api/habits', [
            'name' => 'test',
            'category_id' => 1
        ]);

        $response->assertUnauthorized();
    }

    public function test_an_authenticated_user_can_create_a_habit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/habits', [
                'name' => 'test',
                'category_id' => 1,
                'measurable' => 0
            ]);

        $response->assertOk();
    }

    public function test_a_measurable_habit_requires_goal()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/habits', [
                'name' => 'test',
                'category_id' => 1,
                'measurable' => 1
            ]);

        $response
            ->assertStatus(422)
            ->assertInvalid([
                'goal' => 'The goal field is required.'
            ]);
    }
}
