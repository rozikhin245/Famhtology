<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Album;
use App\Models\family;
use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController  extends Controller
{

    public function allmembersfamily(Request $request)
    {
        $query = Family::where('status', 'approved');

        // Jika user melakukan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where('Full_name', 'like', "%{$keyword}%");
        }

        // Tampilkan 12 data per halaman dengan pagination
        $allfamilymembers = $query->orderBy('created_at', 'asc')->paginate(12);

        return view('allmembers', compact('allfamilymembers'));
    }




    public function photosDashboard(Album $albumDashboard)
    {
        $photos = $albumDashboard->photos()->latest()->get();
        return view('photos', compact('albumDashboard', 'photos'));
    }

    public function chart()
    {
        Carbon::setLocale('id');
        $today = Carbon::today();

        // Agenda yang akan datang atau hari ini
        $upcomingActivities = Activity::whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->get();

        // Agenda yang sudah lewat (riwayat terbaru di atas)
        $pastActivities = Activity::whereDate('date', '<', $today)
            ->orderBy('date', 'desc')
            ->get();

        $alert = $upcomingActivities->isNotEmpty();

        // untukk menampilkan daftar album
        $albums = Album::orderBy('created_at', 'desc')->limit(6)->get();
        $allalbums = Album::orderBy('created_at', 'desc')->get();

        // untuk menampilkan data awal sebanyak 3 buah
        $family = Family::limit(6)->get();

        // untuk menampilkan chart
        $chartst = Family::where('status', 'approved')->get();
        $rootMembers = $chartst->filter(function ($member) use ($chartst) {
            if ($member->parent_id) return false;

            if ($member->spouse_id) {
                $spouse = $chartst->firstWhere('id', $member->spouse_id);
                if ($spouse && $spouse->parent_id) return false;
            }
            return true;
        });

        $treeData = $rootMembers->map(function ($root) use ($chartst) {
            return $this->buildTree($root, $chartst);
        })->values()->all();

        return view('welcome', compact('family', 'albums', 'allalbums', 'upcomingActivities', 'pastActivities' , 'alert'), ['treeData' => $treeData]);
    }


    private function buildTree($member, $allMembers, &$visited = [])
    {
        if (!$member || in_array($member->id, $visited)) return null;

        $visited[] = $member->id; // tandai sebagai sudah diproses

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
                'text' => ['name' => $member->Full_name . ' & ' . $spouse->Full_name]
            ];
        }

        // Rekursi untuk anak-anak
        $node['children'] = $children->map(function ($child) use ($allMembers, &$visited) {
            return $this->buildTree($child, $allMembers, $visited);
        })->filter()->values()->all();

        return $node;
    }
}
