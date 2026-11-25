<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with real-time metrics.
     */
    public function index(): View
    {
        $today = Carbon::today();

        // Main table counts
        $totalOwners = Owner::count();
        $totalPets = Pet::count();
        $totalVeterinarians = Veterinarian::where('is_active', true)->count();
        $totalAppointments = Appointment::count();

        // Today's appointments
        $todaysAppointments = Appointment::whereDate('appointment_date', $today)
            ->with(['pet.owner', 'veterinarian'])
            ->orderBy('appointment_date')
            ->get();

        return view('dashboard.index', compact(
            'totalOwners',
            'totalPets',
            'totalVeterinarians',
            'totalAppointments',
            'todaysAppointments'
        ));
    }
}
