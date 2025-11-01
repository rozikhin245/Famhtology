<?php

namespace App\Http\Controllers;

use App\Models\family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class familyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = family::query();

        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where('Full_name', 'like', "%{$keyword}%"); // Ganti 'nama' sesuai field yang kamu mau cari
        }

        if (auth()->user()->role === 'user') {
            $query->where('status', 'approved');
        }

        $family = $query->paginate(15)->withQueryString(); // biar pagination tetap bawa query search-nya

        return view('FamilyMembers.viewMembers', compact('family'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $family = family::all();
        return view('FamilyMembers.create', compact('family'));
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

        return redirect()->route('FamilyMembers.index')->with('success', 'anggota keluarga berhasil ditambahkan');
    }

    public function liat()
    {
        return view('FamilyMembers.show');
    }


    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $family = family::with(['parent', 'children', 'spouse', 'marriedWith'])->findOrFail($id);

        return response()->json($family);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(family $FamilyMember)
    {
        $families = family::where('id', '!=', $FamilyMember->id)->get();
        return view('FamilyMembers.edit', compact('FamilyMember', 'families'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Full_name' => 'required|string|max:255',
            'Nick_name' => 'nullable|string|max:255',
            'gender'    => 'required|in:L,P',
            'domisili'  => 'required|string|max:255',
            'parent_id' => 'nullable|exists:family,id',
            'spouse_id' => 'nullable|exists:family,id',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'Full_name.required'   => 'Nama lengkap wajib diisi.',
            'Full_name.string'     => 'Nama lengkap harus berupa teks.',
            'Full_name.max'        => 'Nama lengkap maksimal 255 karakter.',
            'Nick_name.string'     => 'Nama panggilan harus berupa teks.',
            'Nick_name.max'        => 'Nama panggilan maksimal 255 karakter.',
            'gender.required'      => 'Jenis kelamin wajib dipilih.',
            'gender.in'            => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
            'domisili.string'      => 'Domisili harus berupa teks.',
            'domisili.max'         => 'Domisili maksimal 255 karakter.',
            'parent_id.exists'     => 'Orang tua yang dipilih tidak ditemukan.',
            'spouse_id.exists'     => 'Pasangan yang dipilih tidak ditemukan.',
            'photo.image'          => 'File harus berupa gambar.',
            'photo.mimes'          => 'Foto harus berformat jpg, jpeg, atau png.',
            'photo.max'            => 'Ukuran foto maksimal 2MB.',
        ]);

        $member = family::findOrFail($id);

        // Upload foto jika ada
        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('photos', 'public');
            $member->photo = $photoPath;
        }

        // Jika parent diganti, update generation_code juga
        if ($request->parent_id != $member->parent_id) {
            if (!$request->parent_id) {
                // Root
                $rootCount = family::whereNull('parent_id')->count();
                $member->generation_code = 'a' . ($rootCount + 1);
            } else {
                $parent = family::find($request->parent_id);
                $siblingCount = family::where('parent_id', $request->parent_id)->count();
                $member->generation_code = $parent->generation_code . '-' . ($siblingCount + 1);
            }
        }

        $member->Full_name = $request->Full_name;
        $member->Nick_name = $request->Nick_name;
        $member->gender = $request->gender;
        $member->domisili = $request->domisili;
        $member->parent_id = $request->parent_id;
        $member->spouse_id = $request->spouse_id;

        $member->save();

        // Binding dua arah dengan spouse
        if ($request->spouse_id) {
            $spouse = family::find($request->spouse_id);
            if ($spouse && !$spouse->spouse_id) {
                $spouse->spouse_id = $member->id;
                $spouse->save();
            }
        }

        return redirect()->route('FamilyMembers.index')->with('success', 'Data anggota keluarga berhasil diperbarui');
    }

    public function familyshow()
    {
        return view('FamilyMembers.familyChart');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = family::findOrFail($id);

        // Optional: Cek dan hapus relasi spouse jika saling terkait
        if ($person->spouse_id) {
            $spouse = family::find($person->spouse_id);
            if ($spouse && $spouse->spouse_id == $person->id) {
                $spouse->spouse_id = null;
                $spouse->save();
            }
        }

        foreach ($person->children as $child) {
            $child->parent_id = null;
            $child->save();
        }

        $person->delete();

        return redirect()->route('FamilyMembers.index')->with('success', 'Anggota berhasil dihapus.');
    }

    public function approve($id)
    {
        $member = Family::findOrFail($id);
        $member->status = 'approved';
        $member->save();


        return redirect()->back()->with('success', 'Data berhasil disetujui.');
    }

    public function reject($id)
    {
        $member = Family::findOrFail($id);
        $member->status = 'rejected';
        $member->save();

        return redirect()->back()->with('warning', 'Data telah ditolak.');
    }


    public function chart()
    {
        // Ambil hanya anggota keluarga yang sudah disetujui
        $members = Family::where('status', 'approved')->get();

        // Ubah logika rootMembers agar pasangan seperti Solihin tidak dianggap root
        $rootMembers = $members->filter(function ($member) use ($members) {
            // Kalau punya parent, jelas bukan root
            if ($member->parent_id) return false;

            // Kalau dia punya pasangan dan pasangan punya parent → berarti dia menikah masuk ke keluarga
            if ($member->spouse_id) {
                $spouse = $members->firstWhere('id', $member->spouse_id);
                if ($spouse && $spouse->parent_id) return false;
            }

            // Kalau tidak punya parent, dan bukan pasangan dari anak, baru kita anggap root
            return true;
        });

        $treeData = $rootMembers->map(function ($root) use ($members) {
            return $this->buildTree($root, $members);
        })->filter()->values()->all();

        return view('FamilyMembers.familyChart', ['treeData' => $treeData]);
    }

    private function buildTree($member, $allMembers, &$visited = [])
    {
        if (!$member || in_array($member->id, $visited)) return null;

        $visited[] = $member->id; // tandai sebagai sudah diproses

        // Hanya ambil anak-anak yang approved
        $children = $allMembers->where('parent_id', $member->id);

        $spouse = $member->spouse;

        $node = [
            'text' => ['name' => $member->Full_name],
        ];

        // Kalau ada pasangan dan belum diproses
        if ($spouse && !in_array($spouse->id, $visited)) {
            $visited[] = $spouse->id;
            $node = [
                'stackChildren' => true,
                'text' => ['name' => $member->Full_name . ' ❤️ ' . $spouse->Full_name]
            ];
        }

        // Rekursi untuk anak-anak yang disetujui
        $node['children'] = $children->map(function ($child) use ($allMembers, &$visited) {
            return $this->buildTree($child, $allMembers, $visited);
        })->filter()->values()->all();

        return $node;
    }
}
