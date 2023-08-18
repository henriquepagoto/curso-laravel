<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        //dd($supports);

        return view('admin/supports/index', compact('supports'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function show(string|int $id)
    {
        if(!$support = Support::find($id)){
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function store(Request $request, Support $support)
    {
        //dd($request->all());
        $data = $request->all();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }
}
