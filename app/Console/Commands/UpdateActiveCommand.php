<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateActiveCommand extends Command
{
    protected $signature = 'update-active';

    protected $description = 'Update something?';

    public function handle()
    {
        try {
            $this->comment("Update active...");
            $this->updateActive();

            $this->comment("Downgrade...");
            $this->downGrade();

            $this->info("Done!");
        } catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }

     private function updateActive()
     {
        Result::update([
            'draw_id'  => 1,
            'isactive' => 0,
        ]);
     }

     private function downGrade()
     {
        UserRole::update([
            'permission' => 1,
            'isactive'   => 2,
        ]);
     }
}