<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $appointments = Appointment::with(['pet.owner', 'veterinarian'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(15);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pets = Pet::with('owner')->orderBy('name')->get(['id', 'name', 'owner_id']);
        $veterinarians = Veterinarian::where('is_active', true)->orderBy('name')->get(['id', 'name', 'specialty']);

        return view('appointments.create', compact('pets', 'veterinarians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->validated());

        return to_route('appointments.index')
            ->with('success', 'Appointment scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): View
    {
        $appointment->load(['pet.owner', 'veterinarian']);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment): View
    {
        $pets = Pet::with('owner')->orderBy('name')->get(['id', 'name', 'owner_id']);
        $veterinarians = Veterinarian::where('is_active', true)->orderBy('name')->get(['id', 'name', 'specialty']);

        return view('appointments.edit', compact('appointment', 'pets', 'veterinarians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validated());

        return to_route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Update the appointment status (AJAX).
     */
    public function updateStatus(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Pending,In Consultation,Attended'],
        ]);

        $appointment->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $appointment->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();

        return to_route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
