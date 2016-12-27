<?php

namespace RML\Http\Controllers;

use RML\Http\Requests;
use Illuminate\Http\Request;
use RML\Organisasi;
use RML\Berita;
use RML\Dataset;
use RML\Slider;
use Datatables;
use URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::where('status','=','2')->get();
        $org = Organisasi::get();
        $slider = Slider::get();
        return view('welcome')->with(compact('berita','org','slider'));
    }

    public function profil($org)
    {
        $org = Organisasi::where('name','=',$org)->get();
        return view('profilOrg')->with('org',$org);
    }

    public function frontdataset()
    {
        $org = Organisasi::get();
        return view('frontdataset')->with(compact('org'));
    }

    public function getFrontDataset($org){
        if ($org == "1") {
            $dataset = Dataset::get();
        }else{
            $dataset = Dataset::where('organisasi','=',$org)->get();
        }

        return Datatables::of($dataset)
        ->editColumn('deskripsi', function($dataset){
            $stringCut = strip_tags($dataset->deskripsi);
            $string = substr($stringCut, 0, 70).'... <a href="'.URL::to('frontdatadetail/'.$dataset->_id).'">Read More</a>';
            return $string;
        })
        ->editColumn('jenis_data', function($dataset){
            if (isset($dataset->jenis_data)) {
                $tipe = implode(",", $dataset->jenis_data);
            }else{
                $tipe = "-";
            }
            return $tipe;
        })
        ->add_column('aksi', function($dataset){
            return '<a href="'.URL::to('frontdatadetail/'.$dataset->_id).'" class="btn btn-info">Detail</a>';
        })
        ->make(true);
    }

    public function frontdatadetail($id)
    {
        $dataset = Dataset::find($id);
        $howto = strip_tags($dataset->howto);
        $kat_data = array('1'=>'Standar','2'=>'Rahasia');
        return view('frontdatadetail')->with(compact('dataset','d','filename','filenameori','tipe','howto','kat_data'));
    }

    public function download($path)
    {
        $path = storage_path('uploads/'.$path);
        return response()->download($path);

    }

    public function news()
    {
        $berita = Berita::where('status','<>','0')->get();

        return view('frontberita')->with('berita',$berita);
    }

    public function frontberitadetail($id)
    {
        $berita = Berita::find($id);
        return view('frontberitadetail')->with(compact('berita'));
    }
}
