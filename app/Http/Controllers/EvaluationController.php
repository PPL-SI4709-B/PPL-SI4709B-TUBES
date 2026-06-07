<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function create($reportId)
    {
        // In a real app, we would find the report by ID
        // $report = Report::findOrFail($reportId);
        $report = [
            'id' => $reportId,
            'umkm_name' => 'Kopi Luwak Ciwidey',
            'period' => 'Kuartal 1 2026',
            'report_content' => 'Laporan perkembangan usaha menunjukkan kenaikan omzet sebesar 15%.',
        ];

        return view('dinas.evaluation.create', compact('report'));
    }

    public function store(Request $request, $reportId)
    {
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'notes' => 'required|string',
            'status' => 'required|in:passed,failed,revision',
        ]);

        // Logic to save evaluation would go here

        return redirect()->route('dinas.report.index')->with('success', 'Evaluasi laporan berhasil disimpan.');
    }
}
