@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Admin') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <p>
                        Send Notification
                    </p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="Messages">Messages</label>
                            <input type="text" class="form-control" id="messages" placeholder="Type the Notification Messages">
                        </div>

                        <div class="form-group">
                            <label for="Messages">Recipient</label>
                            <select id="recip" class="form-contol">
                                <option>---Choose The Recipient---</option>
                                <option value="public">Public</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('custom-scripts')

<script text="javascript">
    var pusher = new Pusher('cb2c677f4c82c2efbf5d', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('notif-channel');
    channel.bind('new-event', function(data) {
        if
    //   alert(JSON.stringify(data));
    });
</script>

@endpush
