<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_user_can_proceed_to_home_list_or_search()
    {
        $this->actingAs(factory('App\User')->create())->get('/')->assertStatus(200);
        $this->actingAs(factory('App\User')->create())->get('/books')->assertStatus(200);
        $this->actingAs(factory('App\User')->create())->get('/books/search')->assertStatus(200);
    }

    public function test_user_can_add_book()
    {
        $fakeUser = factory('App\User')->create();
        $attributes = [
            'email' => $fakeUser->email,
            'author' => 'Tester Testingson',
            'title' => 'To Test or Not to Test?',
            'subtitle' => 'A Question',
            'description' => 'A fake book about the joys of testing in this moment.'
        ];

        $this->actingAs($fakeUser)->assertAuthenticatedAs($fakeUser);
        $this->actingAs($fakeUser)->post('/books', $attributes)->assertRedirect('/books');
        $this->assertDatabaseHas('books', $attributes);
    }

    public function test_guest_cannot_proceed_to_home_list_or_search()
    {
        $this->get('/')->assertRedirect('/login');
        $this->get('/books')->assertRedirect('/login');
        $this->get('/books/search')->assertRedirect('/login');
    }

    public function test_guest_cannot_add_book()
    {
        $this->post('/books')->assertRedirect('/login');
    }
}
