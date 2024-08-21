<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ExportDataToExcel;
use App\Services\BackupUtilityByFolder;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $results = DB::table('form_submissions')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS created_at_month'),
                DB::raw('COUNT(CASE WHEN url_file IS NOT NULL THEN 1 END) AS file_berkas'),
                DB::raw('COUNT(CASE WHEN signed_file IS NOT NULL THEN 1 END) AS file_approve'),
                DB::raw('SUM(CASE WHEN url_file IS NOT NULL THEN 1 ELSE 0 END) + SUM(CASE WHEN signed_file IS NOT NULL THEN 1 ELSE 0 END) AS total_files')
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('created_at_month', 'asc')
            ->get();
        return view('admin.sipa.backup.index', compact('results'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        try {
            $folderNames = ["template-surat", "berita-dashboard"];
            $backupUtility = new BackupUtilityByFolder();
            $zipFileName = $backupUtility->backupFolders($folderNames);
            if ($zipFileName) {
                return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
            } else {
                return redirect()->route('backup.index')->with('error', 'Failed backup');
            }
        } catch (Exception $e) {
            return redirect()->route('backup.index')->with('error', $e->getMessage());
        }
    }


    public function downloadDB()
    {

        try {
            $dateTimeNow = now()->format('Y-m-d-H-i-s');
            Artisan::call('backup:run', [
                '--only-db' => true,
                '--disable-notifications' => true,
            ]);

            $output = Artisan::output();
            $appName = env('APP_NAME');

            $backupDirectory = storage_path('app');

            $backupFileName =  $dateTimeNow . '.zip';

            $backupFilePath = $backupDirectory . '/'  . $appName . '/' . $backupFileName;
            if (file_exists($backupFilePath)) {
                $file = response()->download($backupFilePath);
                return $file;
            } else {
                return response()->json(['error' => 'Backup file not found ' . $backupFilePath], 404);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $fileName = 'form_submissions_' . $id . '.xlsx';
            $folderName = str_replace('-', '', $id);
            $publicPath = 'file/pengajuan-surat/' . $folderName;
            Excel::store(new ExportDataToExcel($id), $fileName);
            File::copy(Storage::path($fileName), public_path($publicPath . "/" . $fileName));
            Storage::delete($fileName);


            $folderPath = public_path($publicPath);
            $zipFilePath = public_path($folderName . '.zip');
            $backupService = new BackupService();
            if ($backupService->backupFolderToZip($folderPath, $zipFilePath)) {
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            }
            return redirect()->route('backup.index')->with('error', 'Failed backup');
        } catch (Exception $e) {
            return redirect()->route('backup.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::table('form_submissions')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", $id)
                ->delete();

            $folderName = str_replace('-', '', $id);
            $publicPath = 'file/pengajuan-surat/' . $folderName;
            if (File::exists($publicPath)) {
                File::deleteDirectory($publicPath);
            }
            return redirect()->route('backup.index')->with('success', 'Delete all data ' . $id . ' successfully.');
        } catch (Exception $e) {
            return redirect()->route('backup.index')->with('error', $e->getMessage());
        }
    }




    /*
    public function store(Request $request)
    {
        $folderName = "template-surat";
        if (!Storage::exists("public/$folderName")) {
            abort(404);
        }
        $zipFileName = "$folderName.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = Storage::files("public/$folderName");

            foreach ($files as $file) {
                if (!$zip->addFile(Storage::path($file), basename($file))) {
                    echo 'Could not add file to ZIP: ' . $file;
                }
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $folderName = "template-surat";
        $publicFolderPath = public_path('file/' . $folderName);
        if (!is_dir($publicFolderPath)) {
            abort(404);
        }
        $zipFileName = "$folderName.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = glob("$publicFolderPath/*");
            foreach ($files as $file) {
                if (!$zip->addFile($file, basename($file))) {
                    echo 'Could not add file to ZIP: ' . $file;
                }
            }
            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $folderNames = ["template-surat", "avatars", "berita-dashboard", "pengajuan-surat"];
        $zipFileName = "multiple_folders.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($folderNames as $folderName) {
                $publicFolderPath = public_path('file/' . $folderName);

                if (!is_dir($publicFolderPath)) {
                    echo "Directory not found: $folderName";
                    continue;
                }

                $files = glob("$publicFolderPath/*");

                foreach ($files as $file) {
                    $fileName = basename($file);
                    if (!$zip->addFile($file, "$folderName/$fileName")) {
                        echo 'Could not add file to ZIP: ' . "$folderName/$fileName";
                    }
                }
            }
            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    */
}
