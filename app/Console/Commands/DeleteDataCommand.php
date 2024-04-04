<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:data {table : The name of the table} {date : The date to delete data until (format: Y-m-d H:i:s)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete data from a specified table until a given date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tableName = $this->argument('table');
        $date = $this->argument('date');

        if (\Schema::hasTable($tableName)) {

            if ($this->isValidDate($date, 'Y-m-d H:i:s')) {

                $batchSize = 1000; // 1000
                $deletedRows = 0;

                do {
                    $deleted = \DB::table($tableName)
                        ->where('created_at', '>=', $date) // created_at registration_date
                        ->limit($batchSize)
                        ->delete();

                    $deletedRows += $deleted;
                } while ($deleted > 0);
                
                $this->info("Data deleted successfully from table: $tableName. Total rows deleted: $deletedRows");

                // $this->info("All data is valid");
            } else {
                $this->error("Invalid date format. Please provide a valid date in format: Y-m-d H:i:s.");
            }
        } else {
            $this->error("Table '$tableName' does not exist in the database.");
        }
    }

    private function isValidDate($value, $format = 'Y-m-d H:i:s')
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }
}
