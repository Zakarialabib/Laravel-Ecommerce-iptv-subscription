@extends('admin.layout')

@section('title', 'All Tickets')

@section('content')
<div class="content-header">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 m-0 text-gray-900">{{ __('Tickets') }}</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="lg:w-full pr-4 pl-4">
	        	<div class="panel-heading">
	        		<i class="fa fa-ticket"> </i>
	        	</div>

	        	<div class="panel-body">
	        		@if ($tickets->isEmpty())
						<p>{{ __('There are currently no tickets') }}.</p>
	        		@else
		        		<table class="table">
		        			<thead>
		        				<tr>
		        					<th>{{ __('Category') }}</th>
		        					<th>{{ __('Title') }}</th>
									<th>{{ __('User') }}</th>
		        					<th>{{ __('Status') }}</th>
		        					<th>{{ __('Last Updated') }}</th>
		        					<th style="text-align:center" colspan="2">{{ __('Actions') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($tickets as $ticket)
								<tr>
		        					<td>
		        					@foreach ($categories as $category)
		        						@if ($category->id === $ticket->category_id)
											{{ $category->name }}
		        						@endif
		        					@endforeach
		        					</td>
		        					<td>
		        						<a href="{{ url('tickets/'. $ticket->ticket_id) }}">
		        							#{{ $ticket->ticket_id }} - {{ $ticket->title }}
		        						</a>
		        					</td>
									<td>
		        						<a href="">
										{{ $ticket->user_id }}
		        						</a>
		        					</td>
		        					<td>
		        					@if ($ticket->status === 'Open')
		        						<span class="label label-success">{{ $ticket->status }}</span>
		        					@else
		        						<span class="label label-danger">{{ $ticket->status }}</span>
		        					@endif
		        					</td>
		        					<td>{{ $ticket->updated_at }}</td>
		        					<td>
		        						<a href="{{ url('/tickets/show/'. $ticket->ticket_id) }}" class="btn btn-primary">{{ __('Comment') }}</a>
									</td>
		        					<td>
		        						<form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
		        							{!! csrf_field() !!}
		        							<button type="submit" class="btn btn-danger">{{ __('Close') }}</button>
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
@endsection