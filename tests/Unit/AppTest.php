<?php

namespace Tests\Unit;

use App\Models\Armament;
use App\Models\Spaceship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AppTest extends TestCase
{
   //use RefreshDatabase;

    /**
     * A basic test to see if the user model can be instantiated.
     *
     * @return void
     */
    public function test_user_instantiated()
    {
        $user = User::factory()->count(3)->make();
        $this->assertTrue(count($user) == 3);
    }

    /**
     * Test to see if the User can be persisted
     */
    public function test_users_can_be_persisted()
    {
        $users = User::factory()->count(3)->create();
        $this->assertDatabaseCount('users', 3);
    }


    /**
     * A basic test to see if the Spaceship model can be instantiated.
     *
     * @return void
     */
    public function test_spaceship_instantiated()
    {
        $spaceship = Spaceship::factory()->count(3)->make();
        $this->assertTrue(count($spaceship) == 3);
    }

    /**
     * Test to see if the Spaceship can be persisted
     */
    public function test_spaceship_can_be_persisted()
    {
        $spaceship = Spaceship::factory()->count(3)->create();
        $this->assertDatabaseCount('spaceships', 3);
    }

    /**
     * A basic test to see if the Armament model can be instantiated.
     *
     * @return void
     */
    public function test_armament_instantiated()
    {
        $armament = Armament::factory()->count(3)->make();
        $this->assertTrue(count($armament) == 3);
    }

    /**
     * Test if the Armament can be persisted
     */
    public function test_armament_can_be_persisted()
    {
        $armament = Armament::factory()->count(3)->create();
        $this->assertDatabaseCount('armaments', 3);
    }

    /**
     * Test if many to many relationships can be created
     */
    public function test_armament_spaceships_relationship_can_be_persisted()
    {
        Spaceship::factory()->hasAttached(
            Armament::factory()->count(10),
            ['qty' =>  rand(1, 50)]
        )->create();
        $this->assertDatabaseCount('spaceships_armaments', 10);
    }

    /**
     * Test if spaceship can be deleted
     */
    public function test_spaceship_can_be_deleted()
    {
        $spaceship = Spaceship::factory()->create();
        $spaceship->delete();
        $this->assertDeleted($spaceship);
    }



}
