<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;

class MasterDataController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $regions = Region::latest()->get();
        $scales = Scale::latest()->get();

        return view('dinas.master-data.index', compact('categories', 'regions', 'scales'));
    }
}
