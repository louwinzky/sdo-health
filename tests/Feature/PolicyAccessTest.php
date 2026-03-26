<?php

use App\Models\School;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

test('sdo admin can view any school', function () {
    $sdoAdmin = User::factory()->create();
    $sdoAdmin->assignRole('sdo_admin');

    $school = School::factory()->create();

    $this->actingAs($sdoAdmin);
    $this->assertTrue($sdoAdmin->can('viewAny', School::class));
    $this->assertTrue($sdoAdmin->can('view', $school));
});

test('health coordinator can only view their school', function () {
    $school1 = School::factory()->create();
    $school2 = School::factory()->create();

    $coordinator = User::factory()->create(['school_id' => $school1->id]);
    $coordinator->assignRole('health_coordinator');

    $this->actingAs($coordinator);
    $this->assertTrue($coordinator->can('view', $school1));
    $this->assertFalse($coordinator->can('view', $school2));
});

test('principal can only view their school', function () {
    $school1 = School::factory()->create();
    $school2 = School::factory()->create();

    $principal = User::factory()->create(['school_id' => $school1->id]);
    $principal->assignRole('principal');

    $this->actingAs($principal);
    $this->assertTrue($principal->can('view', $school1));
    $this->assertFalse($principal->can('view', $school2));
});

test('sdo admin can create schools', function () {
    $sdoAdmin = User::factory()->create();
    $sdoAdmin->assignRole('sdo_admin');

    $this->actingAs($sdoAdmin);
    $this->assertTrue($sdoAdmin->can('create', School::class));
});

test('health coordinator cannot create schools', function () {
    $coordinator = User::factory()->create();
    $coordinator->assignRole('health_coordinator');

    $this->actingAs($coordinator);
    $this->assertFalse($coordinator->can('create', School::class));
});

test('sdo admin can update schools', function () {
    $sdoAdmin = User::factory()->create();
    $sdoAdmin->assignRole('sdo_admin');
    $school = School::factory()->create();

    $this->actingAs($sdoAdmin);
    $this->assertTrue($sdoAdmin->can('update', $school));
});
