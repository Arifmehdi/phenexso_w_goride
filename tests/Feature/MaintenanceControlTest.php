<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MaintenanceControlTest extends TestCase
{
    protected function tearDown(): void
    {
        Artisan::call('up');
        parent::tearDown();
    }

    public function test_it_can_enable_maintenance_mode_with_valid_secret(): void
    {
        $secret = 'goride-maintenance-secret';
        $response = $this->get('/' . $secret . '/maintenance/enable');

        $response->assertStatus(200);
        $this->assertTrue(app()->isDownForMaintenance());
    }

    public function test_it_can_disable_maintenance_mode_with_valid_secret(): void
    {
        Artisan::call('down', ['--secret' => 'goride-maintenance-secret']);

        $secret = 'goride-maintenance-secret';
        $response = $this->get('/' . $secret . '/maintenance/disable');

        $response->assertStatus(200);
        $this->assertFalse(app()->isDownForMaintenance());
    }

    public function test_it_rejects_invalid_secret(): void
    {
        $response = $this->get('/invalid-secret/maintenance/enable');

        $response->assertStatus(403);
    }
}
