@extends('admin.layout')

@section('title', 'All Tickets')

@section('content')
	<div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
				@if ($tickets->isEmpty())
						<p>There are currently no tickets.</p>
	        		@else
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Categorie</th>
                                <th class="py-3 px-6 text-left">N° ticket</th>
                                <th class="py-3 px-6 text-left">Titre</th>
                                <th class="py-3 px-6 text-center">Utilsateur</th>
                                <th class="py-3 px-6 text-center">Date</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-right">Actions</th>
                                <th class="py-3 px-6 text-center"></th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
						@foreach ($tickets as $ticket)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">	
										@foreach ($categories as $category)
		        							@if ($category->id === $ticket->category_id)
												{{ $category->name }}
		        							@endif
		        						@endforeach
										</span>
                                    </div>
                                </td>
								<td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>
										<a href="{{ url('tickets/'. $ticket->ticket_id) }}">
		        							#{{ $ticket->ticket_id }} 
		        						</a></span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>
										<a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}">
		        							{{ $ticket->title }}
		        						</a></span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125" src="https://randomuser.me/api/portraits/men/1.jpg"/>
                                    </div>
                                </td>
								<td class="py-3 px-6 text-center">
								{{ $ticket->updated_at }}
								</td>
                                <td class="py-3 px-6 text-center">
								@if ($ticket->status === 'Open')
		        						<span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $ticket->status }}</span>
		        				@else
		        						<span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $ticket->status }}</span>
		        				@endif

                                </td>
								<td class="py-3 px-1 text-center">
		        					<a href="{{ url('admin/tickets/' . $ticket->ticket_id) }}" class="btn btn-primary">Comment</a>
		        				</td>
								<td class="py-3 px-1 text-center" style="background-color:white;">
										<form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
		        							{!! csrf_field() !!}
		        							<button type="submit" class="btn btn-danger">Close</button>
		        						</form>
		        				</td>
                            </tr>
							@endforeach
                        </tbody>
                    </table>
					{{ $tickets->render() }}
		        	@endif
                </div>
            </div>
        </div>
    </div>
@endsection