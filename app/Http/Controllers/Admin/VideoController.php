<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Dropbox\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoProduk;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class VideoController extends VoyagerBaseController
{
    public function __construct()
    {
    	//Penyiapkan Client Disk Dropbox
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    }

    public function storeCourse(Request $request)
    {
    	//melakukan validasi data
    	$data = $request->validate([
            'pdf' => 'required|file|mimes:pdf',
            'video' => 'required|mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv',
            'name' => 'required' 
        ]); 

    	//membuat variabel berkas
        // $berkas = $request->file('pdf');

        // //membuat nama berkas
        // $namaBerkas = $request->input('name').'-'.uniqid().'.'.$berkas->getClientOriginalExtension();
        // //mengupload berkas
        // $berkas->storeAs('/public/course/', $namaBerkas, 'dropbox');
        // //membuat link untuk berkas
        // $response = $this->dropbox->createSharedLinkWithSettings('/public/course/'.$namaBerkas); 

        $this->uploadToDropbox($request->input('name'), $request->file('pdf'));
        $this->uploadToDropbox($request->input('name'), $request->file('video'));

        

        //memasukan data berkas ke database
        // Berkas::create([
        //     'nama' => $namaBerkas,
        //     'ekstensi' => $berkas->getClientOriginalExtension(),
        //     'ukuran' => $berkas->getSize()
        // ]);

        return redirect()->back()->with('berhasil', 'berkas berhasil di simpan dan upload ke dropbox');
    }

    public function storeVideo(Request $request)
    {
        $data = $request->validate([
            //'pdf' => 'required|file|mimes:pdf',
            'video' => 'required|mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv',
            'name' => 'required' 
        ]);

        $nama = str_replace(' ', '-', $request->input('name'));

        $upload = $this->uploadToDropbox('video', $request->file('video'));

        return response()->json([
            'nama' => $upload
        ], 200);
    }

    public function storePdf(Request $request)
    {
        $data = $request->validate([
            'pdf' => 'required|file|mimes:pdf',
            //'video' => 'required|mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv',
            'name' => 'required' 
        ]);

        $nama = str_replace(' ', '-', $request->input('name'));

        $upload = $this->uploadToDropbox('pdf', $request->file('pdf'));

        return response()->json([
            'nama' => $upload
        ], 200);
    }

    private function uploadToDropbox($name, $file)
    {
        $unique = uniqid();
        try{
            $namaBerkas = $name.'-'.$unique.'.'.$file->getClientOriginalExtension();
            //mengupload berkas
            $file->storeAs('/public/course/'.$name.'/', $namaBerkas, 'dropbox');
            //membuat link untuk berkas
            $response = $this->dropbox->createSharedLinkWithSettings('/public/course/'.$name.'/'.$namaBerkas); 
            return $namaBerkas;
        } catch(Exception $e) {
            return abort(404);
        }
    }

    public function storeAssetsCourse(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required',
            'name' => 'required',
            'video_name' => 'required',
            'pdf_name' => 'required'
        ]);

        $dataInput = array(
            'mentor_id' => $request->input('mentor_id'),
            'name' => $request->input('name'),
            'video_name' => $request->input('video_name'),
            'pdf_name' => $request->input('pdf_name')
        );

        $data = VideoProduk::create($dataInput);

        return redirect('admin/video-produks');
    }
}
