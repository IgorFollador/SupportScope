<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Website;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class WebsiteController extends VoyagerBaseController
{
    public function index(Request $request)
    {
        $websites = Website::all();
        return view('voyager.websites.index', compact('websites'));
    }

    public function create(Request $request)
    {
        return view('voyager.websites.edit-add');
    }

    public function store(Request $request)
    {
        $website = new Website;
        $website->name = $request->input('name');
        $website->url = $request->input('url');
        $website->ssl = $request->input('ssl');
        $website->status = $request->input('status');
        $website->save();

        return redirect()->route('voyager.websites.index');
    }

    public function edit(Request $request, $id)
    {
        $website = Website::find($id);
        return view('voyager.websites.edit-add', compact('website'));
    }

    public function update(Request $request, $id)
    {
        $website = Website::find($id);
        $website->name = $request->input('name');
        $website->url = $request->input('url');
        $website->ssl = $request->input('ssl');
        $website->status = $request->input('status');
        $website->save();

        return redirect()->route('voyager.websites.index');
    }

    public function destroy(Request $request, $id)
    {
        $website = Website::find($id);
        $website->delete();

        return redirect()->route('voyager.websites.index');
    }
}
