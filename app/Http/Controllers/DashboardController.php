<?php

namespace RML\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RML\Dataset;
use RML\Berita;
use RML\Organisasi;
use RML\User;
use RML\Http\Requests;

class DashboardController extends Controller
{

    public function frontpage(){
        $dataset = Dataset::count();
        $berita = Berita::count();
        $organisasi = Organisasi::count();
        $user = User::count();

        return view('dashboard')->with(compact('dataset','berita','organisasi','user'));
    }


}
