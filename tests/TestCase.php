<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Tools\TestTools;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, TestTools;
}
