<?php


namespace Tests\Tools;


use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Tools\RefreshDatabaseWithData;

abstract class AuthedRequestSuite extends TestCase
{
    use WithFaker, RefreshDatabaseWithData;


    protected function setUp(): void
    {
        parent::setUp();
    }



}
