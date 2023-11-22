<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\flower;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //
    public function index() : View
    {
        $flower = flower::get();

        return view('home_page', compact('flower'));
    }

    public function index1() : View
    {
        $flower = flower::get();
        return view('home', compact('flower'));
    }
    public function index2() : View
    {
        $flower = flower::get();
        return view('homeuser', compact('flower'));
    }

    public function create() : View
    {
        return view ('create');
    }

    public function store(Request $request) : RedirectResponse
    {
    $this->validate($request,[
        'nama' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');
    } else {
        $imageName = null; // No image uploaded
    }

    flower::create([
        'nama' => $request->nama,
        'jumlah' => $request->jumlah,
        'harga' => $request->harga,
        'image' => $imageName,
    ]);

    return redirect()->route('flowers.store')->with(['succes' => 'Data Berhasil Disimpan']);
    }

        public function edit(string $id) : View
    {
        $flowers = flower::findOrFail($id);

        return view('edit', compact('flowers'));
    }

    public function destroy(string $id) : RedirectResponse
    {
        $flowers = flower::findOrFail($id);
        $flowers->delete();
        return redirect()->route('flowers.home')->with(['succes'=>'Data Berhasil Dihapus']);
    }

    public function update(Request $request, $id) :RedirectResponse
    {
    $this->validate($request, [
        'nama' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
     ]);

    $flowers = flower::findOrFail($id);
    
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($flowers->image) {
            Storage::delete('public/images/' . $flowers->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');

        $flowers->image = $imageName; // Update the image file name in the database
    }

    $flowers->nama = $request->nama;
    $flowers->jumlah = $request->jumlah;
    $flowers->harga = $request->harga;
    $flowers->save();
    
    return redirect()->route('flowers.home')->with('success', 'Bunga berhasil diperbarui.');
    }

    public function beli($id)
{
    $flower = flower::findOrFail($id);

    if ($flower->jumlah > 0) {
        $flower->jumlah -= 1;
        $flower->save();

        // Tambahkan log pembelian atau transaksi di sini jika diperlukan

        return redirect()->route('flowers.homeuser')->with('success', 'Bunga berhasil dibeli.');
    } else {
        return redirect()->back()->with('error', 'Maaf, stok bunga habis.');
    }
}
}