<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\InstructorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminInstructorController extends Controller
{
    /**
     * Tampilkan daftar instructor yang perlu di-review
     */
    public function index()
    {
        // Ambil semua instructor beserta detail mereka
        $instructors = Instructor::with('detail')->get();
        
        return view('dashboardAdmin.dashboardAdmin', compact('instructors'));
    }

    /**
     * Update status instructor (approve/reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $instructorDetail = InstructorDetail::where('instructorID', $id)->first();

        if (!$instructorDetail) {
            return redirect()->back()->with('error', 'Instructor detail tidak ditemukan.');
        }

        $oldStatus = $instructorDetail->status;
        $instructorDetail->status = $request->status;
        $instructorDetail->save();

        Log::info('Admin mengubah status instructor', [
            'instructor_id' => $id,
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'admin_id' => auth('admin')->id(),
        ]);

        $statusText = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'pending' => 'dikembalikan ke pending',
        ];

        return redirect()->back()->with('success', "Status instructor berhasil {$statusText[$request->status]}.");
    }
}
