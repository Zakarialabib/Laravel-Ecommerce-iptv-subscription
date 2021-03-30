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
						{{ __('Cart') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Cart') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->
  <!-- Cart Area Start -->
  <section class="cart-area remove_before">
    @if($cart !=null)
    <div class="container mx-auto sm:px-4">
      <div class="flex flex-wrap ">
        <div class="lg:w-full pr-4 pl-4">
          <div class="cart-table">
            <div class="block w-full overflow-auto scrolling-touch table-remove">
              <table class="table-auto mb-4 bg-transparent table-bordered cart-table">
                <thead>
                  <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Product Name') }}</th>
                    <th class="t-qty">{{ __('Quantity') }}</th>
                    <th class="t-price">{{ __('Price') }}</th>
                    <th class="t-price">{{ __('Total') }}</th>
                    <th class="t-price">{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $cartTotal = 0;
                        $countitem = 0;
                    @endphp
                    @foreach ($cart as $pid => $item)
                    @php
                        $countitem += $item['qty'];
                        $cartTotal += (double)$item['price'] * (int)$item['qty'];
                        $product = App\Product::findOrFail($pid);
                    @endphp
                    <input type="hidden" value="{{$pid}}" class="product_id">
                    <tr class="remove{{$pid}}">
                        <td>{{ $i++ }}</td>
                        <td>
                          <div class="thumbnail">
                            <img src="{{ asset('assets/front/img/'.$item['photo']) }}" alt="product-image">
                          </div>
                        </td>
                        <td>
                          <h4 class="product-title"><a href="#">{{ $item['name'] }}</a></h4>
                        </td>
                        <td>
                            <input type="number" aria-details="{{ $product->stock }}" name="product_quantity[]" class="quantity block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded cart_qty_update" value="{{ $item['qty'] }}">
                        </td>
                        <td>{{ $item['price'] }}{{ Helper::showCurrency() }} <span class="fas fa-times"></span> {{ $item['qty'] }}</td>
                        <td> <span class="cart_price">{{ $item['price'] * $item['qty'] }}{{ Helper::showCurrency() }}</span></td>
                        <td>
                          <button class="inline-block align-middle text-center select-none px-2 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple item-remove" rel="{{$pid}}" data-href="{{route('cart.item.remove',$pid)}}"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
                <tfoot class="cart-middle">
                  <tr>
                    <td colspan="6">
                      <div class="cart-footer-area">
                        <div class="flex flex-wrap ">
                          <div class="md:w-1/2 pr-4 pl-4 offset-6">
                            <div class="update-cart">
                              <button id="cart_update"  data-href="{{route('cart.update')}}" class="mybtn1">{{ __('Update Cart') }}</button>
                            </div>
                          </div>
                        </div>
                        </div>
                    </td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
      </div>
      <div class="flex flex-wrap  justify-end cart-middle">
        <div class="md:w-1/2 pr-4 pl-4">
          <div class="cart-summery">
            <h4 class="title">
              {{ __('Cart Summery :') }}
            </h4>
            <table class="table-auto mb-4 bg-transparent table-bordered">
              <tr>
                <th>{{ __('Total Item') }}</th>
                <td class="cart-item-view"> {{ $countitem }}</td>
              </tr>
              <tr>
                <th>{{ __('Total') }}</th>
                <td> <span class="cart-total-view">{{ $cartTotal }}</span><span>{{ Helper::showCurrency() }}</span> </td>
              </tr>
            </table>
            <div class="checkout-btn-wrape">
              <a href="{{ route('front.checkout') }}" class="mybtn1"> {{ __('Checkout') }} </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="container mx-auto sm:px-4" id="nocart">
      <div class="flex flex-wrap ">
        <div class="lg:w-full pr-4 pl-4">
           <div class="bg-gray-100 py-5 text-center">
              <h3 class="uppercase">{{__('Cart is empty!')}}</h3>
          </div>
        </div>
      </div>
    </div>
    @endif
  </section>
  <!-- Cart Area End -->

@endsection
