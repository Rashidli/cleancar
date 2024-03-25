<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChangeStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:status';
    protected $description = 'Change reservation statuses based on some conditions.';


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
        $current_time = Carbon::now();
        $reservations = Reservation::whereHas('reservation_statuses', function ($query) {
            $query->where('status', 1);
        })
            ->with('reservation_statuses','user')
            ->where('day','=',Carbon::today()->format('d.m.Y'))
            ->whereTime('time', '<=', $current_time->format('H:i'))
            ->has('reservation_statuses', '=', 1)
            ->get();

        foreach ($reservations as $reservation){
            $reservation->reservation_statuses()->create([
                'reservation_id' =>$reservation->id,
                'user_id' =>$reservation->user->id,
                'user_type' =>$reservation->user->type,
                'status' => 4
            ]);
        }
        $this->info('Status change process completed successfully.');
    }
}
