@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="lg:w-full pr-4 pl-4">
					<h1 class="pagetitle relative">
						{{ __('User Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('User Dashboard') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- User Dashboard Start -->
	<section class="user-dashboard-area">
		<div class="container mx-auto sm:px-4">
		  <div class="flex flex-wrap ">
			<div class="lg:w-1/4 pr-4 pl-4">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="lg:w-3/4 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <h5 class="flex py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Package Order') }}</h5>
                    <div class="flex-auto p-6">
                        <div class="flex flex-wrap ">
                            <div class="lg:w-full pr-4 pl-4 mt-3">
                                @if($order)
                                <table class="w-full max-w-full mb-4 bg-transparent border table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ __('Package Name') }}</th>
                                            <td>{{ $order->package->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Speed Limit') }}</th>
                                            <td>{{ $order->package->speed }} <span>{{ __('Mbps') }}</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Package Price') }}</th>
                                            <td>{{ $order->currency_sign }}{{ $order->package->price}} / {{ $order->package->time }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Package Feature') }}</th>
                                            <td>{{ $order->package->feature}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Payment Method') }}</th>
                                            <td>{{ $order->method}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Attendance Id') }}</th>
                                            <td>{{ $order->attendance_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Txn Id') }}</th>
                                            <td>{{ $order->txn_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Status') }}</th>
                                            <td>
                                                @if($order->status == 0)
                                                    <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-indigo-600 text-white hover:bg-teal-600">{{ __('Pending') }}</span>
                                                @elseif($order->status == 1)
                                                    <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{ __('In Progress') }}</span>
                                                @elseif($order->status == 2)
                                                    <span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ __('Completed') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else 
                                <h4>{{ __("You don't purchase any package. First buy a package.") }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		  </div>
		</div>
	
	  </section>
    <!-- User Dashboard End -->

@endsection
