<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ErrorController extends Controller
{
    public function showError(Request $request)
    {
        $logFile = storage_path('logs/user.log'); // Path to the log file

        // Return a message if the log file doesn't exist
        if (!File::exists($logFile)) {
            return view('backend.errors.error', ['filteredLogs' => ['No logs available.']]);
        }
    
        // Read log file and split it into lines (reverse to show latest first)
        $logs = array_reverse(explode("\n", trim(File::get($logFile))));
    
        // Filter logs to match the 'User Error' pattern (if needed)
        $filteredLogs = array_filter($logs, function($log) {
            return strpos($log, 'User Error') !== false; // Filter for User Error logs
        });
    // dd($filteredLogs);
        // Pass the filtered logs to the view
        return view('backend.errors.error', compact('filteredLogs'));
    }
}
