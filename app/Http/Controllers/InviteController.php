<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InviteToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteMail;

class InviteController extends Controller
{
    public function index()
    {
        $invites = InviteToken::latest()->paginate(10);
        return view('admin.invites.index', compact('invites'));
    }

    public function create()
    {
        return view('admin.invites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            DB::beginTransaction();

            // Generate token unik
            $token = $this->generateUniqueToken();

            // Simpan ke database
            $invite = InviteToken::create([
                'token' => $token,
                'user_id' => auth()->id(),
                'email' => $request->email,
                'used' => false
            ]);

            // Buat link undangan
            $inviteLink = url('/vote?token=' . $invite->token);

            // Kirim email undangan
            Mail::to($request->email)->send(new InviteMail($inviteLink));

            DB::commit();

            return redirect()->route('invites.index')
                ->with('success', 'Token berhasil dikirim ke ' . $request->email);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('invites.create')
                ->with('error', 'Gagal mengirim token: ' . $e->getMessage());
        }
    }

    private function generateUniqueToken()
    {
        do {
            $token = Str::random(32);
            $exists = InviteToken::where('token', $token)->exists();
        } while ($exists);

        return $token;
    }

    public function destroy(Request $request, $id)
    {
        $invite = InviteToken::findOrFail($id);
        $invite->delete();
        return redirect()->route('invites.index')->with('success', 'Invite deleted successfully.');
    }
}