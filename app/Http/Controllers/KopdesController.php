<?php

namespace App\Http\Controllers;

use App\Models\Kopdes;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KopdesController extends Controller
{
    public function index()
    {
        $kopdes = Kopdes::with('manager')->get();
        return view('kopdes.index', compact('kopdes'));
    }

    public function create()
    {
        $managers = Manager::doesntHave('kopdes')->get();
        return view('kopdes.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_kopdes'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_kopdes'     => 'required|string|max:255',
            'alamat'          => 'required|string',
            'tanggal_berdiri' => 'required|date',
            'manager_id'      => 'required|exists:managers,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_kopdes')) {
            $data['foto_kopdes'] = $request->file('foto_kopdes')->store('kopdes', 'public');
        }

        Kopdes::create($data);

        return redirect()->route('kopdes.index')->with('success', 'Data kopdes berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kopdes = Kopdes::findOrFail($id);

        $managers = Manager::doesntHave('kopdes')
            ->orWhere('id', $kopdes->manager_id)
            ->get();

        return view('kopdes.edit', compact('managers', 'kopdes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_kopdes'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_kopdes'     => 'required|string|max:255',
            'alamat'          => 'required|string',
            'tanggal_berdiri' => 'required|date',
            'manager_id'      => 'required|exists:managers,id',
        ]);

        $kopdes = Kopdes::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_kopdes')) {
            if ($kopdes->foto_kopdes && Storage::disk('public')->exists($kopdes->foto_kopdes)) {
                Storage::disk('public')->delete($kopdes->foto_kopdes);
            }

            $data['foto_kopdes'] = $request->file('foto_kopdes')->store('kopdes', 'public');
        }

        $kopdes->update($data);

        return redirect()->route('kopdes.index')->with('success', 'Data kopdes berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kopdes = Kopdes::findOrFail($id);

        if ($kopdes->foto_kopdes && Storage::disk('public')->exists($kopdes->foto_kopdes)) {
            Storage::disk('public')->delete($kopdes->foto_kopdes);
        }

        $kopdes->delete();

        return redirect()->route('kopdes.index')->with('success', 'Data kopdes berhasil dihapus!');
    }
}
