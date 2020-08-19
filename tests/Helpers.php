<?php // tests/Helpers.php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Set the currently logged in user for the application.
 *
 * @return TestCase
 */
function actingAs(Authenticatable $user, string $driver = null)
{
    return test()->actingAs($user, $driver);
}