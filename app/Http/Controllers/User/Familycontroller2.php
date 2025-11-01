<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\family;
use Illuminate\Http\Request;

class Familycontroller2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Family::query();

        // 🔍 Pencarian
        if ($request->filled('search')) {
            $query->where('Full_name', 'like', "%{$request->search}%");
        }

        // 🔒 Filter untuk user biasa
        if (auth()->user()->role === 'user') {
            $query->where(function ($q) {
                $q->where('status', 'approved')
                    ->orWhere('status', 'pending');
            });
        }

        // 📅 Urutkan dari yang terbaru dan tampilkan 10 per halaman
        $family = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('user_family.index', compact('family'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $family = family::all();
        return view('user_family.create', compact('family'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Full_name' => 'required|string|max:255',
            'Nick_name' => 'nullable|string|max:255',
            'gender'    => 'required|in:L,P',
            'domisili'  => 'required|string|max:255',
            'parent_id' => 'nullable|exists:family,id',
            'spouse_id' => 'nullable|exists:family,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'Full_name.required'   => 'Nama lengkap wajib diisi.',
            'Full_name.string'     => 'Nama lengkap harus berupa teks.',
            'Full_name.max'        => 'Nama lengkap maksimal 255 karakter.',
            'Nick_name.required'   => 'Nama panggilan wajib diisi.',
            'Nick_name.string'     => 'Nama panggilan harus berupa teks.',
            'Nick_name.max'        => 'Nama panggilan maksimal 255 karakter.',
            'gender.required'      => 'Jenis kelamin wajib dipilih.',
            'gender.in'            => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
            'domisili.string'      => 'Domisili harus berupa teks.',
            'domisili.max'         => 'Domisili maksimal 255 karakter.',
            'parent_id.exists'     => 'Orang tua yang dipilih tidak ditemukan.',
            'spouse_id.exists'     => 'Pasangan yang dipilih tidak ditemukan.',
            'photo.string'         => 'Foto harus berupa teks (path gambar).',
            'photo.max'            => 'Path foto maksimal 255 karakter.',
        ]);
        // Default untuk root (tanpa parent)
        if (!$request->parent_id) {
            // Hitung jumlah orang yang tidak punya parent (generasi pertama)
            $rootCount = family::whereNull('parent_id')->count();
            $generationCode = 'a' . ($rootCount + 1); // a1, a2, dst.
        } else {
            $parent = family::find($request->parent_id);

            // Hitung anak keberapa dari parent tersebut
            $siblingCount = family::where('parent_id', $request->parent_id)->count();

            // Bangun kode path-nya
            $generationCode = $parent->generation_code . '-' . ($siblingCount + 1);
        }

        // Upload foto (jika ada)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $newFamilyMembers = family::create([
            'Full_name' =>  $request->Full_name,
            'Nick_name' =>  $request->Nick_name,
            'gender'    =>  $request->gender,
            'domisili'  =>  $request->domisili,
            'parent_id' =>  $request->parent_id,
            'spouse_id' =>  $request->spouse_id,
            'generation_code' => $generationCode,
            'photo'     =>  $photoPath, #$request->photo ,
            'created_by' => auth()->id(),
            'status' => auth()->user()->role === 'admin' ? 'approved' : 'pending',
        ]);

        // Binding dua arah dengan spouse
        if ($request->spouse_id) {
            $spouse = family::find($request->spouse_id);
            if ($spouse && !$spouse->spouse_id) {
                $spouse->spouse_id = $newFamilyMembers->id;
                $spouse->save();
            }
        }

        return redirect()->route('family.index')->with('success', 'anggota keluarga berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $family = family::findOrFail($id);

        // Cek apakah user punya hak hapus
        if (auth()->user()->role === 'user') {
            if ($family->created_by !== auth()->id() || $family->status !== 'pending') {
                return redirect()->back()->with('error', 'Kamu tidak bisa menghapus data ini.');
            }
        }

        // Hapus data
        $family->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
