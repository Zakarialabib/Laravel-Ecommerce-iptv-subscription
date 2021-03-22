<div class="comments px-5 py-3">
    @foreach($ticket->comments as $comment)
    <div class="panel panel-@if($ticket->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
    <div class="flex relative mt-6" style=" margin-left:10px;">
        <i class="fas fa-user text-grey-dark"></i> 
        <div class=" ml-2 "> 
          <p class="font-medium text-sm text-grey-darkest font-semibold">{{ $comment->created_at->format('Y-m-d') }}</p>
          <small class="text-grey-dark text-xs ">{{ $comment->comment }}</small>
        </div>
        <hr>
      </div>
    </div>
    @endforeach
</div>