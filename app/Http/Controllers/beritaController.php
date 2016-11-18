<?php

namespace RML\Http\Controllers;

use Illuminate\Http\Request;

use RML\Http\Requests;
use Datatables;
use URL;
use Form;
use RML\Berita;

class beritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('berita-table');
    }

    public function getBerita(){
        $berita = Berita::get();
        return Datatables::of($berita)
        ->editColumn('isi', function($berita){
            return substr($berita->isi, 0, 20).' ...';
        })
        ->editColumn('tanggal', function($berita){
            return date("d F Y", strtotime($berita->tanggal));
        })
        ->editColumn('organisasi',function($berita){
            if (isset($berita->organisasi)) {
                return $berita->organisasi;
            }else{
                return 'Admin';
            }
        })
        ->editColumn('status', function($berita){
            $status = '<center>';
            if ($berita->status == "0") {
                $status .= '<i>Belum Dipublish</i>';
            }elseif($berita->status == "1"){
                $status .= '<i>Sudah Dipublish</i>';
            }elseif($berita->status == "2"){
                $status .= '<b><i>Headline</i></b>';
            }else{
                $status .= '-';
            }
            $status .= '</center>';
            return $status;
        })
        ->addColumn('action',function($berita){
            $button  = '<div class="btn-group-vertical">';
            if ($berita->status == "1") {
                $button .=  '<a class="btn btn-info btn-xs" href="'. URL::to('berita/' . $berita->_id . '/headline'). '"><i class="fa fa-pencil"></i>&nbsp;Headline</a>';
            }
            if ($berita->status == "0") {
                $button .=  '<a class="btn btn-primary btn-xs" href="'. URL::to('berita/' . $berita->_id . '/publish'). '"><i class="fa fa-pencil"></i>&nbsp;Publish</a>';
            }else{
                $button .=  '<a class="btn btn-primary btn-xs" href="'. URL::to('berita/' . $berita->_id . '/unpublish'). '"><i class="fa fa-pencil"></i>&nbsp;UnPublish</a>';
            }
            $button .=  '<a class="btn btn-warning btn-xs" href="'. URL::to('berita/' . $berita->_id . '/edit'). '"><i class="fa fa-pencil"></i>&nbsp;Edit</a>';
            $button .=  Form::open(array('url' => 'berita/' .$berita->id . '', 'class' => 'pull-right')).
                                ''. Form::hidden("_method", "DELETE") .
                                ''. Form::submit("Delete", array("class" => "btn btn-danger btn-xs btn-delete")) .
                                ''. Form::close();
            $button .=  '</div>';
            return $button;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita-create');
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
            'judul' => 'required|max:255',
            'isi'   => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            // 'gambar'=> 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $now = date("YmdHis");

            $tipe = $gambar->getClientOriginalExtension();
            $filenameori = $gambar->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $gambar->move(
                public_path() . '/gambarberita/', $fileName
            );
        }
        
        $pecah = explode("/", $_POST['tanggal']);
        $tanggal = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
        $berita = new Berita;
        $berita->judul = $_POST['judul'];
        $berita->isi = $_POST['isi'];
        $berita->tanggal = $tanggal;
        if ($request->hasFile('gambar')) {
            $berita->filename = $fileName;
            $berita->filenameori = $filenameori;
            $berita->tipe = $tipe;
        }
        $berita->status = "0";
        $berita->save();

        flash('Berita Berhasil Dibuat !','success');
        return redirect('/berita');
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
        $berita = Berita::find($id);
        return view('berita-create')->with('berita',$berita);
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
            'judul' => 'required|max:255',
            'isi'   => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            // 'gambar'=> 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $now = date("YmdHis");

            $tipe = $gambar->getClientOriginalExtension();
            $filenameori = $gambar->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $gambar->move(
                base_path() . '/gambarberita/', $fileName
            );
        }
        
        $pecah = explode("/", $_POST['tanggal']);
        $tanggal = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
        $berita = Berita::find($id);
        $berita->judul = $_POST['judul'];
        $berita->isi = $_POST['isi'];
        $berita->tanggal = $tanggal;
        if ($request->hasFile('gambar')) {
            $berita->filename = $fileName;
            $berita->filenameori = $filenameori;
            $berita->tipe = $tipe;
        }
        $berita->save();

        flash('Berita Berhasil Diubah !','success');
        return redirect('/berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        $berita->delete();

        flash('Berita Berhasil Dihapus','success');
        return redirect('/berita');
    }

    public function publish($id)
    {
        $berita = Berita::find($id);
        $berita->status = "1";
        $berita->save();

        flash('Berita Berhasil Di-Publish !','success');
        return redirect('/berita');
    }

    public function unpublish($id)
    {
        $berita = Berita::find($id);
        $berita->status = "0";
        $berita->save();

        flash('Berita Berhasil Di-UnPublish !','success');
        return redirect('/berita');
    }
    public function headline($id)
    {
        $gethead = Berita::where('status','=','2')->get(array('_id'));
        if ($gethead  == "") {
            $idlama = $gethead[0]->_id;
            $ganti = Berita::find($idlama);
            $ganti->status = "1";
            $ganti->save();
        }
        
        $berita = Berita::find($id);
        $berita->status = "2";
        $berita->save();

        flash('Status Berita menjadi Headline !','success');
        return redirect('/berita');
    }
}
