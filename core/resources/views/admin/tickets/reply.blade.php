<section class="text-gray-700 body-font">
    <div class="px-5 py-3 mx-auto lg:px-4">
    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Add reply</div><br>
                    <div class="relative ">

                <form action="{{ url('admin/tickets/comment') }}" method="POST" class="form">
                    {!! csrf_field() !!}

                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <textarea type="message" id="comment" name="comment" style="border-color:black;" placeholder="message"
                            class="w-full px-4 py-2 mb-4 text-black transition duration-500 ease-in-out transform bg-gray-100 border-transparent rounded-lg mr-4text-base focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2"></textarea>
                        @if ($errors->has('comment'))
                            <span class="help-block">
                               <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="px-8 py-2 font-semibold text-white transition duration-500 ease-in-out transform bg-black rounded-lg hover:bg-gray-800 hover:to-black focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</section>