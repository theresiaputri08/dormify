<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Response;
use App\Models\Category;
use App\Models\Dormitory;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['category', 'dormitory', 'responses']);

        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%')
                  ->orWhereHas('category', function ($categoryQuery) use ($request) {
                      $categoryQuery->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('dormitory', function ($dormitoryQuery) use ($request) {
                      $dormitoryQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(5)->withQueryString();

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = Category::all();
        $dormitories = Dormitory::all();

        return view('reports.create', compact('categories', 'dormitories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'dormitory_id' => 'required|exists:dormitories,id',
            'description' => 'required',
            'proof_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('proof_image')) {
            $image = $request->file('proof_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
        }

        Report::create([
            'user_id' => auth()->id(),
            'sender_name' => $request->sender_name,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'dormitory_id' => $request->dormitory_id,
            'description' => $request->description,
            'is_anonymous' => $request->has('is_anonymous'),
            'proof_image' => $imageName,
            'status' => 'Pending',
            'admin_response' => null,
        ]);

        return redirect('/reports')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Report $report)
    {
        if (auth()->user()->role != 'admin' && $report->user_id != auth()->id()) {
            abort(403);
        }

        $report->load(['category', 'dormitory']);
        $responses = $report->responses()->latest()->get();

        return view('reports.show', compact('report', 'responses'));
    }

    public function edit(Report $report)
    {
        if (auth()->user()->role == 'admin') {
            abort(403);
        }

        if ($report->user_id != auth()->id()) {
            abort(403);
        }

        if ($report->status != 'Pending') {
            return redirect('/reports')->with('success', 'Laporan tidak bisa diedit!');
        }

        $categories = Category::all();
        $dormitories = Dormitory::all();

        return view('reports.edit', compact('report', 'categories', 'dormitories'));
    }

    public function update(Request $request, Report $report)
    {
        if (auth()->user()->role == 'admin') {
            abort(403);
        }

        if ($report->user_id != auth()->id()) {
            abort(403);
        }

        if ($report->status != 'Pending') {
            return redirect('/reports');
        }

        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'dormitory_id' => 'required|exists:dormitories,id',
            'description' => 'required',
        ]);

        $report->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'dormitory_id' => $request->dormitory_id,
            'description' => $request->description,
        ]);

        return redirect('/reports')->with('success', 'Laporan berhasil diupdate!');
    }

    public function destroy(Report $report)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $report->delete();

        return redirect('/reports')->with('success', 'Laporan berhasil dihapus!');
    }

    public function updateStatus(Request $request, Report $report)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required',
            'response' => 'nullable',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        if ($request->response) {
            Response::create([
                'report_id' => $report->id,
                'response' => $request->response,
            ]);
        }

        return redirect('/reports/' . $report->id)
            ->with('success', 'Status dan tanggapan berhasil diperbarui!');
    }
}