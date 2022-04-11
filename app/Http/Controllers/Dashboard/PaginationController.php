<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PaginationController extends Controller
{

    function index(){

      $data =   DB::table('orders')->simplePaginate(5);
      return view('orders', compact('data'));
    }
    //
}
