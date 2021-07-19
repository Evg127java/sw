@extends('layout')

@section('title')
    people
@endsection

@section('content')

    <div class="container-fluid my-0">
        <div class="row justify-content-center my-0">
            <div class="bg-light col-10 py-3">
                <div class="row justify-content-center my-0">
                    <div class="col-md-3">
                        <div>
                            <div class="text-center">
                                People from the planet:
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <select class="form-control" id="homeworld" onchange="location = this.value;">
                                        <option {{ !isset($homeworldName) ? ' selected' : '' }} disabled>Choose a planet</option>
                                        @foreach($homeworlds as $homeworld)
                                            <option
                                                value="/homeworld/{{ $homeworld->name ?? '' }}"
                                                {{ isset($homeworldName) && $homeworldName === $homeworld->name ? ' selected' : '' }}
                                            >
                                                {{ $homeworld->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($people) && $people->isEmpty())
                    <div class="row justify-content-center mx-0 mt-3 mb-0">
                        <div class="alert alert-secondary text-center col-md-8" role="alert">
                            There are no people on this planet
                        </div>
                    </div>
                @endif
                @if(isset($people) && $people->isNotEmpty())
                    <div class="row justify-content-md-center mt-3">
                        <div>
                            {{ $people->links() }}
                        </div>
                    </div>
                    <div class="row justify-content-center mx-0">
                        <table class="table text-center col-md-12">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Home world</th>
                                <th scope="col">Films</th>
                                <th scope="col">Images</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($people as $person)
                                <tr>
                                    <td><a href="/people/{{ $person->id }}">{{ $person->name }}</a></td>
                                    <td>{{ $homeworldName }}</td>
                                    <td>
                                        @foreach($person->films as $film)
                                            {{ $film->title }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center">
                                            @forelse($person->images as $image)
                                                <div>
                                                    <img src="{{ asset($image->path) }}" alt="image"
                                                         style="height: 100px; width: 100px;" class="p-1">
                                                </div>
                                            @empty
                                                No images
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-md-center">
                        <div>
                            {{ $people->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
