@extends('layout')

@section('title')
    people
@endsection

@section('content')

    @if (session()->has('success register'))
        <div
            class="fixed-bottom rounded text-center mx-auto col-md-10 top-5 bg-secondary text-white">
            <p>{{ session('success register') }}</p>
        </div>
    @endif
    <div class="container-fluid my-0">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light py-3">
                <div class="row justify-content-center">
                    <div>
                        {{ $people->links() }}
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 w-full">
                        <table class="table text-center">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Height</th>
                                <th scope="col">Mass</th>
                                <th scope="col">Hair color</th>
                                <th scope="col">Birth year</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Home world</th>
                                <th scope="col">Films</th>
                                <th scope="col">Created</th>
                                <th scope="col">URL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($people as $person)
                                <tr>
                                    <td><a href="/people/{{ $person->getId() }}">{{ $person->getName() }}</a></td>
                                    <td>{{ $person->getHeight() }}</td>
                                    <td>{{ $person->getMass() }}</td>
                                    <td>{{ $person->getHairColor() }}</td>
                                    <td>{{ $person->getBirthYear() }}</td>
                                    <td>{{ $person->getGender() }}</td>
                                    <td>{{ $person->getHomeworld() }}</td>
                                    <td>
                                        @foreach($person->getFilms() as $film)
                                            -{{ $film->title }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $person->getCreatedAt() }}</td>
                                    <td>
                                        @if ($person->getUrl() === 'unknown')
                                            unknown
                                        @else
                                            <a href="{{ $person->getUrl() }}">{{ $person->getUrl() }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div>
                        {{ $people->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
