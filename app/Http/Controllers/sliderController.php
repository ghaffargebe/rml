<?php

namespace RML\Http\Controllers;

use Illuminate\Http\Request;

use RML\Http\Requests;
use RML\Slider;
use Datatables;
use Form;
use URL;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('slider');
    }

    public function getSlider(){
        $slider = Slider::get();
        return Datatables::of($slider)
        ->editColumn('filename', function($slider){
            return '<img src="'.URL::asset("gambarslider/".$slider->filename).'" class="img img-responsive" />';
        })
        ->addColumn('action',function($slider){
            $button  = '<div class="btn-group">';
            $button .=  '<a class="btn btn-warning btn-xs" href="'. URL::to('slider/' . $slider->_id . '/edit'). '"><i class="fa fa-pencil"></i>&nbsp;Edit</a>';
            $button .=  Form::open(array('url' => 'slider/' .$slider->id . '', 'class' => 'pull-right')).
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
        return view('slider-create');
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
            // 'gambar'=> 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $now = date("YmdHis");

            $tipe = $gambar->getClientOriginalExtension();
            $filenameori = $gambar->getClientOriginalName();
            $fileName = $now.md5($filenameori).'.'.$tipe;
            $gambar->move(
                public_path() . '/gambarslider/', $fileName
            );
        }

        $slider = new Slider;
        if ($request->hasFile('gambar')) {
            $slider->filename = $fileName;
            $slider->filenameori = $filenameori;
            $slider->tipe = $tipe;
        }
        $slider->save();

        flash('Gambar slider berhasil ditambahkan !','success');
        return redirect('/slider');
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
        $slider = Slider::find($id);
        return view('slider-create')->with('slider',$slider);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
