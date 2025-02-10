<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index()
    {
        return view( 'backend.dashboard.index' );
    }

    public function imageUpload( Request $request )
    {
        $mainImage = $request->file( 'file' );
        $filename  = str_replace( ' ', '-', time() . '--' . $mainImage->getClientOriginalName() );

        $mainImage->move( 'tinymce_upload/', $filename );
        return json_encode( ["location" => env( 'APP_URL' ) . '/tinymce_upload/' . $filename] );
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
