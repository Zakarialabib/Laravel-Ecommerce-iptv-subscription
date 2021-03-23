@extends('admin.layout')

@section('title', 'All Tickets')

@section('content')
<div class="p-0 -mb-5">
    <div class="container sm:px-4 max-w-full mx-auto">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Tickets') }}</h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Tickets') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
               <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
	        	<div class="panel-heading">
	        		<i class="fa fa-ticket"> </i>
	        	</div>

	        	<div class="panel-body">
	        		@if ($tickets->isEmpty())
						<p>{{ __('There are currently no tickets') }}.</p>
	        		@else
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-2 px-3 text-left">Categorie</th>
                                <th class="py-2 px-3 text-left">N° ticket</th>
                                <th class="py-2 px-3 text-left">Titre</th>
                                <th class="py-2 px-3 text-center">Utilsateur</th>
                                <th class="py-2 px-3 text-center">Date</th>
                                <th class="py-2 px-3 text-center">Status</th>
                                <th class="py-2 px-3 text-right">Actions</th>
                                <th class="py-2 px-3 text-center"></th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
						@foreach ($tickets as $ticket)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-2 px-3 text-left whitespace-nowrap">
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
								<td class="py-2 px-3 text-left">
                                    <div class="flex items-center">
                                        <span>
										<a href="{{ url('tickets/'. $ticket->ticket_id) }}">
		        							#{{ $ticket->ticket_id }} 
		        						</a></span>
                                    </div>
                                </td>

                                <td class="py-2 px-3 text-left">
                                    <div class="flex items-center">
                                        <span>
										<a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}">
		        							{{ $ticket->title }}
		        						</a></span>
                                    </div>
                                </td>
                                <td class="py-2 px-3 text-center">
                                    <div class="flex items-center justify-center">
                                        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125" src="https://randomuser.me/api/portraits/men/1.jpg"/>
                                    </div>
                                </td>
								<td class="py-2 px-3 text-center">
								{{ $ticket->updated_at->format('Y-m-d H:m') }}
								</td>
                                <td class="py-2 px-3 text-center">
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
  </div>
</section>
@endsection