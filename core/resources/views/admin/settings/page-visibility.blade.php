@extends('admin.layout')

@section('content')

<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
                <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Page Visibility') }}</h1>
            </div><!-- /.col -->
            <div class="sm:w-1/2 pr-4 pl-4">
                <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
                    <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="inline-block px-2 py-2 text-gray-700">{{ __('Page Visibility') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container mx-auto sm:px-4 max-w-full">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                    <form class="form-horizontal" action="{{ route('admin.pagevisibility.update') }}" method="POST">
                            @csrf
                        <div class="flex flex-wrap ">
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                        <h3 class="px-4 mt-1 w-1/2">{{ __('Home Page Section Visibility') }} </h3>
                                    </div>
                                    <div class="flex-auto p-6">
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('About Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_about_section == '1' ? 'checked' : '' }} data-size="large" name="is_about_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_about_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_about_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Package Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_package_section == '1' ? 'checked' : '' }} data-size="large" name="is_package_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_package_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_package_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Offer Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_offer_section == '1' ? 'checked' : '' }} data-size="large" name="is_offer_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_offer_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_offer_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Counter Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_counter_section == '1' ? 'checked' : '' }} data-size="large" name="is_counter_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_counter_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_counter_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Service Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_service_section == '1' ? 'checked' : '' }} data-size="large" name="is_service_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_service_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_service_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Testimonial Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_testimonial_section == '1' ? 'checked' : '' }} data-size="large" name="is_testimonial_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_testimonial_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_testimonial_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Blog Section') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_blog_section == '1' ? 'checked' : '' }} data-size="large" name="is_blog_section" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_blog_section'))
                                                    <p class="text-red-600"> {{ $errors->first('is_blog_section') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                        <h3 class="px-4 mt-1 w-1/2">{{ __('Page Visibility') }} </h3>
                                    </div>
                                    <div class="flex-auto p-6">
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('About Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_about_page == '1' ? 'checked' : '' }} data-size="large" name="is_about_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_about_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_about_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Media Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_media_page == '1' ? 'checked' : '' }} data-size="large" name="is_media_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_media_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_media_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Shop Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_shop_page == '1' ? 'checked' : '' }} data-size="large" name="is_shop_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_shop_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_shop_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Faq Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_faq_page == '1' ? 'checked' : '' }} data-size="large" name="is_faq_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_faq_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_faq_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Team Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_team_page == '1' ? 'checked' : '' }} data-size="large" name="is_team_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_team_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_team_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Branch Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_branch_page == '1' ? 'checked' : '' }} data-size="large" name="is_branch_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_branch_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_branch_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Blog Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_blog_page == '1' ? 'checked' : '' }} data-size="large" name="is_blog_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_blog_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_blog_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Contact Page') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_contact_page == '1' ? 'checked' : '' }} data-size="large" name="is_contact_page" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_contact_page'))
                                                    <p class="text-red-600"> {{ $errors->first('is_contact_page') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-full pr-4 pl-4">
                                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                                        <h3 class="px-4 mt-1 w-1/2">{{ __('Other Visibility') }} </h3>
                                    </div>
                                    <div class="flex-auto p-6">
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Speed Test') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_speed_test == '1' ? 'checked' : '' }} data-size="large" name="is_speed_test" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_speed_test'))
                                                    <p class="text-red-600"> {{ $errors->first('is_speed_test') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Social Share (blog & product)') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_blog_share_links == '1' ? 'checked' : '' }} data-size="large" name="is_blog_share_links" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_blog_share_links'))
                                                    <p class="text-red-600"> {{ $errors->first('is_blog_share_links') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Cooki Alert') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_cooki_alert == '1' ? 'checked' : '' }} data-size="large" name="is_cooki_alert" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_cooki_alert'))
                                                    <p class="text-red-600"> {{ $errors->first('is_cooki_alert') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Testimonial BG Image') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_testimonial_bg == '1' ? 'checked' : '' }} data-size="large" name="is_testimonial_bg" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_testimonial_bg'))
                                                    <p class="text-red-600"> {{ $errors->first('is_testimonial_bg') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Counter BG Image') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_counter_bg == '1' ? 'checked' : '' }} data-size="large" name="is_counter_bg" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_counter_bg'))
                                                    <p class="text-red-600"> {{ $errors->first('is_counter_bg') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4 flex flex-wrap ">
                                            <label class="sm:w-2/5 pr-4 pl-4 control-label">{{ __('Package BG Image') }}<span
                                                        class="text-red-600">*</span></label>
                                            <div class="sm:w-3/5 pr-4 pl-4">
                                                <input type="checkbox" {{ $commonsetting->is_package_bg == '1' ? 'checked' : '' }} data-size="large" name="is_package_bg" data-bootstrap-switch data-off-color="danger" data-on-color="primary" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible">
                                                @if ($errors->has('is_package_bg'))
                                                    <p class="text-red-600"> {{ $errors->first('is_package_bg') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex flex-col min-w-0 rounded break-words">
                            <div class="flex-auto p-6">
                              <div class="sm:w-full pr-4 pl-4">
                                  <button type="submit" class="px-2 py-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">{{ __('Update') }}</button>
                              </div>
                            </div>
                        </div>

                    </form>
            </div>
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection
