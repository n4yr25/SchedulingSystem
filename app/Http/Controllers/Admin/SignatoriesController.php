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

    public function updatepreparedby(Request $request) {
        $prepared_by = $request->input('prepared_by');
        $prepared_by_position = $request->input('prepared_by_position');

        \App\Signatories::create([
            'fullname' => $prepared_by,
            'position' => $prepared_by_position,
            'role' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prepared by updated successfully!'
        ]);
    }

    public function updaterecommendingapproval(Request $request) {
        $recommending_approval = $request->input('recommending_approval');
        $recommending_approval_position = $request->input('recommending_approval_position');

        \App\Signatories::create([
            'fullname' => $recommending_approval,
            'position' => $recommending_approval_position,
            'role' => 2,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prepared by updated successfully!'
        ]);
    }

    public function updateapproved(Request $request) {
        $approved = $request->input('approved');
        $approved_position = $request->input('approved_position');

        \App\Signatories::create([
            'fullname' => $approved,
            'position' => $approved_position,
            'role' => 3,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prepared by updated successfully!'
        ]);
    }

    public function updateconforme(Request $request) {
        $conforme = $request->input('conforme');
        $conforme_position = $request->input('conforme_position');

        \App\Signatories::create([
            'fullname' => $conforme,
            'position' => $conforme_position,
            'role' => 4,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prepared by updated successfully!'
        ]);
    }
}
