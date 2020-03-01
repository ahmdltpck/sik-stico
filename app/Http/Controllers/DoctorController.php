<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialist;
use App\Doctor;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;

class DoctorController extends Controller
{
    public function index()
	{
	    $doctors = Doctor::with('specialist')->orderBy('created_at', 'DESC')->paginate(10);
    		return view('doctors.index', compact('doctors'));
	}
	public function create()
	{
	    $specialists = Specialist::orderBy('name', 'ASC')->get();
	    return view('doctors.create', compact('specialists'));
	}
	public function store(Request $request)
	{
	    //validasi data
	    $this->validate($request, [
	        'code' => 'required|string|max:10|unique:doctors',
	        'name' => 'required|string|max:100',
	        'address' => 'nullable|string|max:100',
	        'mobile' => 'required|max:15',
	        'charge' => 'required|integer',
	        'specialist_id' => 'required|exists:specialists,id',
	        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
	    ]);


	    try {
	        //default $photo = null
	        $photo = null;
	        //jika terdapat file (Foto / Gambar) yang dikirim
	        if ($request->hasFile('photo')) {
	            //maka menjalankan method saveFile()
	            $photo = $this->saveFile($request->name, $request->file('photo'));
	        }
	        //Simpan data ke dalam table dokter
	        $doctor = Doctor::create([
	            'code' => $request->code,
	            'name' => $request->name,
	            'address' => $request->address,
	            'mobile' => $request->mobile,
	            'charge' => $request->charge,
	            'specialist_id' => $request->specialist_id,
	            'photo' => $photo
	        ]);
	        
	        //jika berhasil direct ke dokter.index
	        return redirect(route('dokter.index'))->with(['success' => '<strong>' . $doctor->name . '</strong> Ditambahkan']);
	    } catch (\Exception $e) {
	        //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
	}
	private function saveFile($name, $photo)
    {
    	//setnama + time, ekstensi fix
    	$images = Str::slug($name) . time() . '.' . $photo->getClientOriginalExtension();
    	//setpath menyimpan gambar
    	$path = public_path('uploads/doctor');

    	//cek juka yg diuplad bukan folder
    	if (!File::isDirectory($path)){
    		//maka folder tersebut dibuat
    		File::makeDirectory($path, 0777, true, true);
    	}
    	//simpan gambar di upload dokter
    	Image::make($photo)->save($path.'/'.$images);
    	//mengembalikan nama yang ditampung variable
    	return $images;
    }
    public function destroy($id)
	{
	    //query select berdasarkan id
	    $doctors = Doctor::findOrFail($id);
	    //mengecek, jika field photo tidak null / kosong
	    if (!empty($doctors->photo)) {
	        //file akan dihapus dari folder uploads/produk
	        File::delete(public_path('uploads/doctor/' . $doctors->photo));
	    }
	    //hapus data dari table
	    $doctors->delete();
	    return redirect()->back()->with(['success' => '<strong>' . $doctors->name . '</strong> Telah Dihapus!']);
	}
	public function edit($id)
	{
	    //query select berdasarkan id
	    $doctor = Doctor::findOrFail($id);
	    $specialists = Specialist::orderBy('name', 'ASC')->get();
	    return view('doctors.edit', compact('doctor', 'specialists'));
	}
	public function update(Request $request, $id)
	{
	    //validasi
	    $this->validate($request, [
	        'code' => 'required|string|max:10|exists:doctors,code',
	        'name' => 'required|string|max:100',
	        'address' => 'nullable|string|max:100',
	        'mobile' => 'required|max:15',
	        'charge' => 'required|integer',
	        'specialist_id' => 'required|exists:specialists,id',
	        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
	    ]);
	     try {
	        //query select berdasarkan id
	        $doctor = Doctor::findOrFail($id);
	        $photo = $doctor->photo;

	 
	        //cek jika ada file yang dikirim dari form
	        if ($request->hasFile('photo')) {
	            //cek, jika photo tidak kosong maka file yang ada di folder uploads/doctor akan dihapus
	            !empty($photo) ? File::delete(public_path('uploads/doctor/' . $photo)):null;
	            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
	            $photo = $this->saveFile($request->name, $request->file('photo'));
	        }

	 
	        //perbaharui data di database

	        $doctor->update([
		            'name' => $request->name,
		            'address' => $request->address,
		            'mobile' => $request->mobile,
		            'charge' => $request->charge,
		            'specialist_id' => $request->specialist_id,
		            'photo' => $photo
		        ]);
		         return redirect(route('dokter.index'))
	            ->with(['success' => '<strong>' . $doctor->name . '</strong> Diperbaharui']);
	    } catch (\Exception $e) {
	        return redirect()->back()
	            ->with(['error' => $e->getMessage()]);
	    }
	}


}
