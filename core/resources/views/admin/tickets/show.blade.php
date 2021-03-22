@extends('admin.layout')

@section('title', $ticket->title)

@section('content')
<br>
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"> #{{ $ticket->ticket_id }} - {{ $ticket->title }}</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $ticket->message }}</a>
      <p class="mt-2 text-gray-500"> 
	  @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
      @endif
	  </p>
	  <p><b>Category:</b>  {{ $ticket->category->name }}</p>
	  <p>
                            @if ($ticket->status === 'Open')
                                <b>Status:</b> <span class="label label-success">{{ $ticket->status }}</span>
                            @else
                                <b>Status:</b> <span class="label label-danger">{{ $ticket->status }}</span>
                            @endif
      </p>
      <p><b>Created on:</b> {{ $ticket->created_at->diffForHumans() }}</p>
    </div>
  </div>
            <hr>
            @include('admin.tickets.comments')
            <hr>
            @include('admin.tickets.reply')
        </div>
    </div>
@endsection