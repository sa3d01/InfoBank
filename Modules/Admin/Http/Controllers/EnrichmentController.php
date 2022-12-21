<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CreateEnrichmentRequest;
use Modules\Enrichment\Entities\Enrichment;

class EnrichmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $rows = Enrichment::all();
        return view('admin::enrichment.index', compact('rows'));
    }

    public function create()
    {
        return view('admin::enrichment.create');
    }


    public function store(CreateEnrichmentRequest $request)
    {
        Enrichment::create($request->validated());
        return redirect()->route('admin.enrichment.index');
    }


    public function show($id)
    {
        $row = Enrichment::findOrFail($id);
        return view('admin::enrichment.show', compact('row'));
    }


    public function edit($id)
    {
        $row = Enrichment::findOrFail($id);
        return view('admin::enrichment.edit', compact('row'));
    }


    public function update(CreateEnrichmentRequest $request, $id)
    {
        $row = Enrichment::findOrFail($id);
        $input=$request->validated();
        $row->update($input);
        return redirect()->route('admin.enrichment.index');
    }


    public function destroy($id)
    {
        $row = Enrichment::findOrFail($id);
        $row->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }

    public function ban($id): object
    {
        $row = Enrichment::find($id);
        $row->update(
            [
                'banned' => 1,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $row = Enrichment::find($id);
        $row->update(
            [
                'banned' => 0,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }
}
