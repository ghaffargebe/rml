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
        ->editColumn('tanggal', function($dataset){
            return date("d/m/Y", strtotime($dataset->tanggal));
        })
        ->editColumn('deskripsi', function($dataset){
            $stringCut = substr($dataset->deskripsi, 0, 50);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.URL::to('frontdatadetail/'.$dataset->_id).'">Read More</a>';
            return $string;
        })
        ->editColumn('tipe', function($dataset){
            if (isset($dataset->tipe)) {
                $tipe = explode(";;", $dataset->tipe);
                $ret = '';
                foreach ($tipe as $key) {
                    if ($key == "json") {
                        $label = 'primary';
                    }elseif ($key == 'oai') {
                        $label = 'danger';
                    }elseif ($key == "csv") {
                        $label = 'success';
                    }else{
                        $label = 'default';
                    }
                    $ret .= '<div class="div-td">';
                    $ret .= '<span class="label label-'.$label.'">'.strtoupper($key).'</span>';
                    $ret .= '</div>';
                }
            }else{
                $ret = '<span class="label label-info">Link API</span>';
            }
            return $ret;
        })
        ->make(true);
    }

    public function frontdatadetail($id)
    {
        $dataset = Dataset::find($id);
        $d = str_replace("<p>", "", $dataset->deskripsi);
        $d = str_replace("</p>", "", $d);
        $howto = str_replace("<p>", "", $dataset->howto);
        $howto = str_replace("</p>", "", $howto);

        $filename = explode(";;", $dataset->filename);
        $filenameori = explode(";;", $dataset->filenameori);
        $tipe = explode(";;", $dataset->tipe);
        return view('frontdatadetail')->with(compact('dataset','d','filename','filenameori','tipe','howto'));
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
