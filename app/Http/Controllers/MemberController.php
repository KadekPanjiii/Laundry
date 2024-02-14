<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Exception;

class MemberController extends Controller
{

    public function index(){
        $data = array(
            'title' => 'Member',
            'data_member' => Member::all(),
        );
        return view('master.member', $data);
    }

    private function formatNomorTelepon($nomorTelepon) {
        if (strpos($nomorTelepon, '0') === 0) {
            return '62' . substr($nomorTelepon, 1);
        }
        return $nomorTelepon;
    }
    
    public function create(Request $request){
        try{
            $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'jk' => 'required|in:L,P',
                'tlp' => 'required|string',
            ]);
    
            Member::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jk,
                'tlp' => $this->formatNomorTelepon($request->tlp),
            ]);
            return redirect('/member')->with('toastr', [
                'type' => 'success',
                'message' => 'Member berhasil ditambahkan.'
            ]);
        } catch (Exception $e){
            return redirect('/member')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menambahkan Member.'
            ]);
        }
    }
    

    public function update(Request $request, $id){
        try{
            $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'jk' => 'required|in:L,P',
                'tlp' => 'required|string',
            ]);
    
            Member::where('id', $id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jk,
                'tlp' => $this->formatNomorTelepon($request->tlp),
            ]);
            return redirect('/member')->with('toastr', [
                'type' => 'success',
                'message' => 'Member berhasil diubah.'
            ]);
        } catch (Exception $e){
            return redirect('/member')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah Member.'
            ]);
        }
    }
    
    public function delete($id){
        try{
            $outlet = Member::where('id', $id)->delete();
            return redirect('/member')->with('toastr', [
                'type' => 'success',
                'message' => 'Member berhasil dihapus.'
            ]);
        } catch (Exception $e){
            return redirect('/member')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menghapus Member.'
            ]);
        }
    }
    
}
