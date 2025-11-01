<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Service\Drive\DriveFile;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;
use Log;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // === SETUP Google Drive Client ===
        $client = new GoogleClient();
        $client->setClientId(config('filesystems.disks.google.clientId'));
        $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
        $client->refreshToken(config('filesystems.disks.google.refreshToken'));

        $drive = new GoogleDriveService($client);

        // === BUAT folder baru di Google Drive ===
        $folderMetadata = new DriveFile([
            'name' => $request->name,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [config('filesystems.disks.google.folderId')],
        ]);

        try {
            $folder = $drive->files->create($folderMetadata, ['fields' => 'id']);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Gagal membuat folder di Google Drive: ' . $e->getMessage()
            ]);
        }

        // === SIMPAN album ke database ===
        Album::create([
            'name' => $request->name,
            'google_drive_folder_id' => $folder->id,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album berhasil dibuat.');
    }



    public function edit(Album $album)
    {
        // return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // === SETUP Google Drive Client ===
        $client = new GoogleClient();
        $client->setClientId(config('filesystems.disks.google.clientId'));
        $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
        $client->refreshToken(config('filesystems.disks.google.refreshToken'));

        $drive = new GoogleDriveService($client);

        // === RENAME folder di Google Drive ===
        $folderMetadata = new \Google\Service\Drive\DriveFile([
            'name' => $request->name,
        ]);

        try {
            $drive->files->update($album->google_drive_folder_id, $folderMetadata);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Gagal rename folder di Google Drive: ' . $e->getMessage()
            ]);
        }

        // === UPDATE di Database ===
        $album->update([
            'name' => $request->name,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album berhasil diupdate.');
    }


    public function destroy(Album $album)
    {
        // Setup koneksi ke Google Drive
        $client = new GoogleClient();
        $client->setClientId(config('filesystems.disks.google.clientId'));
        $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
        $client->refreshToken(config('filesystems.disks.google.refreshToken'));

        $service = new GoogleDriveService($client);

        try {
            $service->files->delete($album->google_drive_folder_id);
        } catch (\Exception $e) {
            // log atau abaikan error jika folder sudah tidak ada
            Log::warning('Gagal menghapus folder Drive: ' . $e->getMessage());
        }

        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album berhasil dihapus.');
    }
}
