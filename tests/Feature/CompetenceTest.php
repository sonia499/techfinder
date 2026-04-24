<?php

namespace Tests\Feature;

use App\Models\Competence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_competences()
    {
        $data = Competence::factory()->make()-> toArray();
        $response = $this->post("api/competences", $data);
        $response->assertStatus(200);
    }

    public function test_update_competence() : void
    {
        $competence = Competence::factory()->create();
        $data = Competence::factory()->make()-> toArray();
        $response = $this->put("api/competences/{$competence->id}", $data);
        $response->assertStatus(201);
    }

    public function test_delete_competences() : void
    {
        $competence::factory()->create();
        $response = $this->delete("api/competences/{$competence->code_comp}");
        $response->assertStatus(200);
    }
}

