<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalDataController extends Controller
{
    public function viewDocument(PersonalData $personalData)
    {
        // Check if the file exists
        if (!Storage::disk('private')->exists($personalData->file_path)) {
            abort(404, 'File not found');
        }

        // Get the file path
        $filePath = Storage::disk('private')->path($personalData->file_path);

        // Return the file for viewing/downloading
        return response()->file($filePath, [
            'Content-Type' => $personalData->file_type,
            'Content-Disposition' => 'inline; filename="' . $personalData->original_name . '"'
        ]);
    }
}
