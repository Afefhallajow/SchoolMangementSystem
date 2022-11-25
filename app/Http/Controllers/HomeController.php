<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\fileExists;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    //    $this->middleware('auth')->except($this->afef());


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function afef()
    {
        return view('dashboard');
    }
    public function tes()

    {// $files=Storage::allFiles('parent_attachments');

        $file=new Filesystem();
       $aa='\1213424' ;
        $files=Storage::allFiles('parent_attachments'.$aa);

        $path='parent_attachments\/1213424\/2';
//        echo $path;
     //   $file->cleanDirectory('storage/app/parent_attachments/');

            Storage::delete($files);

        return $files;
    }


}
