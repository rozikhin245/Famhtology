<?php

namespace App\Http\Controllers;

use App\Models\photos;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;
use Google\Service\Drive\DriveFile;

class PhotoController extends Controller
{
    public function index(Album $album)
    {
        $photos = $album->photos()->latest()->get();
        return view('photos.index', compact('album', 'photos'));
    }

    public function create(Album $album)
    {
        return view('photos.create', compact('album'));
    }

    public function store(Request $request, Album $album)
    {
        $request->validate([
            'photo' => 'required|array',
            'photo.*' => 'file|image|max:5120', // max 5MB per file
        ]);

        if (!$album->google_drive_folder_id) {
            return back()->with('error', 'Folder Google Drive tidak ditemukan untuk album ini.');
        }


        foreach ($request->file('photo') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();

            // === Upload ke Storage Lokal ===
            $localPath = $file->storeAs('photos', $filename, 'public');
            $publicUrl = Storage::disk('public')->url("photos/{$filename}");

            // === Upload ke Google Drive ===
            $client = new GoogleClient();
            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            $client->refreshToken(config('filesystems.disks.google.refreshToken'));
            $client->fetchAccessTokenWithRefreshToken(config('filesystems.disks.google.refreshToken'));


            $drive = new GoogleDriveService($client);

            $fileMetadata = new DriveFile([
                'name' => $filename,
                'parents' => [$album->google_drive_folder_id]
            ]);

            $content = file_get_contents($file->getRealPath());

            $uploadedFile = $drive->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $file->getMimeType(),
                'uploadType' => 'multipart',
                'fields' => 'id'
            ]);

            $fileId = $uploadedFile->id;
            $fileUrl = "https://drive.google.com/uc?id={$fileId}";

            photos::create([
                'album_id' => $album->id,
                'name' => $filename,
                'google_drive_file_id' => $fileId,
                'google_drive_file_url' => $fileUrl,
                'local_path' => $publicUrl,
            ]);
        }

        // dd($album);

        return redirect()->route('photos.index', $album->id)->with('success', 'Foto berhasil diupload.');
    }



    public function destroy(Album $album, photos $photo)
    {
        // Setup koneksi ke Google Drive
        $client = new GoogleClient();
        $client->setClientId(config('filesystems.disks.google.clientId'));
        $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
        $client->refreshToken(config('filesystems.disks.google.refreshToken'));

        $service = new GoogleDriveService($client);

        try {
            $service->files->delete($photo->google_drive_file_id);
        } catch (\Exception $e) {
            \Log::warning("Gagal hapus file Google Drive: " . $e->getMessage());
        }

        $photo->delete();

        return redirect()->route('photos.index', $album->id)->with('success', 'Foto berhasil dihapus.');
    }
}
