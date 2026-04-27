<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);

        return view('dinas.program.index', compact('programs'));
    }

    public function create()
    {
        return view('dinas.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'quota'       => 'required|integer|min:0',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'status'      => 'required|in:active,inactive',
        ]);

        Program::create($validated);

        return redirect()->route('dinas.program.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('dinas.program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'quota'       => 'required|integer|min:0',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'status'      => 'required|in:active,inactive',
        ]);

        $program->update($validated);

        return redirect()->route('dinas.program.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('dinas.program.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}
