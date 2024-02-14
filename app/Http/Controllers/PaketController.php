<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use Exception;

class PaketController extends Controller
{

    public function index(){
        return view('master.paket', [
            'title' => 'Paket',
            'data_paket' => Paket::all(),
        ]);
    }

    public function create(Request $request){
        try{
            $request->validate([
                'jenis' => 'required|string',
                'nama_paket' => 'required|string',
                'harga' => 'required|numeric',
            ]);

            Paket::create([
                'jenis' => $request->jenis,
                'nama_paket' => $request->nama_paket,
                'harga' => $request->harga,
            ]);
            
            return redirect('/paket')->with('toastr', [
                'type' => 'success',
                'message' => 'Paket berhasil ditambahkan.'
            ]);
        } catch (Exception $e){
            return redirect('/paket')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menambahkan Paket.'
            ]);
        }
    }

    public function update(Request $request, $id){
        try{
            $request->validate([
                'jenis' => 'required|string',
                'nama_paket' => 'required|string',
                'harga' => 'required|numeric',
            ]);

            Paket::where('id', $id)->update([
                'jenis' => $request->jenis,
                'nama_paket' => $request->nama_paket,
                'harga' => $request->harga,
            ]);
            
            return redirect('/paket')->with('toastr', [
                'type' => 'success',
                'message' => 'Paket berhasil diubah.'
            ]);
        } catch (Exception $e){
            return redirect('/paket')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah Paket.'
            ]);
        }
    }

    public function delete($id){
        try{
            $paket = Paket::where('id', $id)->delete();
            
            return redirect('/paket')->with('toastr', [
                'type' => 'success',
                'message' => 'Paket berhasil dihapus.'
            ]);
        } catch (Exception $e){
            return redirect('/paket')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menghapus Paket.'
            ]);
        }
    }
}
