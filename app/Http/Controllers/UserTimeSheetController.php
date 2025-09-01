<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserTimeSheetController extends Controller
{
    /**
     * Show the timesheet for a user.
     */
    public function timeSheet($id)
    {
        $user = User::findOrFail($id);
        $timesheet = $user->timesheets()->orderBy('date', 'desc')->get();

        return view('dashboard', compact('timesheet'));
    }

    /**
     * Register a clock-in time for a user.
     */
    public function registerClockIn()
    {
        $user = auth()->user();
        $now = now();

        $loggedToday = $user->timesheets()
            ->whereDate('work_date', $now->toDateString())
            ->first();

        if (null === $loggedToday) {
            $user->timesheets()->create([
                'work_date' => $now->toDateString(),
                'start_time' => $now->toTimeString(),
            ]);
        } else {
            if ($loggedToday->end_time) {
                return redirect()->route('dashboard')->with('error', 'Você já registrou o ponto de saída hoje.');
            }
            
            $loggedToday->update([
                'end_time' => $now->toTimeString(),
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Ponto registrado com sucesso.');
    }
}