<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use Exception;

class OutletController extends Controller
{

    public function index(){
        $data = array(
            'title' => 'Outlet',
            'data_outlet' => Outlet::all(),
        );
        return view('master.outlet', $data);
    }

    public function create(Request $request){
        try{
            $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'tlp' => 'required|string',
            ]);

            Outlet::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
            ]);
            return redirect('/outlet')->with('toastr', [
                'type' => 'success',
                'message' => 'Outlet berhasil ditambahkan.'
            ]);
        } catch (Exception $e){
            return redirect('/outlet')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menambahkan Outlet.'
            ]);
        }
    }

    public function update(Request $request, $id){
        try{
            $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'tlp' => 'required|string',
            ]);

            Outlet::where('id', $id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
            ]);
            return redirect('/outlet')->with('toastr', [
                'type' => 'success',
                'message' => 'Outlet berhasil diubah.'
            ]);
        } catch (Exception $e){
            return redirect('/outlet')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah Outlet.'
            ]);
        }
    }

    public function delete($id){
        try{
            $outlet = Outlet::where('id', $id)->delete();
            return redirect('/outlet')->with('toastr', [
                'type' => 'success',
                'message' => 'Outlet berhasil dihapus.'
            ]);
        } catch (Exception $e){
            return redirect('/outlet')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menghapus Outlet.'
            ]);
        }
    }
}
