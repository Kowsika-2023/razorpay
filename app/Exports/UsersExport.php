<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;
class UsersExport implements FromCollection
{
    private $selectedUserIds;
    public function __construct(array $selectedUserIds)
    {
        $this->selectedUserIds = $selectedUserIds;
        Log::info("selectedUserIds");
        Log::info($selectedUserIds);
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'users.xlsx';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function collection()
    {
        return User::whereIn('id', $this->selectedUserIds)->get();
    }



}
