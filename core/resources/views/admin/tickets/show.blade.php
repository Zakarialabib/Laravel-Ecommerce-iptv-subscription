@extends('admin.layout')

@section('title', $ticket->title)

@section('content')
<div class="py-5">
  <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
      <div class="px-5 py-3">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"> #{{ $ticket->ticket_id }} -
          {{ $ticket->title }}</div>
        <a href="#"
          class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $ticket->message }}</a>
        <p class="mt-2 text-gray-500">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
        </p>
        <p><b>Category:</b> {{ $ticket->category->name }}</p>
        <p>
          @if ($ticket->status === 'Open')
          <b>Status:</b> <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $ticket->status }}</span>
          @else
          <b>Status:</b> <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $ticket->status }}</span>
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
</div>

@endsection