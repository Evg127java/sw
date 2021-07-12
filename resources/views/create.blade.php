@extends('layout')

@section('title')
    entity creating
@endsection

@section('content')

    <script src="/js/dynamicAddingFields.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-10 bg-light py-3">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>Fill in the fields and press the 'Submit' button to create an entity</h4>
                    </div>
                </div>

                <div class="row justify-content-md-center mx-0">
                    <div class="col-md-8">
                        <div class="row justify-content-md-center mx-0">
                            @if ($errors->any())
                                <div class="alert alert-danger col-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form class="formWithValidation table-bordered pt-4"
                              action="/create"
                              method="post"
                              enctype="multipart/form-data"
                              style="background-color: rgba(190, 210, 190, 0.1);"
                              id="form"
                              onsubmit="return validateForm()"
                              >
                            @csrf
                            <div class="row mx-0">
                                <div class="form-group col-md-12">
                                    <label for="name">Name*</label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           placeholder="Name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           {{--required--}}
                                    ><div class="error" id="nameErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-3">
                                    <label for="height">Height</label>
                                    <input type="text"
                                           class="form-control"
                                           id="height"
                                           placeholder="Height"
                                           name="height"
                                           value="{{ old('height') }}"
                                    ><div class="error" id="heightErr"></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="mass">Mass</label>
                                    <input type="text"
                                           class="form-control"
                                           id="mass"
                                           placeholder="Mass"
                                           name="mass"
                                           value="{{ old('mass') }}"
                                    ><div class="error" id="massErr"></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="hair_color">Hair color</label>
                                    <input type="text"
                                           class="form-control"
                                           id="hair_color"
                                           placeholder="Hair color"
                                           name="hair_color"
                                           value="{{ old('hair_color') }}"
                                    ><div class="error" id="hair_colorErr"></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="birth_year">Birth year*</label>
                                    <input type="text"
                                           class="form-control"
                                           id="birth_year"
                                           placeholder="Birth year"
                                           name="birth_year"
                                           value="{{ old('birth_year') }}"
                                           {{--required--}}
                                    ><div class="error" id="birth_yearErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-6">
                                    <label for="gender">Gender choice</label>
                                    <select class="form-control" id="gender" name="gender_id">
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $gender->type === 'n/a' ? ' selected' : '' }}>
                                                {{ $gender->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="error" id="gender_idErr"></div>
                                <div class="form-group col-md-6">
                                    <label for="homeworld">Home world</label>
                                    <select class="form-control" id="homeworld" name="homeworld_id">
                                        @foreach($homeworlds as $homeworld)
                                            <option value="{{ $homeworld->id }}" {{ $homeworld->name === 'unknown' ? ' selected' : '' }}>
                                                {{ $homeworld->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="error" id="homeworld_idErr"></div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-12">
                                    <label for="films">Films</label>
                                    <select multiple class="form-control" id="films" name="films[]">
                                        @foreach($films as $film)
                                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-12">
                                    <label for="url">URL</label>
                                    <input type="text"
                                           class="form-control"
                                           id="url"
                                           placeholder="Url"
                                           name="url"
                                           value="{{ old('url') }}"
                                    ><div class="error" id="urlErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0 my-1">
                                <div class="col-md-12">
                                    <label for="attachments"><strong>Attachments control:</strong></label>
                                    <div id="attachments" class="input_fields_wrap">
                                        <input id="input" name="images[]" type="file" class="file mb-2">
                                    </div>
                                    <button type="button" class="add_field_button btn btn-outline-secondary float-left">
                                        Add one more file
                                    </button>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="validateBtn btn btn-secondary">Create entity</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>@endsection
