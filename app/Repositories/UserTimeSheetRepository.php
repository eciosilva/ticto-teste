<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserTimeSheetRepository
{
    protected $model;

    public function __construct(User $userTimeSheet)
    {
        $this->model = $userTimeSheet;
    }

    public function searchByPeriod($start, $end)
    {
        $sql = 'SELECT t.id, DATE_FORMAT(t.work_date, "%d/%m/%Y") AS work_date, t.start_time, t.end_time,
                    u.name as employee_name, TIMESTAMPDIFF(YEAR, u.birth_date, NOW()) AS age, u.position,
                    u2.name as manager_name
                FROM users_time_sheet t
                JOIN users u ON t.user_id = u.id
                JOIN users u2 ON u.manager_id = u2.id
                WHERE t.work_date BETWEEN :start AND :end
                    AND u.position = :empregado
                ORDER BY t.work_date DESC';

        return DB::select($sql, [
            'start' => $start, 
            'end' => $end, 
            'empregado' => 'empregado'
        ]);
    }
}