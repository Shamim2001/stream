@extends('backend.layouts.app')

@section('title', 'Artist Page')

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
                        <h4 class="card-title">Create Artist</h4>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('artists.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Enter name here"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter blog category here"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" placeholder="Enter blog category here"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input type="file"
                                            class="dropify form-control @error('photo') is-invalid @enderror" name="photo"
                                            id="photo" data-default-file="{{ old('photo') }}">
                                        @error('photo')
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
