<?php

namespace App\Http\Controllers\Backend;

use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ProductionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        try {
            if ($request->ajax()) {
                $data = Production::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($data) {
                        $status = ' <div class="form-check form-switch" style="margin-left:40px;">';
                        $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                        if ($data->status == 'active') {
                            $status .= "checked";
                        }
                        $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        $editUrl = route('productions.edit', $data->id);
                        return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="' . $editUrl . '" class="btn btn-primary text-white" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" onclick="deleteAlert(' . $data->id . ')" class="btn btn-danger text-white" title="Delete">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>';
                    })

                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('backend.productions.index');
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('backend.productions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'writers' => 'required|string',
            'producers' => 'required|string',
            'music_directors' => 'required|string',
        ]);

        try {
            $data = new Production();
            $data->writers = $request->writers;
            $data->producers = $request->producers;
            $data->music_directors = $request->music_directors;
            $data->status = 'active';
            $data->save();

            return redirect()->route('productions.index')->with('t-success', 'Production Created Successfully.');
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        try {

            $data = Production::findOrFail($id);

            return view('backend.productions.edit', compact('data'));

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'writers' => 'string',
            'producers' => 'string',
            'music_directors' => 'string',
        ]);

        try {
            $data = Production::findOrFail($id);
            $data->writers = $request->writers;
            $data->producers = $request->producers;
            $data->music_directors = $request->music_directors;
            $data->save();

            return redirect()->route('productions.index')->with('t-success', 'Production Updated Successfully.');
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {

            $data = Production::findOrFail($id);
            $data->delete();

            return response()->json(['success' => true, 'message' => 'Deleted successfully.']);

        }
        catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong! Please try again.']);
        }

    }

    public function changeStatus($id)
    {
        
        $data = Production::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }

    }

}
