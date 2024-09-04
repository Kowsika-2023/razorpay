<?php
namespace App\Helpers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File; // Import the File facade
use Illuminate\Support\Facades\Log;

class FileManagement{


    public static function exportExcel($export,$fileName)
    {
Log::info("start");
          // Generate the Excel file
          Excel::store($export, 'temp/' . $fileName);

          // Define the destination directory
          $destinationDirectory = public_path('export-excel');

          // Create the destination directory if it doesn't exist
          if (!File::exists($destinationDirectory)) {
              File::makeDirectory($destinationDirectory, 0755, true);
          }

          // Move the file to the public/excel directory
          File::move(storage_path('app/temp/' . $fileName), $destinationDirectory . '/' . $fileName);

          // Generate the full download URL
          $url = url('export-excel/' . $fileName);
          Log::info("complete");


        return $url;

    }
   }
