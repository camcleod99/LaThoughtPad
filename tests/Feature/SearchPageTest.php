<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function results_page_can_be_displayed()
    {
        $familiar = User::factory()->create();

        $response = $this->actingAs($familiar)->get('/search');

        $response->assertStatus(200);
    }

//     // Note: The following two tests might require a tool like Laravel Dusk.
//     // We'll Come back to these later.
//     /** @test */
//     public function modal_can_appear()
//     {
//         // Test code here
//     }
//
//     /** @test */
//     public function modal_can_accept_input()
//     {
//         // Test code here
//     }

    /** @test */
    public function results_page_can_be_displayed_with_returned_values()
    {
        $response = $this->post('/search', ['query' => 'test']);

        $response->assertStatus(200);
        $response->assertSee('test'); // Replace 'test' with the expected search result
    }

    /** @test */
    public function values_are_correct()
    {
        $response = $this->post('/search', ['query' => 'test']);

        $response->assertStatus(200);
        $response->assertSee('test'); // Replace 'test' with the expected search result
    }
}
