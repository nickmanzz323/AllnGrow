<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\InstructorDetail;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminInstructorController extends Controller
{
    /**
     * Tampilkan daftar instructor yang perlu di-review
     */
    public function index()
    {
        // Ambil semua instructor beserta detail mereka dan courses dengan students count
        $instructors = Instructor::with(['detail', 'courses.students'])->get();
        
        // Ambil semua courses untuk approval
        $courses = Course::with(['instructor.detail', 'subcourses'])->get();
        
        return view('dashboardAdmin.dashboardAdmin', compact('instructors', 'courses'));
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

    /**
     * Delete instructor and all related data
     */
    public function destroy($id)
    {
        try {
            $instructor = Instructor::with(['detail', 'courses'])->findOrFail($id);

            // Log before deletion
            Log::info('Admin menghapus instructor', [
                'instructor_id' => $id,
                'instructor_email' => $instructor->email,
                'courses_count' => $instructor->courses->count(),
                'admin_id' => auth('admin')->id(),
            ]);

            // Delete instructor (cascade will handle related data)
            $instructor->delete();

            return redirect()->back()->with('success', 'Instructor berhasil dihapus beserta semua data terkait.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus instructor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus instructor: ' . $e->getMessage());
        }
    }
}
