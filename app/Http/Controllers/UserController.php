<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Outlet;
use Exception;

class UserController extends Controller
{

    public function index(){
        $data = array(
            'title' => 'User',
            'data_user' => User::all(),
            'data_outlet' => Outlet::all(),
        );
        return view('master.user', $data);
    }

    public function profile(){
        $user = Auth::user()->id;

        $data = array(
            'title' => 'Profile',
            'data_profile' => User::where('id', $user)->get(),
        );
        return view('profile', $data);
    }

    public function create(Request $request){
        try{
            User::create([
                'nama'      => $request->nama,
                'username'    => $request->username,
                'password'  => bcrypt($request['password']),
                'id_outlet' => $request->outlet,
                'role'      => $request->role,
            ]);
            return redirect('/user')->with('toastr', [
                'type' => 'success',
                'message' => 'User berhasil ditambahkan.'
            ]);
        } catch (Exception $e){
            return redirect('/user')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menambahkan User.'
            ]);
        }
    }

    public function update(Request $request, $id){
        try{
            User::where('id', $id)
            ->where('id', $id)
                ->update([
                    'nama'      => $request->nama,
                    'username'    => $request->username,
                    'password'  => bcrypt($request['password']),
                    'id_outlet' => $request->outlet,
                    'role'      => $request->role,
                ]);
                return redirect('/user')->with('toastr', [
                    'type' => 'success',
                    'message' => 'User berhasil diubah.'
                ]);
        } catch (Exception $e){
            return redirect('/user')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah User.'
            ]);
        }
    }

    public function delete($id){
        try{
            $outlet = User::where('id', $id)->delete();
            return redirect('/user')->with('toastr', [
                'type' => 'success',
                'message' => 'User berhasil dihapus.'
            ]);
        } catch (Exception $e){
            return redirect('/user')->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menghapus User.'
            ]);
        }
    }
}
