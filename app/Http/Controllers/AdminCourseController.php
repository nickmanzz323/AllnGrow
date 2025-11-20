<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCourseController extends Controller
{
    /**
     * Update status course (approve/reject)
     */
    public function updateStatus(Request $request, $id)
    {
        // Verify admin is properly authenticated
        $admin = auth('admin')->user();
        if (!$admin) {
            abort(401, 'Unauthorized - Admin authentication required');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'rejection_reason' => 'nullable|string|max:1000',
        ]);

        $course = Course::findOrFail($id);

        $oldStatus = $course->status;
        $course->status = $request->status;
        
        if ($request->status === 'rejected' && $request->rejection_reason) {
            $course->rejection_reason = $request->rejection_reason;
        } else {
            $course->rejection_reason = null;
        }
        
        $course->save();

        Log::info('Admin mengubah status course', [
            'course_id' => $id,
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'admin_id' => auth('admin')->id(),
        ]);

        $statusText = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'pending' => 'dikembalikan ke pending',
        ];

        return redirect()->back()->with('success', "Course berhasil {$statusText[$request->status]}.");
    }
}
