<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Employee;
use App\Seat;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;

class PatientController extends Controller
{
    public function index()
    {
    	$patients = Patient::with('employee', 'seat')->orderBy('created_at', 'DESC')->paginate(10);
    		return view('patients.index', compact('patients'));
    }

    public function create()
    {
    	$employees = Employee::orderBy('created_at', 'DESC')->paginate(10);

    	$seats = Seat::where('status', 1 )->get();

    		return view('patients.create', compact('employees', 'seats'));
    }

    public function store(Request $request)
    {
    	//validasi data
	    $this->validate($request, [
	        'code' => 'required|string|max:10|unique:patients',
	        'name' => 'required|string|max:100',
	        'gender' => 'required',
	        'birthDate' => 'required',
	        'bloodGroup' => 'required',
	        'symptoms' => 'required|string',
	        'mobile' => 'required|max:15',
	        'email' => 'nullable|email',
	        'address' => 'nullable|string|max:100',
	        'photo' => 'nullable|image|mimes:jpg,png,jpeg',

	        'size' => 'required',
	        'type' => 'required',
	        'employee_id' => 'required|exists:employees,id',
	        'seat_id' => 'required|exists:seats,id'
	    ]);


	    try {
	        //default $photo = null
	        $photo = null;
	        //jika terdapat file (Foto / Gambar) yang dikirim
	        if ($request->hasFile('photo')) {
	            //maka menjalankan method saveFile()
	            $photo = $this->saveFile($request->name, $request->file('photo'));
	        }
	        //Simpan data ke dalam table pasien
	        $patient = Patient::create([
	            'code' => $request->code,
	            'name' => $request->name,
	            'gender' => $request->gender,
	            'birthDate' => $request->birthDate,
	            'bloodGroup' => $request->bloodGroup,
	            'symptoms' => $request->symptoms,
	            'mobile' => $request->mobile,
	            'email' => $request->email,
	            'address' => $request->address,
	            'photo' => $photo,
	            'size' => $request->size,
	            'type' => $request->type,
	            'employee_id' => $request->employee_id,
	            'seat_id' => $request->seat_id
	            
	        ]);
	        $seat = Seat::findOrFail($request->seat_id);
	        $seat->update(['status' => 0]);
	       
	        
	        //jika berhasil direct ke pasien.index
	        return redirect(route('pasien.index'))->with(['success' => '<strong>' . $patient->name . '</strong> Ditambahkan']);
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
    	$path = public_path('uploads/patient');

    	//cek juka yg diuplad bukan folder
    	if (!File::isDirectory($path)){
    		//maka folder tersebut dibuat
    		File::makeDirectory($path, 0777, true, true);
    	}
    	//simpan gambar di upload pasien
    	Image::make($photo)->save($path.'/'.$images);
    	//mengembalikan nama yang ditampung variable
    	return $images;
    }
    public function edit($id)
	{
	    //query select berdasarkan id
	    $patient = Patient::findOrFail($id);
	    $employees = Employee::orderBy('name', 'ASC')->get();

		
	    $seats = Seat::where('status', 1 )->get();

		$seat = Seat::findOrFail($patient->seat_id);


	    return view('patients.edit', compact('patient', 'employees', 'seats', 'seat'));
	}
	public function update(Request $request, $id)
	{
	    //validasi
	    $this->validate($request, [
	        'code' => 'required|string|max:10|exists:patients,code',
	        'name' => 'required|string|max:100',
	        'gender' => 'required',
	        'birthDate' => 'required',
	        'bloodGroup' => 'required',
	        'symptoms' => 'required|string',
	        'mobile' => 'required|max:15',
	        'email' => 'nullable|email',
	        'address' => 'nullable|string|max:100',
	        'photo' => 'nullable|image|mimes:jpg,png,jpeg',

	        'size' => 'required',
	        'type' => 'required',
	        'employee_id' => 'required|exists:employees,id',
	        'seat_id' => 'required|exists:seats,id'
	    ]);
	     try {
	        //query select berdasarkan id
	        $patient = Patient::findOrFail($id);
	        $photo = $patient->photo;

	 
	        //cek jika ada file yang dikirim dari form
	        if ($request->hasFile('photo')) {
	            //cek, jika photo tidak kosong maka file yang ada di folder uploads/doctor akan dihapus
	            !empty($photo) ? File::delete(public_path('uploads/patient/' . $photo)):null;
	            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
	            $photo = $this->saveFile($request->name, $request->file('photo'));
	        }
	        //ubah status kasur
	        $seat1 = Seat::where('id', $id);
	        $seat1->update(['status' => 1]);


	        $seat2 = Seat::findOrFail($request->seat_id);
	        $seat2->update(['status' => 0]);
	 
	        //perbaharui data di database

	        $patient->update([
		            'name' => $request->name,
	            'gender' => $request->gender,
	            'birthDate' => $request->birthDate,
	            'bloodGroup' => $request->bloodGroup,
	            'symptoms' => $request->symptoms,
	            'mobile' => $request->mobile,
	            'email' => $request->email,
	            'address' => $request->address,
	            'photo' => $photo,
	            'size' => $request->size,
	            'type' => $request->type,
	            'employee_id' => $request->employee_id,
	            'seat_id' => $request->seat_id
		        ]);
		         return redirect(route('pasien.index'))
	            ->with(['success' => '<strong>' . $patient->name . '</strong> Diperbaharui']);
	    } catch (\Exception $e) {
	        return redirect()->back()
	            ->with(['error' => $e->getMessage()]);
	    }
	}
	public function destroy($id)
	{
	    //query select berdasarkan id
	    $patients = Patient::findOrFail($id);

	    
	    //mengecek, jika field photo tidak null / kosong
	    if (!empty($patients->photo)) {
	        //file akan dihapus dari folder uploads/produk
	        File::delete(public_path('uploads/patient/' . $patients->photo));
	    }
	    //mengubah status kasur
	    $seat = Seat::findOrFail($patients->seat_id);
	        $seat->update(['status' => 1]);

	    //hapus data dari table
	    $patients->delete();
	    return redirect()->back()->with(['success' => '<strong>' . $patients->name . '</strong> Telah Dihapus!']);
	}
}
