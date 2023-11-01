<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
</head>

<body>
    <div id="app">
        <main class="container">
            <!-- <h1> How To Install Sweetalert2 in Laravel? - ItSolutionstuiff.com</h1> -->
            <button class="btn btn-success">Click Me!</button>
        </main>
    </div>
</body>

<script>

  $('button').click(function(){

      Swal.fire({

        title: 'Are you sure?',

        text: "You won't be able to revert this!",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#3085d6',

        cancelButtonColor: '#d33',

        confirmButtonText: 'Yes, delete it!'

      }).then((result) => {

        if (result.isConfirmed) {

          Swal.fire(

            'Deleted!',

            'Your file has been deleted.',

            'success'

          )

        }

      });


    // ****************** email...Ajax request example ******************
    // Swal.fire({
    //     title: 'Submit email to run ajax request',
    //     input: 'email',
    //     showCancelButton: true,
    //     confirmButtonText: 'Submit',
    //     showLoaderOnConfirm: true,
    //     preConfirm: function (email) {
    //         return new Promise(function (resolve, reject) {
    //         setTimeout(function() {
    //             if (email === 'taken@example.com') {
    //             reject('This email is already taken.')
    //             } else {
    //             resolve()
    //             }
    //         }, 2000)
    //         })
    //     },
    //     allowOutsideClick: false
    //     }).then(function (email) {
    //     swal({
    //         type: 'success',
    //         title: 'Ajax request finished!',
    //         html: 'Submitted email: ' + email
    //     })
    //     })

    // ***** A message with a custom image and CSS animation disabled *****


    // Swal.fire({
    //     title: 'Sweet!',
    //     text: 'Modal with a custom image.',
    //     imageUrl: 'https://unsplash.it/400/200',
    //     imageWidth: 400,
    //     imageHeight: 200,
    //     imageAlt: 'Custom image',
    //     animation: false
    // })


    // ************ Custom HTML description and buttons with ARIA labels *********
    // Swal.fire({
    //     title: '<i>HTML</i> <u>example</u>',
    //     type: 'info',
    //     html:
    //         'You can use <b>bold text</b>, ' +
    //         '<a href="//github.com">links</a> ' +
    //         'and other HTML tags',
    //     showCloseButton: true,
    //     showCancelButton: true,
    //     focusConfirm: false,
    //     confirmButtonText:
    //         '<i class="fa fa-thumbs-up"></i> Great!',
    //     confirmButtonAriaLabel: 'Thumbs up, great!',
    //     cancelButtonText:
    //     '<i class="fa fa-thumbs-down">NO..</i>',
    //     cancelButtonAriaLabel: 'Thumbs down',
    //     })

        // ******* jQuery HTML with custom animation *****
    // Swal.fire({
    //     title: 'jQuery HTML example',
    //     html: $('<div>')
    //         .addClass('some-class')
    //         .text('jQuery is everywhere.'),
    //     animation: false,
    //     customClass: 'animated tada'
    //     })

    // ******** A message with auto close timer *******
    // Swal.fire({
    //     title: 'Auto close alert!',
    //     text: 'I will close in 5 seconds.',
    //     timer: 5000,
    //     onOpen: function () {
    //         swal.showLoading()
    //     }
    //     }).then(
    //     function () {},
    //     // handling the promise rejection
    //     function (dismiss) {
    //         if (dismiss === 'timer') {
    //         console.log('I was closed by the timer')
    //         }
    //     }
    //     )

    // ************ Dynamic queue example ************
    // swal.queue([{
    //     title: 'Your public IP',
    //     confirmButtonText: 'Show my public IP',
    //     text:
    //         'Your public IP will be received ' +
    //         'via AJAX request',
    //     showLoaderOnConfirm: true,
    //     preConfirm: function () {
    //         return new Promise(function (resolve) {
    //         $.get('https://api.ipify.org?format=json')
    //             .done(function (data) {
    //             swal.insertQueueStep(data.ip)
    //             resolve()
    //             })
    //         })
    //     }
    //     }])
  });

</script>



</html>
