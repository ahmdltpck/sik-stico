<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialist;

class SpecialistController extends Controller
{
    public function index()
    {
    	$specialists = Specialist::orderBy('created_at', 'DESC')->paginate(10);
    	return view('specialists.index', compact('specialists'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|string|max:50',
    		'desciption' => 'nullable|string'
    	]);

    	try{
    		$specialists = Specialist::firstOrCreate([
    			'name' => $request->name,
    			'description' => $request->description
    		]);

    		return redirect()->back()->with(['success' => 'Keahlian '.$specialists->name.' Berhasil Ditambahkan']);
    	} catch (\Exception $e)
    	{
    		return redirect()->back()->with(['error' => $e->getMessage()]);
    	}
    }
    public function destroy($id)
	{
	    $specialists = Specialist::findOrFail($id);
	    $specialists->delete();
	    return redirect()->back()->with(['success' => 'Keahlian ' . $specialists->name . ' Telah Dihapus']);
	}
	public function edit($id)
	{
	    $specialists = Specialist::findOrFail($id);
	    return view('specialists.edit', compact('specialists'));
	}
	public function update(Request $request, $id)
	{
	    //validasi form
	    $this->validate($request, [
	        'name' => 'required|string|max:50',
	        'description' => 'nullable|string'
	    ]);
	    try {
	        //select data berdasarkan id
	        $specialists = Specialist::findOrFail($id);
	        //update data
	        $specialists->update([
	            'name' => $request->name,
	            'description' => $request->description
	        ]);
	        
	        //redirect ke route kategori.index
	        return redirect(route('keahlian.index'))->with(['success' => 'Keahlian ' . $specialists->name . ' diubah']);
	    } catch (\Exception $e) {
	        //jika gagal, redirect ke form yang sama lalu membuat flash message error
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
	}




}
