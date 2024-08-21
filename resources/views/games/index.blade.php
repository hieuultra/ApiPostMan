@extends('layout.admin')

@section('content')

<div class="cart">
    <h3 class="text-center">List Games</h3>
    <div class="card-body">
        <a href="{{ route('games.create') }}" class="btn btn-success">Add Games</a>
        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Img</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Biography</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listGames as $key=> $item)
                         <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name ?? '' }}</td>
                            <td>
                                @if ($item->profile_picture)
                                <img src="{{ Storage::url($item->profile_picture) }}" width="100" height="100" alt="">
                                @endif
                            </td>
                            <td>{{ $item->birth_date ?? '' }}</td>
                            <td>{{ $item->instrument ?? '' }}</td>
                            <td>{{ $item->biography ?? '' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('games.edit', $item->id) }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                    <form action="{{ route('games.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('ban co chac chan muon xoa')">Delete</button>
                                    </form>
                                </div>
                            </td>
                         </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>

@endsection

