```php
<?php

// Current problematic version
public function destroy()
{
    Auth::user()->update([
        'status' => 0,
    ]);

    Auth::logout();

    return to_route('index');
}



// FIXED VERSION with proper error handling
public function destroy(Request $request)
{
    try {
        // Fix 1: Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to perform this action.');
        }

        $user = Auth::user();

        // Fix 2: Check if user has 'status' column
        if (!Schema::hasColumn('users', 'status')) {
            throw new \Exception('Status column does not exist on users table');
        }

        // Fix 3: Use database transaction for data integrity
        DB::transaction(function () use ($user, $request) {
            // Update user status
            $user->update([
                'status' => 0,
            ]);

            // Fix 4: Proper logout with session handling
            Auth::logout();
            
            // Invalidate session and regenerate CSRF token
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        });

        // Fix 5: Redirect with success message
        return redirect()->route('index')->with('success', 'Account deactivated successfully.');

    } catch (\Exception $e) {
        // Fix 6: Handle errors gracefully
        return back()->with('error', 'Failed to deactivate account. Please try again.');
    }
}

// ALTERNATIVE: More robust version with additional checks
public function destroy(Request $request)
{
    // Validate user is authenticated
    $user = Auth::user();
    
    if (!$user) {
        return redirect()->route('login');
    }

    try {
        DB::transaction(function () use ($user, $request) {
            // Check if user can be deactivated (business logic)
            if ($user->hasActiveSubscription()) {
                throw new \Exception('Cannot deactivate account with active subscription');
            }

            // Soft delete or deactivate
            $user->update([
                'status' => 0,
                'deactivated_at' => now(), // Optional: track when deactivated
            ]);

            // Clean up user sessions
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Optional: Log the action
            Log::info('User account deactivated', ['user_id' => $user->id]);
        });

        return redirect()->route('index')
            ->with('success', 'Your account has been deactivated successfully.');

    } catch (\Throwable $e) {
        Log::error('Account deactivation failed', [
            'user_id' => $user->id,
            'error' => $e->getMessage()
        ]);

        return back()->with('error', 'Unable to deactivate account. Please contact support.');
    }
}

// ROUTE PROTECTION (add to web.php)
Route::delete('/account', [AccountController::class, 'destroy'])
    ->name('account.destroy')
    ->middleware(['auth', 'password.confirm']); // Require password confirmation

// CORRESPONDING TEST
public function test_authenticated_user_can_deactivate_account()
{
    $user = User::factory()->create(['status' => 1]);
    
    $response = $this->actingAs($user)
                     ->delete(route('account.destroy'));
    
    $response->assertRedirect(route('index'));
    $response->assertSessionHas('success');
    
    // Verify user status updated
    $this->assertEquals(0, $user->fresh()->status);
    
    // Verify user is logged out
    $this->assertGuest();
}



public function test_guest_cannot_deactivate_account()
{
    $response = $this->delete(route('account.destroy'));
    
    $response->assertRedirect(route('login'));
}



public function test_account_deactivation_handles_database_errors()
{
    $user = User::factory()->create();
    
    // Mock database failure
    DB::shouldReceive('transaction')->andThrow(new \Exception('Database error'));
    
    $response = $this->actingAs($user)
                     ->delete(route('account.destroy'));
    
    $response->assertRedirect();
    $response->assertSessionHas('error');
    
    // User should still be active
    $this->assertEquals(1, $user->fresh()->status);
}

```