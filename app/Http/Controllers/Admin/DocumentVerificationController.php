<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentBiodata;
use App\Models\DocumentVerification;
use Illuminate\Http\Request;

class DocumentVerificationController extends Controller
{
    public function verify(Request $request, $biodataId)
    {
        $biodata = StudentBiodata::findOrFail($biodataId);
        
        $request->validate([
            'document_type' => 'required|in:kk,ktp,certificate,photo,biodata',
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Create or update verification
        $verification = DocumentVerification::updateOrCreate(
            [
                'student_biodata_id' => $biodata->id,
                'document_type' => $request->document_type,
            ],
            [
                'verified_by' => auth()->id(),
                'status' => $request->status,
                'notes' => $request->notes,
                'verified_at' => now(),
                'is_read' => false, // Reset is_read when new verification is created
            ]
        );

        $message = $request->status === 'approved' 
            ? 'Dokumen berhasil disetujui.' 
            : 'Dokumen ditolak. Notifikasi telah dikirim ke student.';

        return back()->with('success', $message);
    }

    public function bulkVerify(Request $request, $biodataId)
    {
        $biodata = StudentBiodata::findOrFail($biodataId);
        
        // Log incoming request for debugging
        \Log::info('Verification Request', [
            'biodata_id' => $biodataId,
            'raw_verifications' => $request->verifications,
            'all_input' => $request->all()
        ]);
        
        // Filter out verifications without status
        $verifications = collect($request->verifications ?? [])
            ->filter(function ($verification) {
                return !empty($verification['status']);
            })
            ->toArray();

        if (empty($verifications)) {
            \Log::warning('No verifications selected');
            return back()->with('error', 'Silakan pilih status verifikasi untuk minimal satu dokumen.');
        }

        $request->merge(['verifications' => $verifications]);
        
        $request->validate([
            'verifications' => 'required|array',
            'verifications.*.document_type' => 'required|in:kk,ktp,certificate,photo,biodata',
            'verifications.*.status' => 'required|in:approved,rejected',
            'verifications.*.notes' => 'nullable|string|max:1000',
        ]);

        $count = 0;
        foreach ($verifications as $verificationData) {
            $created = DocumentVerification::updateOrCreate(
                [
                    'student_biodata_id' => $biodata->id,
                    'document_type' => $verificationData['document_type'],
                ],
                [
                    'verified_by' => auth()->id(),
                    'status' => $verificationData['status'],
                    'notes' => $verificationData['notes'] ?? null,
                    'verified_at' => now(),
                    'is_read' => false,
                ]
            );
            
            \Log::info('Verification Created/Updated', [
                'verification_id' => $created->id,
                'document_type' => $verificationData['document_type'],
                'status' => $verificationData['status']
            ]);
            
            $count++;
        }

        // Check and update registration status if all documents are verified
        $user = $biodata->user;
        if ($user && $user->registration) {
            $user->registration->checkAndUpdateVerificationStatus();
        }

        \Log::info('Verification Complete', ['count' => $count]);
        
        return back()->with('success', "Berhasil memverifikasi {$count} dokumen.");
    }
}
