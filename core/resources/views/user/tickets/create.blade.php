@extends('front.layout')

@section('title', 'Open Ticket')
@section('content')

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal">Créer un Ticket:</h3>
                <form class="form-horizontal" method="POST" action="{{ route('user.tickets.store') }}" >
                @csrf
                        <div class="mb-4{{ $errors->has('title') ? ' has-error' : '' }}" >
                            <label class="text-xl text-gray-600" placeholder="Titre">
                            
                            </label></br>
                            <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value=""></input>
                            @if ($errors->has('title'))
                                    <span class="text-red-500">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        <div class="flex p-1 mb-4{{ $errors->has('category') ? ' has-error' : '' }}">
                            <select class="border-2 border-gray-300 p-2" name="category">
                                <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                              @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                              @endif
                              
                        </div>
                        <div class="flex p-1 mb-4{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <select class="border-2 border-gray-300 p-2"  name="priority">
                                    <option value="">Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                            </select>
                             @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                             @endif
                        </div>

                        <div class="mb-8">
                            <label class="text-xl text-gray-600">Content <span class="text-red-500">*</span></label></br>
                            <textarea class="border-2 border-gray-500" name="message">
                            </textarea>
                        </div>
                        <button type="submit" class="p-3 bg-yellow-500 text-white" >submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
@endsection