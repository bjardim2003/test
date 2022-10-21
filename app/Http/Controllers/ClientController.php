<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{

    public function index()
    {
        return view('clients.index');
    }

    public function getCustomFilterData(Request $request)
    {
        $clients = Client::select(["*"]);

        return Datatables::of($clients)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != "") {
                    $query->where('name', "like", "{$request->get('name')}%");
                }

                if ($request->has('cpf') && $request->get('cpf') != "") {
                    $query->where('cpf', "like" ,"{$request->get('cpf')}%");
                }

                if ($request->has('rg') && $request->get('rg') != "") {
                    $query->where('rg', "like", "{$request->get('rg')}%");
                }
            })
            ->orderColumn('name', 'name $1')
            ->addColumn('action', function ($model) {
                return '<a href="'.url('clients_edit').'/'.$model->id.'" class="btn btn-sm btn-primary">Alterar</a>
                        <a href="'.url('clients_delete').'/'.$model->id.'" class="btn btn-sm btn-danger">Excluir</a>';
            })
            ->addColumn('address', function ($model) {
                return $model->street.",".$model->number.",".$model->district." - ".$model->city." ".$model->state;
            })
            ->addColumn('birth', function ($model) {
                return date("d-m-Y", strtotime($model->birth));
            })
            ->addColumn('status', function ($model) {
                if (date("Y", strtotime($model->birth)) <= 1950 && in_array(substr($model->cpf, 0, 1), [0,1,2,3])) {
                    return 'OK';
                }
                if (date("Y", strtotime($model->birth)) >= 1951 && date("Y", strtotime($model->birth)) <= 2000 && in_array(substr($model->cpf, 0, 1), [4,5,6])) {
                    return 'OK';
                }
                if (date("Y", strtotime($model->birth)) >= 2001 && in_array(substr($model->cpf, 0, 1), [7,8,9])) {
                    return 'OK';
                }
                return "CUIDADO - POSSIVEL FRAUDE";
            })
            ->make(true);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'birth' => 'required|date',
        ]);

        $dt = explode("-", $request->birth);
        $client = new Client();
        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->rg = $request->rg;
        $client->birth = $dt[2]."-".$dt[1]."-".$dt[0];
        $client->cep = $request->cep;
        $client->street = $request->street;
        $client->number = $request->number;
        $client->district = $request->district;
        $client->city = $request->city;
        $client->state = $request->state;

        if ($request->hasFile('imageUrl')) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->imageUrl->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->imageUrl->storeAs('categories', $nameFile);
            if ( !$upload )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();

            $client->imageUrl = $nameFile;
        }

        $client->save();

        return redirect('clients')
            ->with('success','Cliente criado com sucesso');
    }

    public function edit($id)
    {
        $client = Client::where("id", $id)->first();

        return view('clients.edit', compact("client"));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'birth' => 'required|date',
        ]);

        $dt = explode("-", $request->birth);

        $client = Client::where("id", $request->id)->first();
        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->rg = $request->rg;
        $client->birth = $dt[2]."-".$dt[1]."-".$dt[0];
        $client->cep = $request->cep;
        $client->street = $request->street;
        $client->number = $request->number;
        $client->district = $request->district;
        $client->city = $request->city;
        $client->state = $request->state;

        if ($request->hasFile('imageUrl')) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->imageUrl->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->imageUrl->storeAs('categories', $nameFile);
            if ( !$upload )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();

            $client->imageUrl = $nameFile;
        }

        $client->save();

        return redirect('clients')
            ->with('success','Cliente alterado com sucesso');
    }

    public function delete($id)
    {
        $client = Client::where("id", $id)->delete();

        return redirect('clients')
            ->with('success','Cliente excluido com sucesso');
    }

    public function show()
    {
        return view('clients.show');
    }

    public function getCustomFilterData_show(Request $request)
    {
        $clients = Client::select(["*"]);

        return Datatables::of($clients)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != "") {
                    $query->where('name', "like", "{$request->get('name')}%");
                }

                if ($request->has('cpf') && $request->get('cpf') != "") {
                    $query->where('cpf', "like" ,"{$request->get('cpf')}%");
                }

                if ($request->has('rg') && $request->get('rg') != "") {
                    $query->where('rg', "like", "{$request->get('rg')}%");
                }
            })
            ->orderColumn('name', 'name $1')
            ->addColumn('address', function ($model) {
                return $model->street.",".$model->number.",".$model->district." - ".$model->city." ".$model->state;
            })
            ->addColumn('birth', function ($model) {
                return date("d-m-Y", strtotime($model->birth));
            })
            ->addColumn('status', function ($model) {
                if (date("Y", strtotime($model->birth)) <= 1950 && in_array(substr($model->cpf, 0, 1), [0,1,2,3])) {
                    return 'OK';
                }
                if (date("Y", strtotime($model->birth)) >= 1951 && date("Y", strtotime($model->birth)) <= 2000 && in_array(substr($model->cpf, 0, 1), [4,5,6])) {
                    return 'OK';
                }
                if (date("Y", strtotime($model->birth)) >= 2001 && in_array(substr($model->cpf, 0, 1), [7,8,9])) {
                    return 'OK';
                }
                return "CUIDADO - POSSIVEL FRAUDE";
            })
            ->make(true);
    }

}
