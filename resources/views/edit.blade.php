@extends('layout')

@section('title')
    entity edition
@endsection

@section('content')

    <script src="/js/dynamicAddingFields.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light py-3">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h4>Fill in the fields and press the 'Update entity' button to create an entity</h4>
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
                              action="/edit/{{ $person->id }}"
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
                                           value="{{ $person->name }}"
                                           name="name"
                                           required
                                    ><div class="error" id="nameErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-3">
                                    <label for="height">Height</label>
                                    <input type="text"
                                           class="form-control"
                                           id="height"
                                           value="{{ $person->height === 'unknown' ? '' : $person->height }}"
                                           name="height">
                                    <div class="error" id="heightErr"></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="mass">Mass</label>
                                    <input type="text"
                                           class="form-control"
                                           id="mass"
                                           value="{{ $person->mass === 'unknown' ? '' : $person->mass }}"
                                           name="mass">
                                    <div class="error" id="massErr"></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="hair_color">Hair color</label>
                                    <input type="text"
                                           class="form-control"
                                           id="hair_color"
                                           value="{{ $person->hair_color === 'unknown' ? '' : $person->hair_color }}"
                                           name="hair_color">
                                    <div class="error" id="hair_colorErr"></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="birth_year">Birth year*</label>
                                    <input type="text"
                                           class="form-control"
                                           id="birth_year"
                                           value="{{ $person->birth_year }}"
                                           name="birth_year"
                                           required
                                    ><div class="error" id="birth_yearErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-6">
                                    <label for="gender">Gender choice</label>
                                    <select class="form-control" id="gender" name="gender_id">
                                    @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $gender->type === $person->gender->type ? ' selected' : '' }}>
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
                                            <option value="{{ $homeworld->id }}" {{ $homeworld->name === $person->homeworld->name ? ' selected' : '' }}>
                                                {{ $homeworld->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="error" id="homeworld_idErr"></div>
                                </div>

                            </div>
                            <div class="row mx-0">
                                <div class="form-group col-md-12">
                                    <label for="films">Films</label>
                                    <select multiple class="form-control" id="films" name="films[]">
                                    @foreach($films as $film)
                                            <option value="{{ $film->id }}" {{ $person->films->contains($film) ? ' selected' : '' }}>
                                                {{ $film->title }}
                                            </option>
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
                                           value="{{ $person->url === 'unknown' ? '' : $person->url }}"
                                           name="url">
                                    <div class="error" id="urlErr"></div>
                                </div>
                            </div>
                            <div class="row mx-0 my-0">
                                <div class="form-group col-md-12">
                                    <strong>
                                        Check attached image(s) to delete:
                                    </strong>
                                </div>
                            </div>
                            <div class="row mx-0  col-md-12  justify-content-center">
                                <div class="form-group">
                                    <div class="d-flex flex-wrap justify-content-center border-bottom">
                                    @if ($person->images->isNotEmpty())
                                        @foreach($person->images as $image)
                                                <div class="position-relative">
                                                    <img src="{{ asset($image->path) }}" alt="image" style="height: 100px; width: 100px;" class="p-1">
                                                    <input type="checkbox"
                                                           name="imagesToDelete[]"
                                                           value="{{ $image->id }}"
                                                           class="position-absolute"
                                                           style="top:4px; left:4px;"
                                                           id="{{ $image->id }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-secondary" role="alert">
                                                This personage has no images yet
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 my-1">
                                <div class="col-md-12">
                                    <label for="attachments"><strong>Attach images:</strong></label>
                                    <div id="attachments" class="input_fields_wrap">
                                        <input id="input" name="images[]" type="file" class="file mb-2">
                                    </div>
                                    <button type="button" class="add_field_button btn btn-outline-secondary float-left">
                                        Add one more file
                                    </button>
                                </div>
                            </div>
                            <div class="row mx-0 text-center">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="validateBtn btn btn-outline-secondary">Update entity data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/formValidation.js" type="text/javascript"></script>
@endsection
