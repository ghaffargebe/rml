<?php

namespace RML\Http\Controllers;

use Illuminate\Http\Request;

use RML\Http\Requests;
use RML\Organisasi;
use Datatables;
use URL;
use Form;

class organisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organisasi-table');
    }

    public function getOrganisasi(){
        $org = Organisasi::get();

        return Datatables::of($org)
        ->addColumn('action', function ($org) {
                $button = '<div class="btn-group-vertical">
                                 <a class="btn btn-warning btn-xs" href="'. URL::to('organisasi/' . $org->_id . '/edit'). '"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                '.  Form::open(array('url' => 'organisasi/' .$org->id . '', "class" => "pull-right")) .
                                ''. Form::hidden("_method", "DELETE") .
                                ''. Form::submit("Delete", array("class" => "btn btn-danger btn-xs btn-delete")) .
                                ''. Form::close() .
                                '</div>';
                return $button;
        })
        ->remove_column('_id')
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organisasi-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:organisasis',
            'deskripsi' => 'required',
            'file' => 'required|max:1000'

        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $now = date("YmdHis");
            $tipe = $file->getClientOriginalExtension();
            $filenameori = $file->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $file->move(
                base_path() . '/public/img/', $fileName
            );
        }

        $org = new Organisasi;
        $org->name = $_POST['name'];
        $org->deskripsi = $_POST['deskripsi'];
        if ($request->hasFile('file')) {
            $org->tipe = $tipe;
            $org->fileName = $fileName;
            $org->filenameori = $filenameori;
        }
        $org->save();

        flash('Data Berhasil Ditambahkan !', 'success');
        return redirect('organisasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = Organisasi::find($id);
        return view('organisasi-create')->with('org',$org);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'file' => 'required|max:1000'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $now = date("YmdHis");
            $tipe = $file->getClientOriginalExtension();
            $filenameori = $file->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $file->move(
                base_path() . '/public/img/', $fileName
            );
        }

        $org = Organisasi::find($id);
        $org->name = $_POST['name'];
        $org->deskripsi = $_POST['deskripsi'];
        if ($request->hasFile('file')) {
            $org->tipe = $tipe;
            $org->fileName = $fileName;
            $org->filenameori = $filenameori;
        }
        $org->save();

        flash('Data Berhasil Diubah !', 'success');
        return redirect('organisasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $org = Organisasi::find($id);
        $org->delete();

        flash('Data Telah Dihapus !', 'success');
        return redirect('organisasi');
    }
}
