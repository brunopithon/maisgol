<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /** @test */
    public function it_checks_database_connection()
    {
        try {
            DB::connection()->getPdo();
            $this->assertTrue(true, 'Conexão com o banco de dados bem-sucedida.');
        } catch (\Exception $e) {
            $this->fail('Conexão com o banco de dados falhou: ' . $e->getMessage());
        }
    }
}
