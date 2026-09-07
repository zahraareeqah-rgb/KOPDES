<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::all();
        return view('manager.index', compact('managers'));
    }

    public function create()
    {
        return view('manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_manager'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_manager'        => 'required|string|max:255',
            'jenis_kelamin'       => 'required',
            'tanggal_lahir'       => 'required|date',
            'Pendidikan_terakhir' => 'required',
            'alamat_manager'      => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_manager')) {
            $data['foto_manager'] = $request->file('foto_manager')->store('manager', 'public');
        }

        Manager::create($data);

        return redirect()->route('manager.index')->with('success', 'Data Manager berhasil disimpan!');
    }

    public function edit($id)
    {
        $manager = Manager::findOrFail($id);
        return view('manager.edit', compact('manager'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_manager'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_manager'        => 'required|string|max:255',
            'jenis_kelamin'       => 'required',
            'tanggal_lahir'       => 'required|date',
            'Pendidikan_terakhir' => 'required',
            'alamat_manager'      => 'required',
        ]);

        $manager = Manager::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_manager')) {
            if ($manager->foto_manager && Storage::disk('public')->exists($manager->foto_manager)) {
                Storage::disk('public')->delete($manager->foto_manager);
            }
            $data['foto_manager'] = $request->file('foto_manager')->store('manager', 'public');
        }

        $manager->update($data);

        return redirect()->route('manager.index')->with('success', 'Data Manager berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);

        if ($manager->foto_manager && Storage::disk('public')->exists($manager->foto_manager)) {
            Storage::disk('public')->delete($manager->foto_manager);
        }

        $manager->delete();

        return redirect()->route('manager.index')->with('success', 'Data Manager berhasil dihapus!');
    }
}
