<?php

namespace RML\Http\Controllers;

use Illuminate\Http\Request;
// use RML\Http\Requests\storeDataset;

use RML\Http\Requests;
use RML\Dataset;
use Datatables;
use Auth;
use URL;
use Form;

class datasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dataset-table');
    }

    public function getDataset()
    {
        if (Auth::user()->jenis == 0) {
            $dataset = Dataset::get();
        }else{
            $dataset = Dataset::where('organisasi','=',Auth::user()->organisasi)->get();
        }

        return Datatables::of($dataset)
        ->editColumn('tanggal',function($dataset){
            return date("d F Y",strtotime($dataset->tanggal));
        })
        ->editColumn('tipe', function($dataset){
            if (isset($dataset->tipe)) {
                $tipe = explode(";;", $dataset->tipe);
                $tipe = implode(", ", $tipe);
            }else{
                $tipe = "Link API";
            }
            return $tipe;
        })
        ->editColumn('deskripsi', function($dataset){
            $stringCut = strip_tags($dataset->deskripsi);
            $string = substr($stringCut, 0, 50).'...';
            return $string;//substr($dataset->deskripsi, 0,30).' ...';
        })
        ->addColumn('action', function ($dataset) {
                if (Auth::user()->jenis != 0) {
                    $button = '<div class="btn-group-vertical">
                                 <a class="btn btn-warning btn-xs" href="'. URL::to('dataset/' . $dataset->_id . '/edit'). '"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                '.  Form::open(array('url' => 'dataset/' .$dataset->id . '', "class" => "pull-right")) .
                                ''. Form::hidden("_method", "DELETE") .
                                ''. Form::submit("Delete", array("class" => "btn btn-danger btn-xs btn-delete")) .
                                ''. Form::close() .
                                '</div>';
                }else{
                    $button = '<div class="btn-group-vertical">
                                 <a class="btn btn-default btn-xs" href="#">N/A</a>
                                </div>';
                }
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
        return view('dataset-create');
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
            'organisasi' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            // 'file' => 'mimes:json,jpg'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $now = date("YmdHis");
            for ($i=0; $i < count($file); $i++) { 
                $tipe[$i] = $file[$i]->getClientOriginalExtension();
                $filenameori[$i] = $file[$i]->getClientOriginalName();
                $fileName[$i] = $now.md5($filenameori[$i]).'.'.$tipe[$i];
                $file[$i]->move(
                    base_path() . '/storage/uploads/', $fileName[$i]
                );
            }
            $tipe = array_unique($tipe);
            $tipe = implode(";;", $tipe);

            $filenameori = implode(";;", $filenameori);
            $fileName = implode(";;", $fileName);
        }

        $pecah = explode("/", $_POST['tanggal']);
        $tanggal = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];

        $dataset = new Dataset;
        $dataset->organisasi = $_POST['organisasi'];
        $dataset->deskripsi = $_POST['deskripsi'];
        $dataset->data_desc = $_POST['data_desc'];
        $dataset->tanggal = $tanggal;
        if (isset($_POST['linkapi'])) {
            $dataset->linkapi = $_POST['linkapi'];
            $dataset->howto = $_POST['howto'];
        }
        if ($request->hasFile('file')) {
            $dataset->filename = $fileName;
            $dataset->filenameori = $filenameori;
            $dataset->tipe = $tipe;
        }
        $dataset->save();

        flash('Data Berhasil Ditambahkan !', 'success');
        return redirect('/dataset');
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
        $dataset = Dataset::find($id);
        return view('dataset-create')->with('dataset',$dataset);
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
            'organisasi' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            'howto' => 'required',
            // 'file' => 'mimes:json,jpg'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $now = date("YmdHis");
            // dd(count($file));die;
            for ($i=0; $i < count($file); $i++) { 
                $tipe[$i] = $file[$i]->getClientOriginalExtension();
                $filenameori[$i] = $file[$i]->getClientOriginalName();
                $fileName[$i] = $now.md5($filenameori[$i]).'.'.$tipe[$i];
                $file[$i]->move(
                    base_path() . '/storage/uploads/', $fileName[$i]
                );
            }
            $tipe = array_unique($tipe);
            $tipe = implode(";;", $tipe);

            $filenameori = implode(";;", $filenameori);
            $fileName = implode(";;", $fileName);
        }

        $pecah = explode("/", $_POST['tanggal']);
        $tanggal = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
        $dataset = Dataset::find($id);
        $dataset->organisasi = $_POST['organisasi'];
        $dataset->deskripsi = $_POST['deskripsi'];
        $dataset->tanggal = $tanggal;
        $dataset->linkapi = $_POST['linkapi'];
        $dataset->howto = $_POST['howto'];
        $dataset->data_desc = $_POST['data_desc'];
        if ($request->hasFile('file')) {
            $dataset->filename = $fileName;
            $dataset->filenameori = $filenameori;
            $dataset->tipe = $tipe;
        }
        $dataset->save();

        flash('Data Berhasil Diubah !', 'success');
        return redirect('/dataset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataset = Dataset::find($id);
        $dataset->delete();

        flash('Data Berhasil Dihapus !', 'success');
        return redirect('/dataset');
    }
}
