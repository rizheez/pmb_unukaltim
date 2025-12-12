<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DocumentVerification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function markAsRead()
    {
        $biodata = auth()->user()->studentBiodata;
        
        if ($biodata) {
            $updated = DocumentVerification::where('student_biodata_id', $biodata->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
                
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi telah ditandai sebagai dibaca.',
                'updated' => $updated
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Biodata tidak ditemukan.'
        ], 404);
    }
}
