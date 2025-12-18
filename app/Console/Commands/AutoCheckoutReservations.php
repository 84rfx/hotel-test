<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class AutoCheckoutReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:auto-checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically check out reservations that have passed their check-out date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for reservations to auto-checkout...');

        // Find reservations that are checked_in and have passed their check-out date
        $expiredReservations = Reservation::whereIn('status', ['confirmed', 'checked_in'])
            ->where('check_out', '<', now()->toDateString())
            ->get();

        if ($expiredReservations->isEmpty()) {
            $this->info('No reservations found that need auto-checkout.');
            return;
        }

        $count = 0;
        foreach ($expiredReservations as $reservation) {
            $reservation->update(['status' => 'completed']);
            $this->line("Completed reservation ID: {$reservation->id} (Check-out date: {$reservation->check_out})");
            $count++;
        }

        $this->info("Successfully auto-checked out {$count} reservation(s).");
    }
}
