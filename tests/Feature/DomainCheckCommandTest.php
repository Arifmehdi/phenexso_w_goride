<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DomainCheckCommandTest extends TestCase
{
    public function test_it_writes_the_current_domain_and_reports_changes(): void
    {
        Mail::fake();

        $markerPath = base_path('domain-check.txt');
        file_put_contents($markerPath, 'old.example.com');

        config(['app.url' => 'https://new.example.com']);

        $this->artisan('domain:check')
            ->expectsOutputToContain('Domain changed');

        $this->assertSame('new.example.com', trim(file_get_contents($markerPath)));
    }
}
