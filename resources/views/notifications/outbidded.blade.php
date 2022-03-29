@foreach($notifications as $notification)
<div class="alert icon-custom-alert alert-outline-pink b-round fade show" role="alert" id="notificationParrent">
    <i class="mdi mdi-alert-outline alert-icon"></i>
    <div class="alert-text">
        <strong>Oh snap!</strong> Another competitor outbidded your bot on {{$notification->data['product_name']}} Your autobid bot has been disabled {{$notification->created_at}}
    </div>
</div>
@if($loop->last)
    @csrf
    <a href="#" id="read_all" class="float-right">
        Mark all as read
    </a>
@endif
@endforeach
