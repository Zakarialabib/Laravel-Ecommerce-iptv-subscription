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
						{{ $front_daynamic_page->title }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ $front_daynamic_page->title }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- Faq Area Start -->
	<section class="blog-section dynamicpage">
		<div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap  justify-center">
                <div class="lg:w-4/5 pr-4 pl-4">
                    <div class="d-p-top-area text-center mb-5">
                        <h3>{{ $front_daynamic_page->title }}</h3>
                    </div>
                    <div class="content">
                        {!! $front_daynamic_page->content !!}
                    </div>
                </div>
            </div>
		</div>
	</section>
	<!-- Faq Area End -->

@endsection
