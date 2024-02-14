<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.transaksi', [
            'title' => 'Transaksi',
            'data_transaksi' => Transaksi::all(),
        ]);
    }

    public function create()
    {
        $dataSessionInput = Session::get('dataInput');
        return view('transaksi.tambah', [
            'title' => 'Transaksi',
            'data_member' => Member::all(),
            'data_outlet' => Outlet::all(),
            'data_paket' => Paket::all(),
            'jenis_paket' => Paket::distinct('jenis')->pluck('jenis'),
            'dataSessionInput' => $dataSessionInput,
        ]);
    }

    public function detail($id)
    {
        return view('transaksi.detail', [
            'title' => 'Transaksi',
            'data_transaksi' => Transaksi::where('id', $id)->get(),
            'data_d_transaksi' => DetailTransaksi::where('id_transaksi', $id)->get(),
            'data_member' => Member::all(),
            'data_outlet' => Outlet::all(),
            'data_paket' => Paket::all(),
        ]);
    } 

    public function struk(Request $request)
    {
        // Ambil lokasi dan kode invoice dari query string
        $lokasi = $request->query('lokasi');
        $kode_invoice = $request->query('invoice');
    
        // Lakukan logika untuk mendapatkan data transaksi berdasarkan kode invoice
        $transaksi = Transaksi::where('kode_invoice', $kode_invoice)->first();
    
        // Jika transaksi ditemukan, tampilkan view struk dengan data transaksi
        if ($transaksi) {
            return view('transaksi.struk', ['transaksi' => $transaksi, 'lokasi' => $lokasi]);
        } else {
            // Jika tidak ditemukan, redirect atau tampilkan pesan error
            return redirect()->back()->with('toastr', [
                'type' => 'warning',
                'message' => 'Transaksi tidak ditemukan'
            ]);
        }
    }
    

    public function store(Request $request)
    {
        try{
            $request->validate([
                'batas_waktu' => 'required|date',
                'member' => 'required|exists:tb_member,id',
                'outlet' => 'required|exists:tb_outlet,id',
                'biaya_tambahan' => 'nullable|numeric',
                'pajak' => 'nullable|numeric',
                'diskon' => 'nullable|numeric',
                'total_bayar' => 'nullable|numeric',
            ]);

            $transaksi = new Transaksi();
            $transaksi->kode_invoice = 'KP-' . date("YmdHis");
            $transaksi->tgl = date("Y-m-d H:i:s");
            $transaksi->batas_waktu = $request->batas_waktu;
            $transaksi->id_member = $request->member;
            $transaksi->id_outlet = $request->outlet;
            $transaksi->id_user = Auth::id();
            $transaksi->biaya_tambahan = $request->biaya_tambahan ?? 0;
            $transaksi->pajak = $request->pajak ?? 0;
            $transaksi->diskon = $request->diskon ?? 0;
            $transaksi->total_bayar = $request->total_bayar ?? 0;

            $totalHarga = 0;
            if (empty($request->total_bayar)) {
                $transaksi->dibayar = 'belum_dibayar';
                $transaksi->tgl_bayar = null;
            } else {
                $kembalian = $request->total_bayar - ($totalHarga + $request->biaya_tambahan + $request->pajak - $request->diskon);
                if($kembalian < 0){
                    return redirect()->back()->with('toastr', [
                        'type' => 'warning',
                        'message' => 'Total bayar belum cukup'
                    ]);
                }
                $transaksi->dibayar = 'dibayar';
                $transaksi->tgl_bayar = date("Y-m-d H:i:s");
            }

            $transaksi->save();

            $pakets = json_decode($request->pakets);
            foreach ($pakets as $paket) {
                $detailTransaksi = new DetailTransaksi();
                $detailTransaksi->id_transaksi = $transaksi->id;
                $detailTransaksi->id_paket = $paket->kode;
                $detailTransaksi->qty = $paket->jumlah;
                $detailTransaksi->keterangan = $paket->keterangan;
                $detailTransaksi->save();
            }

            return redirect()->route('transaksi.struk', ['invoice' => $transaksi->kode_invoice])->with('toastr', [
                'type' => 'success',
                'message' => 'Transaksi berhasil ditambahkan.'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menambahkan Transaksi.'
            ]);
        }
    }

    public function status(Request $request)
    {
        try{
            $request->validate([
               'id' => 'required|exists:tb_transaksi,id', 
               'transaksi_status' => 'required|in:baru,proses,selesai,diambil',
           ]);

           $transaksi = Transaksi::findOrFail($request->id);
           $transaksi->status = $request->transaksi_status;
           $transaksi->save();

           return redirect()->back()->with('toastr', [
               'type' => 'success',
               'message' => 'Status berhasil diubah.'
           ]);
        } catch (Exception $e){
            return redirect()->back()->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah Status.'
            ]);
        }
    }


    public function bayar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tb_transaksi,id',
            'bayar' => 'required|numeric|min:0',
        ]);
    
        $transaksi = Transaksi::findOrFail($request->id);
    
        $transaksi->total_bayar = $request->bayar;
    
        if ($transaksi->total_bayar >= $transaksi->total_tagihan) {
            $transaksi->dibayar = 'dibayar';
            $transaksi->tgl_bayar = date("Y-m-d H:i:s");
        } else {
            // Jika total bayar belum mencukupi, status tetap sama
        }
    
        $transaksi->save();
    
        return redirect()->back()->with('toastr', [
            'type' => 'success',
            'message' => 'Bayar berhasil diubah.'
        ]);
    }
    
    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:tb_transaksi,id',
                'batas_waktu' => 'required|date',
                'member' => 'required|exists:tb_member,id',
                'outlet' => 'required|exists:tb_outlet,id',
                'biaya_tambahan' => 'nullable|numeric',
                'pajak' => 'nullable|numeric',
                'diskon' => 'nullable|numeric',
                'total_bayar' => 'nullable|numeric',
            ]);

            $transaksi = Transaksi::findOrFail($request->id);
            $transaksi->batas_waktu = $request->batas_waktu;
            $transaksi->id_member = $request->member;
            $transaksi->id_outlet = $request->outlet;
            $transaksi->biaya_tambahan = $request->biaya_tambahan ?? 0;
            $transaksi->pajak = $request->pajak ?? 0;
            $transaksi->diskon = $request->diskon ?? 0;
            $transaksi->total_bayar = $request->total_bayar ?? 0;

            // Check if total_bayar is provided and update the status accordingly
            if (!empty($request->total_bayar)) {
                $totalHarga = 0; // Calculate totalHarga here
                $kembalian = $request->total_bayar - ($totalHarga + $request->biaya_tambahan + $request->pajak - $request->diskon);
                if ($kembalian < 0) {
                    return redirect()->back()->with('toastr', [
                        'type' => 'warning',
                        'message' => 'Total bayar belum cukup'
                    ]);
                }
                $transaksi->dibayar = 'dibayar';
                $transaksi->tgl_bayar = now();
            } else {
                $transaksi->dibayar = 'belum_dibayar';
                $transaksi->tgl_bayar = null;
            }

            $transaksi->save();

            // Update detail transaksi if needed
            // Note: You may need to adjust this logic based on your application requirements
            $pakets = json_decode($request->pakets);
            foreach ($pakets as $paket) {
                $detailTransaksi = DetailTransaksi::updateOrCreate(
                    ['id_transaksi' => $transaksi->id, 'id_paket' => $paket->kode],
                    ['qty' => $paket->jumlah, 'keterangan' => $paket->keterangan]
                );
            }

            // Clear session data after successful update
            Session::forget('dataInput');

            return redirect('/transaksi')->with('toastr', [
                'type' => 'success',
                'message' => 'Transaksi berhasil diubah.'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal mengubah Transaksi.' . $e->getMessage()
            ]);
        }
    }
    
    public function edit($id)
    {
        return view('transaksi.ubah', [
            'title' => 'Transaksi',
            'data_transaksi' => Transaksi::where('id', $id)->get(),
            'data_d_transaksi' => DetailTransaksi::where('id_transaksi', $id)->get(),
            'data_member' => Member::all(),
            'data_outlet' => Outlet::all(),
            'data_paket' => Paket::all(),
            'jenis_paket' => Paket::distinct('jenis')->pluck('jenis'),
        ]);
    }

    public function delete($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            DetailTransaksi::where('id_transaksi', $id)->delete();

            $transaksi->delete();
            return redirect('/transaksi')->with('toastr', [
                'type' => 'success',
                'message' => 'Transaksi berhasil dihapus.'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('toastr', [
                'type' => 'error',
                'message' => 'Gagal menghapus Transaksi.'  . $e->getMessage()
            ]);
        }
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::query();
    
        // Filter berdasarkan tanggal mulai
        if ($request->has('tanggal_mulai')) {
            $query->where('tgl', '>=', $request->tanggal_mulai);
        }
    
        // Filter berdasarkan tanggal selesai
        if ($request->has('tanggal_selesai')) {
            if ($request->has('tanggal_mulai')) {
                if ($request->tanggal_selesai <= $request->tanggal_mulai) {
                    return redirect()->back()->withInput()->with('toastr', [
                        'type' => 'warning',
                        'message' => 'Tanggal Selesai harus lebih tua.'
                    ]);
                }
            }
            $query->where('tgl', '<=', $request->tanggal_selesai);
        }
    
        // Filter berdasarkan user
        if ($request->has('user')) {
            $query->where('id_user', $request->user);
        }
    
        // Filter berdasarkan member
        if ($request->filled('member')) {
            $query->where('id_member', $request->member);
        } 
    
        $data_transaksi = $query->get();
    
        return view('transaksi.laporan', [
            'title' => 'Laporan',
            'data_transaksi' => $data_transaksi,
            'data_user' => User::all(),
            'data_member' => Member::all(),
        ]);
    }
    
    
}