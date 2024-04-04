<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Csvdata;

class FillDataTableTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateDataCommand()
    {
        echo "Filling database.\n";

        $totalRecords = 100000;

        // Розмір партії для додавання даних
        $batchSize = 1000;

        // Кількість партій, які потрібно створити
        $batchCount = ceil($totalRecords / $batchSize);

        for ($i = 0; $i < $batchCount; $i++) {
            $recordsLeft = $totalRecords - ($i * $batchSize);
            $batchRecords = min($batchSize, $recordsLeft);

            $users = factory(Csvdata::class, $batchRecords)->create();

            echo "Inserted {$batchRecords} records.\n";
        }

        $recordsCount = Csvdata::count();
        $this->assertEquals($totalRecords, $recordsCount, "The database does not have the expected number of records.");
    }
}
