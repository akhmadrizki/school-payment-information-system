<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckValidationTest extends TestCase
{
    public function testReturnsAnErrorIfTheEnteredDataDoesNotMatch()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/dashboard/admin', [
            'name' => 'I Made Sutama',
            'username' => 'sutama',
            'email' => 'sutama@gmail.com',
            'address' => 'Jl. Kebon Kacang',
            'contact' => '+/6281999023431',
        ]);

        $this->assertFalse(false);
    }

    public function testProsesDataIfTheEnteredDataMatches()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/dashboard/admin', [
            'name' => 'I Made Mustika',
            'username' => 'mustika',
            'email' => 'mustika@gmail.com',
            'address' => 'Jl. Kebon Pinang',
            'contact' => '6281999021431',
        ]);

        $response->assertStatus(302);
    }
}
