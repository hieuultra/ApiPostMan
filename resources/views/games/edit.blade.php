@extends('layout.admin')

@section('content')

<div class="cart">
    <h3 class="text-center">Edit Games</h3>
    <div class="card-body">
        <form action="{{ route('games.update', $game->id) }}" method="post" enctype="multipart/form-data">
            @csrf
               @method('PUT')
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control"
                @error('name') is-invalid @enderror value="{{ old('name', $game['name']) }}" id="name" name="name" placeholder="Name">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile_picture</label>
                <input type="file" class="form-control"
                @error('profile_picture') is-invalid @enderror value="{{ old('profile_picture') }}" id="profile_picture" name="profile_picture" placeholder="Profile_picture">
                @error('profile_picture')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                @if ($game->profile_picture)
                <img src="{{ Storage::url($game->profile_picture) }}" width="100" height="100" alt="">
                @endif
            </div>

            <div class="form-group">
                <label for="birth_date">Birth_date</label>
                <input type="date" class="form-control"
                @error('birth_date') is-invalid @enderror value="{{ old('birth_date', $game['birth_date']) }}" id="birth_date" name="birth_date" placeholder="birth_date">
                @error('birth_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="instrument">Instrument</label>
                <input type="text" class="form-control"
                @error('instrument') is-invalid @enderror value="{{ old('instrument', $game['instrument']) }}" id="instrument" name="instrument" placeholder="instrument">
                @error('instrument')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea name="biography" class="form-control" cols="30" rows="3" @error('biography') is-invalid @enderror>{{ old('biography', $game['biography']) }}</textarea>
                @error('biography')
                <p class="text-danger">{{ $message }}</p>
               @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit Game</button>
        </form>
    </div>
</div>

@endsection

