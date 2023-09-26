<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\Pembelian;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Exports\PembelianExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PembelianStoreRequest;
use App\Http\Requests\PembelianUpdateRequest;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Pembelian::class);

        $barang = Barang::latest()->get();
        $pemasok = Pemasok::latest()->get();

        return view('app.pembelians.pembelian', compact('barang', 'pemasok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Pembelian::class);

        $pemasoks = Pemasok::pluck('nama_pemasok', 'id');
        $users = User::pluck('name', 'id');

        return view('app.pembelians.create', compact('pemasoks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'totalTransaksi' => ['required',],
                'pemasok' => ['required', 'exists:pemasoks,id'],
                'barang' => ['required', 'array'],
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Terjadi kesalahan dengan data yang dikirim', 'error' => $validator->errors()], 422);
            }

            $validated = $validator->validated();
    
            $last_pembelian = Pembelian::latest()->first();
            
           
            $kode_masuk = $last_pembelian == null ? 'TP0000001' : sprintf('TP%07d', intval(substr($last_pembelian->kode_masuk, 2)) + 1);

            // return response()->json($kode_masuk);
            $tanggal_masuk = Carbon::now()->format('Y-m-d');
    
            $user = Auth::user();

            DB::beginTransaction();
    
            $pembelian = Pembelian::create([
                'kode_masuk' => $kode_masuk,
                'tanggal_masuk' => $tanggal_masuk,
                'total' => $validated['totalTransaksi'],
                'pemasok_id' => $validated['pemasok'],
                'user_id' => $user->id
            ]);
    
            foreach($validated['barang'] as $barang) {
                DetailPembelian::create([
                    'harga_beli' => $barang['barang']['harga_jual'],
                    'jumlah' => $barang['qty'],
                    'sub_total' => $barang['subTotal'],
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barang['barang']['id']
                ]);
            }
    
            DB::commit();
            
            return response()->json(['message' => 'Transaksi Pembelian Berhasil Dibuat.', 'pembelian' => $pembelian]);
        } catch(Exception $error) {
            DB::rollBack();
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): View
    {
        $this->authorize('view-any', Pembelian::class);

        $tanggal_awal = $request->input('tanggal_awal') ?? null;
        $tanggal_akhir = $request->input('tanggal_akhir') ?? null;

        $sekarang = Carbon::now()->format('Y-m-d');

        $data_pembelian = Pembelian::with(['detailPembelians', 'user', 'pemasok'])->whereTanggalMasuk($sekarang)->get();

        if (!is_null($tanggal_awal) && !is_null($tanggal_akhir)) {
            $data_pembelian = Pembelian::with(['detailPembelians', 'user', 'pemasok'])->whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir])->get();
            
        }

        return view('app.pembelians.data-pembelian', compact('data_pembelian', 'tanggal_awal', 'tanggal_akhir', 'sekarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pembelian $pembelian): View
    {
        $this->authorize('update', $pembelian);

        $pemasoks = Pemasok::pluck('nama_pemasok', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.pembelians.edit',
            compact('pembelian', 'pemasoks', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PembelianUpdateRequest $request,
        Pembelian $pembelian
    ): RedirectResponse {
        $this->authorize('update', $pembelian);

        $validated = $request->validated();

        $pembelian->update($validated);

        return redirect()
            ->route('pembelians.edit', $pembelian)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Pembelian $pembelian
    ): RedirectResponse {
        $this->authorize('delete', $pembelian);

        $pembelian->delete();

        return redirect()
            ->route('pembelians.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export(Request $request) {
        $tanggal_awal = $request->input('tanggal_awal_export');
        $tanggal_akhir = $request->input('tanggal_akhir_export');

        return Excel::download(new PembelianExport($tanggal_awal, $tanggal_akhir), 'data pembelian.xlsx');
    }

    public function faktur($id) {

        $pembelian = Pembelian::with('detailPembelians', 'pemasok')->findOrFail($id);
        $order =[
            'kode_masuk' => $pembelian->kode_masuk,
            'tanggal_masuk' => $pembelian->Tanggal_masuk,
            'total' => $pembelian->total,
            'pemasok' => $pembelian->pemasok->nama_pemasok,
            'details' => $pembelian->detailPembelians,
            'tanggal' => $pembelian->tanggal_masuk
        ];
        return view('app.pembelians.faktur', compact('order'));
    }
}
