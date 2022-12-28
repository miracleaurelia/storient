<?php

namespace App\Console\Commands;

use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class dailyFine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fine:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check if book has not been returned past the deadline and increase fine';

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
     * @return int
     */
    public function handle()
    {
        $notReturnedBooks = Loan::where('isReturned', 0)->where('returnDeadlineTime', '<', Carbon::now())->get();

        foreach ($notReturnedBooks as $nrBook) {
            $nrBook->increment('fine', 5000);
        }
    }
}
