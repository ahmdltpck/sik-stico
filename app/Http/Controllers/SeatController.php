<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seat;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;

class SeatController extends Controller
{
    public function index()
    {
    	$seats = Seat::orderBy('created_at', 'DESC')->paginate(10);
    	return view('seats.index', compact('seats'));
    }

    public function store(Request $request)
    {
    	  //validasi data
	    $this->validate($request, [
	        'seatNo' => 'required|string|max:10',
	        'seatFloor' => 'required|string|max:10',
	        'seatType' => 'nullable|string|max:100',
	        'image' => 'nullable|image|mimes:jpg,png,jpeg', 
	        'size' => 'required|string'
	    ]);


	    try {
	        //default $photo = null
	        $image = null;
	        //jika terdapat file (Foto / Gambar) yang dikirim
	        if ($request->hasFile('image')) {
	            //maka menjalankan method saveFile()
	            $image = $this->saveFile($request->name, $request->file('image'));
	        }
	        //Simpan data ke dalam table kasur
	        $seat = Seat::firstOrCreate([
	            'seatNo' => $request->seatNo,
	            'seatFloor' => $request->seatFloor,
	            'seatType' => $request->seatType,
	            'status' => true , 
	            'image' => $image,
	            'size' => $request->size,
	         
	           
	        ]);
	        
	        //jika berhasil direct ke kasur.index
	        return redirect(route('kasur.index'))->with(['success' => '<strong>' . $seat->seatNo . '</strong> Ditambahkan']);
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
    	$path = public_path('uploads/seat');

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
	    $seats = Seat::findOrFail($id);
	    $seats->delete();
	    return redirect()->back()->with(['success' => 'Kasur ' . $seats->seatNo . ' Telah Dihapus']);
	}

	public function edit(Request $request,$id)
    {

    	$seats = Seat::orderBy('created_at', 'DESC')->paginate(10);

        $seat = Seat::findOrFail($id);
        return view('seats.edit',compact('seats','seat'));
    }
    public function update(Request $request, $id)
    {
    	  //validasi data
	    $this->validate($request, [
	        'seatNo' => 'required|string|max:10',
	        'seatFloor' => 'required|string|max:10',
	        'seatType' => 'nullable|string|max:100',
	        'image' => 'nullable|image|mimes:jpg,png,jpeg', 
	        'size' => 'required|string'
	    ]);


	    try{

    $seat = Seat::findOrFail($id);
    $image = $seat->image;

    if ($request->hasFile('image')){

        !empty($image) ? File::delete(public_path('uploads/seat/' . $image)):null;
        $image = $this->saveFile($request->name, $request->file('image'));

    }
	        $seat->update([
	            'seatNo' => $request->seatNo,
	            'seatFloor' => $request->seatFloor,
	            'seatType' => $request->seatType , 
	            'image' => $image,

	            'size' => $request->size,
	            'status' => $request->status
	         
	           
	        ]);
	        
	        //jika berhasil direct ke kasur.index
	        return redirect(route('kasur.index'))->with(['success' => '<strong>' . $seat->seatNo . '</strong> Diedit']);
	    } catch (\Exception $e) {
	        //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
    }

	

}
