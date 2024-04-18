<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteDataCommand extends Command
{
    const BATCHSIZE = 1000; //1000

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

        if (!\Schema::hasTable($tableName)) {
            $this->error("Table '$tableName' does not exist in the database.");
            return;
        }

        if (!$this->isValidDate($date, 'Y-m-d H:i:s')) {
            $this->error("Invalid date format. Please provide a valid date in format: Y-m-d H:i:s.");
            return;
        }

        $deletedRows = 0;

        do {
            $deleted = \DB::table($tableName)
                ->where('created_at', '>=', $date) // created_at registration_date
                ->limit(self:BATCHSIZE)
                ->delete();
            $deletedRows += $deleted;
        } while ($deleted > 0);
                
        $this->info("Data deleted successfully from table: $tableName. Total rows deleted: $deletedRows");

        // $this->info("All data is valid"); 
    }

    private function isValidDate($value, $format = 'Y-m-d H:i:s') : bool
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }
}
