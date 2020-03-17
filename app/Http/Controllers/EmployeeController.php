<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;

class EmployeeController extends Controller
{
    public function index()
	{

    		$employees = Employee::orderBy('created_at', 'DESC')->paginate(10);
    		return view('employees.index', compact('employees'));
	}
	public function create()
	{
	    return view('employees.create');
	}
	public function store(Request $request)
	{
	    //validasi data
	    $this->validate($request, [
	        'code' => 'required|string|max:10|unique:employees',
	        'name' => 'required|string|max:100',
	        'gender' => 'required',
	        'birthDate' => 'required',
	        'charge' => 'required|integer',
	        'mobile' => 'required|max:15',
	        'email' => 'nullable|email',
	        'height' => 'required|string',
	        'weight' => 'required|string',
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
	        $employee = Employee::create([
	            'code' => $request->code,
	            'name' => $request->name,
	            'gender' => $request->gender,
	             'birthDate' => $request->birthDate,
	             'charge' => $request->charge,
	            'mobile' => $request->mobile,
	            'email' => $request->email,
	             'height' => $request->height,
	              'weight' => $request->weight,
	            'photo' => $photo
	        ]);
	        
	        //jika berhasil direct ke dokter.index
	        return redirect(route('pegawai.index'))->with(['success' => '<strong>' . $employee->name . '</strong> Ditambahkan']);
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
    	$path = public_path('uploads/employee');

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
	    $employees = Employee::findOrFail($id);
	    //mengecek, jika field photo tidak null / kosong
	    if (!empty($employees->photo)) {
	        //file akan dihapus dari folder uploads/produk
	        File::delete(public_path('uploads/doctor/' . $employees->photo));
	    }
	    //hapus data dari table
	    $employees->delete();
	    return redirect()->back()->with(['success' => '<strong>' . $employees->name . '</strong> Telah Dihapus!']);
	}
	public function edit($id)
	{
	    //query select berdasarkan id
	    $employee = Employee::findOrFail($id);
	    return view('employees.edit', compact('employee'));
	}
	public function update(Request $request, $id)
	{
	    //validasi
	    $this->validate($request, [
	        'code' => 'required|string|max:10|exists:employees,code',
	        'name' => 'required|string|max:100',
	        'gender' => 'required',
	        'birthDate' => 'required',
	        'charge' => 'required|integer',
	        'mobile' => 'required|max:15',
	        'email' => 'nullable|email',
	        'height' => 'required|string',
	        'weight' => 'required|string',
	        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
	    ]);
	     try {
	        //query select berdasarkan id
	        $employee = Employee::findOrFail($id);
	        $photo = $employee->photo;

	 
	        //cek jika ada file yang dikirim dari form
	        if ($request->hasFile('photo')) {
	            //cek, jika photo tidak kosong maka file yang ada di folder uploads/employee akan dihapus
	            !empty($photo) ? File::delete(public_path('uploads/employee/' . $photo)):null;
	            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
	            $photo = $this->saveFile($request->name, $request->file('photo'));
	        }

	 
	        //perbaharui data di database

	        $employee->update([
		            'name' => $request->name,
		            'gender' => $request->gender,
		             'birthDate' => $request->birthDate,
		             'charge' => $request->charge,
		            'mobile' => $request->mobile,
		            'email' => $request->email,
		             'height' => $request->height,
		              'weight' => $request->weight,
		            'photo' => $photo
		        ]);
		         return redirect(route('pegawai.index'))
	            ->with(['success' => '<strong>' . $employee->name . '</strong> Diperbaharui']);
	    } catch (\Exception $e) {
	        return redirect()->back()
	            ->with(['error' => $e->getMessage()]);
	    }
	}

}
