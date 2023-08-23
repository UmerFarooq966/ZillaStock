<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\RejectedImage;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function showReportForm(Image $image)
    {
        return view('reports.form', compact('image'));
    }

    public function storeReport(Request $request, Image $image)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $report = new Report();
        $report->image_id = $image->id;
        $report->reporter_id = auth()->id();
        $report->reason = $request->input('reason');
        $report->status = 'pending';
        $report->save();

        $image->reported = true;
        $image->increment('report_count');
        $image->save();

        return redirect()->route('home')->with('success', 'Image reported successfully.');
    }

    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');

        // Retrieve reports based on the specified status
        $reports = Report::with('image')
            ->whereHas('image', function ($query) use ($status) {
                $query->where('state', $status === 'pending' ? 1 : 2);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('image_id');

        return view('reports.index', compact('reports', 'status'));
    }


    public function remove(Report $report)
    {

        $image = $report->image;

        $image->decrement('report_count');
        $report->delete();
        return redirect()->back()->with('success', 'Report removed successfully.');
    }

    public function changeStatus(Request $request, Image $image)
    {
        $user_id = $request->user()->id;

        // Validate the reason for rejection
        $request->validate([
            'reason' => 'required'
        ]);

        // Create a new rejection reason
        $rejection = new RejectedImage([
            'image_id' => $image->id,
            'rejection_reason' => $request->reason,
            'rejection_date' => now(),
            'team_id' => $user_id
        ]);

        // Save the rejection reason
        $rejection->save();

        // Update the image state to rejected
        $image->state = 2;
        $image->save();

        // Check if the image state is 2
        if ($image->state == 2) {
            // Find the corresponding report and update its status to "approved"
            $report = Report::where('image_id', $image->id)->first();
            if ($report) {
                $report->status = 'approved';
                $report->save();
            }
        }

        return redirect()->back()->with('success', 'Image status changed successfully.');
    }


}
