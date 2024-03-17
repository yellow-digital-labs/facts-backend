<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseTriggers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database-triggers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add triggers to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        DB::unprepared('DROP TRIGGER IF EXISTS `events_before_insert`');
        DB::unprepared('CREATE TRIGGER events_before_insert BEFORE INSERT ON `events` FOR EACH ROW
                BEGIN
                    SET NEW.event_remaining_tickets = NEW.event_available_tickets;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `events_before_update`');
        DB::unprepared('CREATE TRIGGER events_before_update BEFORE UPDATE ON `events` FOR EACH ROW
                BEGIN
                    IF NEW.event_available_tickets<>OLD.event_available_tickets THEN
                        
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `events_orders_before_update`');
        DB::unprepared('CREATE TRIGGER events_orders_before_update BEFORE UPDATE ON `events_orders` FOR EACH ROW
                BEGIN
                    
                END');
    }
}
