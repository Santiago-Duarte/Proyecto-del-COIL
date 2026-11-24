<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_redirects_to_the_personas_externas_module(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/personas-externas');
    }
}
