<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\User;

class CandidateSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Ambil user pertama (pastikan sudah ada user di DB)

        Candidate::create([
            'user_id' => $user->id,
            'image_url' => 'images/sample.jpg',
            'title' => 'Ketua OSIS 2025',
            'chairman' => 'Budi Santoso',
            'vice_chairman' => 'Rina Amelia',
            'vision' => 'Menjadikan sekolah lebih inovatif dan maju.',
            'mision' => '1. Mengembangkan kreativitas siswa\n2. Memperkuat karakter kepemimpinan',
            'ordinal_number' => 1,
        ]);
    }
}