<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\User;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::where('user_id', auth()->id())->get();
        return view('admin.candidate.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'chairman' => 'required',
            'vice_chairman' => 'required',
            'vision' => 'required',
            'mision' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        $path = $request->file('image') ? $request->file('image')->store('candidates', 'public') : null;

        $candidate = Candidate::create([
            'user_id' => auth()->id(),
            'image_url' => $path,
            'title' => $request->title,
            'chairman' => $request->chairman,
            'vice_chairman' => $request->vice_chairman,
            'vision' => $request->vision,
            'mision' => $request->mision,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }


    public function edit(Candidate $candidate)
    {
        return view('admin.candidate.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'title' => 'required',
            'chairman' => 'required',
            'vice_chairman' => 'required',
            'vision' => 'required',
            'mision' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('candidates', 'public');
            $candidate->image_url = $imagePath;
        }

        $candidate->update([
            'title' => $request->title,
            'chairman' => $request->chairman,
            'vice_chairman' => $request->vice_chairman,
            'vision' => $request->vision,
            'mision' => $request->mision,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}