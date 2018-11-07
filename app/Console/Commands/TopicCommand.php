<?php

namespace App\Console\Commands;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TopicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a record Topic';

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
        if (Carbon::now()->minute < 10) {
            $timeCurrent = Carbon::now()->hour . ':0' . Carbon::now()->minute;
        } else {
            $timeCurrent = Carbon::now()->hour . ':' . Carbon::now()->minute;
        }

        Topic::where([
            ['status', '=', 1],
            ['set_time', '=', 1],
            ['select_time', '=', $timeCurrent],
        ])->each(function ($item) {
            $item->delete();
        });
    }
}
