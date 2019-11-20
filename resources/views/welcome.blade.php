<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Image-Uploader</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2b92a5e113.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

<div class="flex-center position-ref full-height">
    <div class="content" id="app">
        <app/>
    </div>
</div>

{{--Uploaded images--}}
<div class="container" id="app2" >
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Uploaded Images: </h4>
                </div>
                <div class="card-body">
                    <div class="uploader uploaded">
                        <div class="images-preview">
                            @foreach($files as $file)
                                <div class="img-wrapper">
                                    <img src="{{ asset(str_replace('public/', 'storage/', $file)) }}">
                                    <button type="submit" v-on:click="deleteImg($event)" :data-id="id" id="{{$file}}"
                                            class="btn btn-danger delFile">Delete
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End of Uploaded images--}}

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".delFile").click(function (e) {

        if (window.confirm("Are you sure you want to delete this image?")) {
            e.preventDefault();
            let parent = $(this).parent();
            let image = $(this).attr('id');

            $.ajax({
                type: 'POST',
                url: '/deleteFile',
                data: {image: image},

                success: function (data) {
                    parent.fadeOut();
                    alert('Image Successfully deleted!');
                }
            });
        }
    });

</script>

</body>

</html>
