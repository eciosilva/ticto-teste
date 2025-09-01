<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTimeSheet;
use App\Repositories\UserTimeSheetRepository;

class UserTimeSheetController extends Controller
{
    /**
     * Show the timesheet for a user.
     */
    public function timeSheet($id)
    {
        $user = User::findOrFail($id);
        $timesheet = $user->timesheets()->orderBy('work_date', 'desc')->get();

        return view('users.timesheet', compact('timesheet'));
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

        $tipo = 'Batida';
        if (null === $loggedToday) {
            $tipo = 'Entrada';
            $user->timesheets()->create([
                'work_date' => $now->toDateString(),
                'start_time' => $now->toTimeString(),
            ]);
        } else {
            if ($loggedToday->end_time) {
                return redirect()->route('dashboard')->with('error', 'Você já registrou o ponto de saída hoje.');
            }

            $tipo = 'Saída';
            $loggedToday->update([
                'end_time' => $now->toTimeString(),
            ]);
        }

        return redirect()->route('dashboard')->with('success', sprintf('%s registrada com sucesso.', $tipo));
    }

    public function report(UserTimeSheetRepository $userTimeSheetRepository)
    {
        $start = request('start_date', '1900-01-01');
        $end = request('end_date', now()->format('Y-m-d'));
        $timesheet = $userTimeSheetRepository->searchByPeriod($start, $end);
        return view('timesheet.report', compact('timesheet'));
    }
}