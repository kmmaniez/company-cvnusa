<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    /* FUNGSI VIEW INDEX CLIENTS */
    public function index()
    {
        return view('admin.client.index', [
            'title' => 'Clients',
            'data' => Clients::all()
        ]);
    }

    /* FUNGSI TAMBAH CLIENTS */
    public function store(ClientRequest $request)
    {
        $imgName = date('HisdmY') . '_' . strtolower(str_replace(' ', '_', $request->nama_client)) . '.' . $request->logo->extension();
        $pathName = Storage::putFileAs('public/clients', $request->file('logo'), $imgName);

        Clients::create([
            'nama' => $request->nama_client,
            'logo' => $pathName,
            'telepon' => $request->telepon_client,
        ]);

        return response()->json([
            'data' => $request->all(),
            'path' => $pathName,
            'message' => 'Data created successfully'
        ]);
    }

    /* FUNGSI LIHAT DATA CLIENTS */
    public function show($client)
    {
        $data = Clients::findOrfail($client);
        return response()->json([
            'data' => $data
        ]);
    }

    /* FUNGSI UPDATE CLIENTS */
    public function update(Request $request, $client)
    {
        if ($request->ajax()) {

            $data = Clients::findOrfail($client);
            if ($request->has('logo')) {

                if ($data->logo != NULL) {
                    Storage::delete($data->logo); // HAPUS FOTO LAMA
                }

                $imgName = date('His_dmY') . '-' . strtolower(str_replace(' ', '_', $request->nama_client)) . '.' . $request->logo->extension();
                $pathName = Storage::putFileAs('public/clients', $request->file('logo'), $imgName);

                $update = $data->update([
                    'nama' => $request->nama_client,
                    'logo' => $pathName,
                    'telepon' => $request->telepon_client,
                ]);

                if ($update) {
                    return response()->json([
                        'data' => $update,
                        'message' => 'Data successfully changed',
                        'client' => $request->all()
                    ]);
                }
            } else {
                $update = $data->update([
                    'nama' => $request->nama_client,
                    'logo' => $data->logo,
                    'telepon' => $request->telepon_client,
                ]);

                if ($update) {
                    return response()->json([
                        'data' => $update,
                        'message' => 'Data successfully changed',
                        'client' => $request->all()
                    ]);
                }
            }
        }
        abort(404);
    }

    /* FUNGSI HAPUS CLIENTS */
    public function destroy($client)
    {
        $data = Clients::findOrfail($client);
        if ($data) {
            Storage::delete($data->logo);
            $data->delete();
            return response()->json([
                'data' => $data,
                'message' => 'sukses',
            ]);
        }
    }

    /* FUNGSI GET ALL CLIENTS DATATABLE*/
    public function getAllClients(Request $request)
    {
        if ($request->ajax()) {
            $model = Clients::all();
            return DataTables::of($model)
                ->editColumn('logo', function ($row) {
                    return view('admin.client.clientdt', [
                        'logo' => $row->logo
                    ]);
                })
                ->editColumn('action', function ($row) {
                    $btn = '
                        <a href="#" data-client="' . $row->id . '" id="btnEditClient" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                        <a href="#" data-client="' . $row->id . '" id="btnHapusClient" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                    ';
                    return $btn;
                })
                ->toJson();
        }
        abort(404);
    }
}
