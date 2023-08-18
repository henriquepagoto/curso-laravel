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

    public function edit(Support $support, string|int $id)
    {
        if(!$support = $support->where('id', $id)->first()){
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(Request $request, Support $support, string|int $id)
    {
        if(!$support = $support->find($id)){
            return back();
        }

        $support->update($request->only([
            'subject',
            'body'
        ]));

        return redirect()->route('supports.index');
    }

    public function destroy(Support $support, string|int $id)
    {
        if(!$support = $support->find($id)){
            return back();
        }
        $support->delete();

        return redirect()->route('supports.index');
    }
}
