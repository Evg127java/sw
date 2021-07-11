@extends('layout')

@section('title')
    person
@endsection

@section('content')
    <div class="container-fluid my-0">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light py-3">
                <div class="row">
                <div class="col-md-4">
                    <table class="table">
                        <thead class="thead-light">
                        <th scope="col" colspan="2">
                            {{ $person->name }}
                        </th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>mass</td>
                            <td class="text-right">{{ $person->mass }}</td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td class="text-right">{{ $person->height }}</td>
                        </tr>
                        <tr>
                            <td>Hair color</td>
                            <td class="text-right">{{ $person->hair_color }}</td>
                        </tr>
                        <tr>
                            <td>Birth year</td>
                            <td class="text-right">{{ $person->birth_year }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td class="text-right">{{ $person->gender->type }}</td>
                        </tr>
                        <tr>
                            <td>Home world</td>
                            <td class="text-right">{{ $person->homeworld->name }}</td>
                        </tr>
                        <tr>
                            <td>Url</td>
                            <td class="text-right">
                                @if ($person->url === 'unknown')
                                    unknown
                                @else
                                    <a href="{{ $person->url }}">{{ $person->url }}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Films</td>
                            <td class="text-right">
                                @foreach($person->films as $film)
                                    -{{ $film->title }}<br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td class="text-right">{{ $person->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Last update</td>
                            <td class="text-right">{{ $person->updated_at }}</td>
                        </tr>
                        <tr>
                        <td><a href="/edit/{{ $person->id }}">
                                <button class="btn btn-secondary">Edit</button>
                            </a></td>
                        <td class="text-right"><a href="/delete/{{ $person->id }}">
                                <button class="btn btn-danger">Delete</button>
                            </a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8 text-center">
                        @forelse($person->images as $image)
                            <img src="{{ asset($image->path) }}" alt="person image" style="height: 400px; width: 400px;"
                                 class="p-1">
                            @empty
                                <div class="alert alert-secondary" role="alert">
                                    This personage has no images yet
                                </div>
                        @endforelse


                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
