<?php

namespace Tests\Unit;

use App\Http\Controllers\CompanyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_company_delete()
    {
        $company = new CompanyController();
        $delete = $company->delete(10);
        // echo "<pre>";print_r($delete);echo "</pre>";
        $this->assertFalse($delete);
    }
}
