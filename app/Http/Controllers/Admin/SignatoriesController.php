<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignatoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkIfActivated');
        $this->middleware('admin');
    }

    public function updateSignatories(Request $request) {

        $prepared_by = $request->input('prepared_by');
        $prepared_by_position = $request->input('prepared_by_position');
        $recommending_approval = $request->input('recommending_approval');
        $recommending_approval_position = $request->input('recommending_approval_position');
        $approved = $request->input('approved');
        $approved_position = $request->input('approved_position');
        $conforme = $request->input('conforme');
        $conforme_position = $request->input('conforme_position');  
    }

    public function updatepreparedby(Request $request)
    {
        // Validate inputs
        $request->validate([
            'prepared_by' => 'required|string|max:255',
            'prepared_by_position' => 'required|string|max:255',
            'prepared_by_signature' => 'nullable|image|mimes:png', // only PNG, max 2MB
        ]);

        $filename = null;

        // Handle file upload
        if ($request->hasFile('prepared_by_signature')) {
            $file = $request->file('prepared_by_signature');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/signatures'), $filename);
        }

        // Save to DB
        \App\Signatories::create([
            'fullname' => $request->input('prepared_by'),
            'position' => $request->input('prepared_by_position'),
            'role' => 1,
            'signature_path' => $filename ?? '', // store file name/path
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prepared by updated successfully!',
        ]);
    }

    public function updaterecommendingapproval(Request $request)
{
    $recommending_approval = $request->input('recommending_approval');
    $recommending_approval_position = $request->input('recommending_approval_position');
    $signaturePath = null;

    if ($request->hasFile('recommending_approval_signature')) {
        $file = $request->file('recommending_approval_signature');
        $filename = 'recommending_approval_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/signatures'), $filename);
        $signaturePath = $filename;
    }

    \App\Signatories::updateOrCreate(
        ['role' => 2], // make sure only one row per role
        [
            'fullname' => $recommending_approval,
            'position' => $recommending_approval_position,
            'signature_path' => $signaturePath,
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Recommending approval updated successfully!',
    ]);
}

public function updateapproved(Request $request)
{
    $approved = $request->input('approved');
    $approved_position = $request->input('approved_position');
    $signaturePath = null;

    if ($request->hasFile('approved_signature')) {
        $file = $request->file('approved_signature');
        $filename = 'approved_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/signatures'), $filename);
        $signaturePath = $filename;
    }

    \App\Signatories::updateOrCreate(
        ['role' => 3],
        [
            'fullname' => $approved,
            'position' => $approved_position,
            'signature_path' => $signaturePath,
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Approved updated successfully!',
    ]);
}

public function updateconforme(Request $request)
{
    $conforme = $request->input('conforme');
    $conforme_position = $request->input('conforme_position');
    $signaturePath = null;

    if ($request->hasFile('conforme_signature')) {
        $file = $request->file('conforme_signature');
        $filename = 'conforme_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/signatures'), $filename);
        $signaturePath = $filename;
    }

    \App\Signatories::updateOrCreate(
        ['role' => 4],
        [
            'fullname' => $conforme,
            'position' => $conforme_position,
            'signature_path' => $signaturePath,
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Conforme updated successfully!',
    ]);
}

}
