<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPilotSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_sent_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_seeded_member_can_sign_in_and_view_dashboard(): void
    {
        $this->seed();
        $this->post('/login', ['email' => 'reza@taskpilot.test', 'password' => 'Password123!'])
            ->assertRedirect('/dashboard');
        $this->get('/dashboard')->assertOk()->assertSee('Customer Portal');
    }

    public function test_status_endpoint_is_available_for_the_lab_challenge(): void
    {
        $this->getJson('/api/status')->assertOk()->assertJsonStructure(['app', 'environment', 'integration_key']);
    }
}
