<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Artist;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        try {
            if ($request->ajax()) {
                $data = Artist::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('photo', function ($data) {
                        $photo = $data->photo;
                        $url = asset($photo);
                        return '<img src="' . $url . '" alt="image" width="100px" height="100px" style="margin-left:20px;">';
                    })
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
                        $editUrl = route('artists.edit', $data->id);
                        return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="' . $editUrl . '" class="btn btn-primary text-white" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" onclick="deleteAlert(' . $data->id . ')" class="btn btn-danger text-white" title="Delete">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>';
                    })

                    ->rawColumns(['photo', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.artist.index');
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
        
        return view('backend.artist.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'string|required',
            'email' => 'required|email|unique:artists',
            'phone' => 'string|required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            $artist = new Artist();
            $artist->name = $request->name;
            $artist->email = $request->email;
            $artist->phone = $request->phone;
            if($request->hasFile('photo')) {
                $image = Helper::fileUpload($request->file('photo'), 'artist', $request->file('photo')->getClientOriginalName());
                $artist->photo = $image;
            }
            $artist->status = 'active';
            $artist->save();
            return redirect()->route('artists.index')->with('t-success', 'Artist Added Successfully.');
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
            $artist = Artist::findOrFail($id);
            return view('backend.artist.edit', compact('artist'));
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
            'name' => 'string',
            'email' => 'email',
            'phone' => 'string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            $artist = Artist::findOrFail($id);
            $artist->name = $request->name;
            $artist->email = $request->email;
            $artist->phone = $request->phone;
            if($request->hasFile('photo')) {
                if ($artist->photo) {
                    Helper::fileDelete($artist->photo);
                }
                $image = Helper::fileUpload($request->file('photo'), 'artist', $request->file('photo')->getClientOriginalName());
                $artist->photo = $image;
            }
            $artist->status = 'active';
            $artist->save();
            return redirect()->route('artists.index')->with('t-success', 'Artist Updated Successfully.');
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

            $data = Artist::find($id);
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
        
        $data = Artist::find($id);
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
