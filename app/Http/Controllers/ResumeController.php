<?php

namespace App\Http\Controllers;

use App\Models\UserResume;
use Illuminate\Http\Request;
use PDF;

class ResumeController extends Controller
{
    public function index()
    {
        return view('resume.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'professional_summary' => 'required|string',
            'education' => 'required|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',
            'education.*.year' => 'required|string',
            'experience' => 'required|array',
            'experience.*.company' => 'required|string',
            'experience.*.position' => 'required|string',
            'experience.*.duration' => 'required|string',
            'experience.*.description' => 'required|string',
            'skills' => 'required|array',
            'languages' => 'required|array',
            'certifications' => 'nullable|array',
        ]);

        $resume = UserResume::create($validated);

        return redirect()->route('resume.download', $resume->id);
    }

    public function download($id)
    {
        $resume = UserResume::findOrFail($id);
        
        $pdf = PDF::loadView('resume.template', compact('resume'));
        
        return $pdf->download('resume.pdf');
    }
}
