<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{

    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $file_name = str_replace(config('backup.backup.name') . '/', '', $f);
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($f)),
                    'created_at' => Carbon::parse($disk->lastModified($f))->diffForHumans(),
                    'download_link' => action('Backend\BackupController@download', [$file_name]),
                ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        return view('backend.backups', compact('backups'));
    }


    private function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // start the backup process
        Artisan::call('backup:run');

        notify()->success('Backup Created Successfully.', 'Added');
        return back();
    }


    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(
                function () use ($stream) {
                    fpassthru($stream);
                },
                200,
                [
                    "Content-Type" => $fs->getMimetype($file),
                    "Content-Length" => $fs->getSize($file),
                    "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists(config('backup.backup.name') . '/' . $file_name))
        {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
        }

        notify()->success('Backup Successfully Deleted.', 'Deleted');
        return back();
    }


    public function clean()
    {
        // clean the backup process
        Artisan::call('backup:clean');

        notify()->success('All Old Backups Successfully Deleted.', 'Added');
        return back();
    }
}
