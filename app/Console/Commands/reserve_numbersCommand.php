<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\functionController;

class reserve_numbersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reserve_numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test_notify';

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
        $message = "เทส function จองเลข ".date('Y-m-d H:i');
        functionController::line_notify($message,'re3XtYvOnwliWLS3B4pdeTGcMZRU06w6sZPu6zckvYF');

        $this->info('successfully');
        return 0;
    }
}
