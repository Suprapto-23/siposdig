<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index()
    {
        // Pluck menjadi [key => object] untuk diakses mudah di Blade
        $pengaturan = Pengaturan::all()->keyBy('key');
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $settings = $request->except(['_token', '_method']);

        DB::transaction(function () use ($settings) {
            foreach ($settings as $key => $value) {
                Pengaturan::where('key', $key)->update(['value' => $value]);
            }
        });

        activity()->causedBy(auth('admin')->user())->log('mengubah pengaturan sistem');

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}