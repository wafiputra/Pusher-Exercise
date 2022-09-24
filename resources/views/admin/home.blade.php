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
                    <form class="form-container" method="POST">
                        <div class="form-group">
                            <label for="recipient">Recipient</label>
                            <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Type the Recipient">
                            {{-- <select id="recipient" class="form-contol">
                                <option>---Choose The Recipient---</option>
                                <option value="public">Public</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                            </select> --}}
                        </div>

                        <div class="form-group">
                            <label for="notif">Messages Notification</label>
                            <input type="text" class="form-control" id="notif" name="notif" placeholder="Type the Notification Messages">
                        </div>

                    </form>
                    <button class="btn btn-primary btn-block save_button" id="submit_form">Send Notification</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('custom-scripts')
<script text="javascript">
    $(document).ready(function(){

        var pusher = new Pusher('cb2c677f4c82c2efbf5d', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('notif-channel');

        channel.bind('new-event', function(data) {
            alert(JSON.stringify(data));
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit_form').on('click', function(e) {
            e.preventDefault()

            let recipient = $('#recipient').val();
            let notif = $('#notif').val();

            $.ajax({
                type: 'POST',
                url: '/send_notif',
                data: {
                    recipient: recipient,
                    notif: notif
                },
                success: function(data){
                    console.log(data);
                    if(data.status){
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'green');
                        $('#notifDiv').text(data.message);
                        setTimeout(() => {
                            $('#notifDiv').fadeOout();
                        }, 3000);
                        $('[name="recipient"]');
                        $('[name="notif"]');
                    }else{
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Something Went Wrong');
                        setTimeout(() => {
                            $('#notifDiv').fadeOout();
                        }, 3000);

                    }
                }
            });
        })

        // $('.save_button').on('click', function(e){
        //     let recipient = $('#recipient').val();
        //     let notif = $('#notif').val();

        //     // const form = $(this).parents('form');

        //     $.ajax({
        //         type: 'POST',
        //         url: 'send_notif',
        //         data: {
        //             recipient: recipient,
        //             notif: notif
        //         },
        //         // processData: false,
        //         // contentType: 'application/json',
        //         success: function(data){
        //             console.log(data);
        //             if(data.status){
        //                 $('#notifDiv').fadeIn();
        //                 $('#notifDiv').css('background', 'green');
        //                 $('#notifDiv').text(data.message);
        //                 setTimeout(() => {
        //                     $('#notifDiv').fadeOout();
        //                 }, 3000);
        //                 $('[name="recipient"]');
        //                 $('[name="notif"]');
        //             }else{
        //                 $('#notifDiv').fadeIn();
        //                 $('#notifDiv').css('background', 'red');
        //                 $('#notifDiv').text('Something Went Wrong');
        //                 setTimeout(() => {
        //                     $('#notifDiv').fadeOout();
        //                 }, 3000);

        //             }
        //         },
        //         error:function(err) {
        //             console.log(err);
        //         }
        //     });
        //     // $(form).validate({
        //     //     rules: {
        //     //         recipient: {
        //     //             required: true
        //     //         }
        //     //     },
        //     //     message: {
        //     //         recipient: "Recipient is required"
        //     //     },
        //     //     submitHandler: function(){
        //     //         // var formData = new FormData(form[0]);

        //     //         $.ajax({
        //     //             type: 'POST',
        //     //             url: 'send_notif',
        //     //             data: {
        //     //                 recipient: recipient,
        //     //                 notif: notif
        //     //             },
        //     //             // processData: false,
        //     //             // contentType: 'application/json',
        //     //             success: function(data){
        //     //                 console.log(data);
        //     //                 if(data.status){
        //     //                     $('#notifDiv').fadeIn();
        //     //                     $('#notifDiv').css('background', 'green');
        //     //                     $('#notifDiv').text(data.message);
        //     //                     setTimeout(() => {
        //     //                        $('#notifDiv').fadeOout();
        //     //                     }, 3000);
        //     //                     $('[name="recipient"]');
        //     //                     $('[name="notif"]');
        //     //                 }else{
        //     //                     $('#notifDiv').fadeIn();
        //     //                     $('#notifDiv').css('background', 'red');
        //     //                     $('#notifDiv').text('Something Went Wrong');
        //     //                     setTimeout(() => {
        //     //                        $('#notifDiv').fadeOout();
        //     //                     }, 3000);

        //     //                 }
        //     //             },
        //     //             error:function(err) {
        //     //                 console.log(err);
        //     //             }
        //     //         });
        //     //     }
        //     // });

        //     // $.ajax({
        //     //     type: 'POST',
        //     //     url: '/send_notif',
        //     //     data: {
        //     //         recipient: recipient,
        //     //         notif: notif
        //     //     },
        //     //     processData: false,
        //     //     contentType: 'application/json',
        //     //     success: function(data){
        //     //         console.log(data);
        //     //         if(data.status){
        //     //             $('#notifDiv').fadeIn();
        //     //             $('#notifDiv').css('background', 'green');
        //     //             $('#notifDiv').text(data.message);
        //     //             setTimeout(() => {
        //     //                 $('#notifDiv').fadeOout();
        //     //             }, 3000);
        //     //             $('[name="recipient"]');
        //     //             $('[name="notif"]');
        //     //         }else{
        //     //             $('#notifDiv').fadeIn();
        //     //             $('#notifDiv').css('background', 'red');
        //     //             $('#notifDiv').text('Something Went Wrong');
        //     //             setTimeout(() => {
        //     //                 $('#notifDiv').fadeOout();
        //     //             }, 3000);

        //     //         }
        //     //     }
        //     // });
        // });
    });

    var channel = pusher.subscribe('notif-channel');
    // channel.bind('new-event', function(data) {
        // if
    //   alert(JSON.stringify(data));
    // });
</script>

@endpush
