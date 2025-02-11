@extends('backend.layouts.app')

@section('title', 'Label Page')

@push('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

        .dropify-wrapper {
            background-color: #f5f8fa;
            /* Light background */
            border: 2px dashed #007bff;
            /* Custom border */
            border-radius: 15px;
            /* Rounded corners */
            transition: all 0.3s ease;
        }

        .dropify-wrapper:hover {
            border-color: #0056b3;
            /* Darker border on hover */
            background-color: #e6f7ff;
            /* Change background on hover */
        }

        .dropify-wrapper .dropify-message {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 18px;
            /* Larger font */
            margin: 10px 0;
        }

        .dropify-wrapper .dropify-preview .dropify-render img {
            max-width: 100%;
            /* Responsive image */
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Production</h4>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('productions.update', $data->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="writers" class="form-label">Writers</label>
                                        <input type="text" class="form-control @error('writers') is-invalid @enderror"
                                            writers="writers" id="writers" placeholder="Enter writers here"
                                            value="{{ $data->writers ?? '' }}">
                                        @error('writers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="producers" class="form-label">Producers</label>
                                        <input type="text" class="form-control @error('producers') is-invalid @enderror"
                                            name="producers" id="producers" placeholder="Enter blog category here"
                                            value="{{ $data->producers ?? '' }}">
                                        @error('producers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="music_directors" class="form-label">Music Directors</label>
                                        <input type="text" class="form-control @error('music_directors') is-invalid @enderror"
                                            name="music_directors" id="music_directors" placeholder="Enter blog category here"
                                            value="{{ $data->music_directors ?? '' }}">
                                        @error('music_directors')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /Account -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    
@endpush
