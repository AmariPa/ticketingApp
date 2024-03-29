@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="container mt-5">
    <h2 class="mb-4">Ticket Listing</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Add a Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket->id }}</th>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>
                        <span
                            class="badge bg-{{ $ticket->status == 'Open' ? 'success' : ($ticket->status == 'Closed' ? 'danger' : 'warning') }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td>
                        @forelse ($ticket->comments as $index => $comment)
                        <p><strong>{{ $index + 1 }}.</strong> {{ $comment->body }}</p>
                        @empty
                        No comments.
                        @endforelse
                    </td>
                    <td>
                        <form action="{{ route('tickets.addComment', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <!-- Margin bottom -->
                                <input type="text" class="form-control" name="comment" placeholder="Comment..."
                                    required>
                            </div>
                            <button class="btn btn-outline-primary" type="submit">Submit</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection