@extends('front.layout')

@section('title', 'My Tickets')

@section('content')
<div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
            		<button class='relative bg-yellow-500 text-white p-6 rounded text-2xl font-bold overflow-visible'>
	            		<a href="{{ route('user.tickets.create') }}">
	      					Créer un ticket
	      				</a>
  					</button> <br> <br>

	        		<h2 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal">Mes Tickets</h3>
                <div class="bg-white shadow-md rounded my-6">
					@if ($tickets->isEmpty())
						<p>There are currently no tickets.</p>
	        		@else
                   <div>
				      <table class="min-w-full table-auto">
				        <thead class="justify-between">
				          <tr class="bg-gray-800">
				            <th class="px-16 py-2">
				              <span class="text-gray-300">Catgeory</span>
				            </th>
				            <th class="px-16 py-2">
				              <span class="text-gray-300">Identifiant</span>
				            </th>   
				            <th class="px-16 py-2">
				              <span class="text-gray-300">Title</span>
				            </th>
				            <th class="px-16 py-2">
				              <span class="text-gray-300">Last updated</span>
				            </th>

				            <th class="px-16 py-2">
				              <span class="text-gray-300">Status</span>
				            </th>
				          </tr>
				        </thead>	
						  <tbody class="bg-gray-200">
		        			@foreach ($tickets as $ticket)
                                <tr class="bg-white border-4 border-gray-200">
                                    <td class="px-16 py-2 flex flex-row items-center">
                                    	<span class="text-center ml-2 font-semibold">
		        					@foreach ($categories as $category)
		        						@if ($category->id === $ticket->category_id)
											{{ $category->name }}
		        						@endif
		        					@endforeach
		        						</span>
		        					</td>
		        					<td class="px-16 py-2">
             							 <button class="bg-yellow-500 text-white px-4 py-2 border rounded-md ">
												<a href="{{ url('user/my_tickets/'. $ticket->ticket_id) }}">
		        									{{ $ticket->ticket_id }}
		        								</a>             							
		        						 </button>
            						</td>
            					    <td>
              							<span class="text-center ml-2 font-semibold"> {{ $ticket->title }} </span>
            						</td>
		        					<td class="px-16 py-2">
             							 <span>{{ $ticket->updated_at }}</span>
           							</td>					
		        					<td class="px-16 py-2">
		        					@if ($ticket->status === 'Open')
		        						<span class="label label-success">{{ $ticket->status }}</span>
		        					@else
		        						<span class="label label-danger">{{ $ticket->status }}</span>
		        					@endif
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