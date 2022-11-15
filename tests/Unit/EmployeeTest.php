<?php

namespace Tests\Unit;

use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_employee_delete()
    {
        $company = new EmployeeController();
        $delete = $company->delete(10);
        // echo "<pre>";print_r($delete);echo "</pre>";
        $this->assertFalse($delete);
    }
}
