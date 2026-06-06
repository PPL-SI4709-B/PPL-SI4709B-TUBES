<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ReportReviewController extends Controller
{
    public function index()
    {
        return view('dinas.report.index');
    }
    public function show($id)
    {
        return view('dinas.report.show', compact('id'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback' => 'nullable|string'
        ]);
        return redirect()->route('dinas.report.index')->with('success', 'Status laporan berhasil diupdate.');
    }
}