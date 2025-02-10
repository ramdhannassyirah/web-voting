<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\InviteToken;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Cek apakah token ada di URL
            if (!$request->has('token')) {
                return view('vote.error', [
                    'message' => 'Akses ditolak: Token tidak ditemukan.'
                ]);
            }

            $token = $request->token;

            // Cek token
            $invite = InviteToken::where('token', $token)->first();

            if (!$invite) {
                return view('vote.error', [
                    'message' => 'Token tidak valid.'
                ]);
            }

            // Cek apakah token sudah digunakan
            if ($invite->used) {
                $vote = Vote::where('invite_token_id', $invite->id)->first();
                if ($vote) {
                    $candidate = $vote->candidate;
                    return view('vote.used', [
                        'message' => 'Token ini sudah digunakan untuk memilih kandidat: ' . $candidate->name,
                        'voted_at' => $invite->used_at
                    ]);
                }
                return view('vote.used', [
                    'message' => 'Token ini sudah digunakan.',
                    'voted_at' => $invite->used_at
                ]);
            }

            // Token valid dan belum digunakan
            Session::put('vote_token', $token);
            $candidates = Candidate::orderBy('ordinal_number')->get();
            

            return view('vote.index', compact('candidates'));

        } catch (\Exception $e) {
            \Log::error('Vote Error: ' . $e->getMessage());
            return view('vote.error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $validated = $request->validate([
                'candidate_id' => 'required|exists:candidates,id',
                'token' => 'required|string'
            ]);

            // Cek token
            $invite = InviteToken::where('token', $validated['token'])
                               ->where('used', false)
                               ->lockForUpdate()
                               ->first();

            if (!$invite) {
                return response()->json([
                    'error' => true,
                    'message' => 'Token tidak valid atau sudah digunakan'
                ], 400);
            }

            // Simpan vote
            Vote::create([
                'candidate_id' => $validated['candidate_id'],
                'invite_token_id' => $invite->id,
                'user_id' => $invite->user_id  // Mengambil user_id dari invite token
            ]);

            // Update status token
            $invite->update([
                'used' => true,
                'used_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vote berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Vote Error: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

   
}