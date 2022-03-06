<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crawler App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mt-5">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Title</td>
                            <td>
                                <a href="{{ $post->url }}">
                                    {{ $post->title }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Screen Shot</td>
                            <td>
                                <img src="{{ $post->screen_shot }}" class="img-thumbnail w-50" alt="screen shot">
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $post->description ?? 'No Description' }}</td>
                        </tr>
                        <tr>
                            <td>Body</td>
                            <td>{{ $post->body }}</td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
