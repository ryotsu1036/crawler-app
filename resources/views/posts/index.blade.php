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
            <div class="col-8 offset-2">
                <form id="post">
                    @csrf

                    <input type="url" name="url" value="https://laravel.com/" class="form-control" placeholder="Url">
                    <button type="submit" class="btn btn-primary mt-2" id="submit" style="width: 77.17px;">Submit</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Screen Shot</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Create At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td style="width: 200px;">
                                    <img src="{{ $post->screen_shot }}" class="img-thumbnail" alt="screen shot">
                                </td>
                                <td>
                                    <a href="{{ url('posts/' . $post->id) }}" target="_blank">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 350px;">
                                        {{ $post->description ?? 'No Description' }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {
            $('#post').on('submit', function () {
                let originalText = $('#submit').text();

                console.log(originalText);

                $.ajax({
                    url: '/posts',
                    type: 'post',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#submit').empty().html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
                    },
                    success: function (response) {
                        $('tbody').empty();

                        response.forEach((post, key) => {
                            $('tbody').append(`
                                <tr>
                                    <td>${key + 1}.</td>
                                    <td style="width: 200px;">
                                        <img src="${post.screen_shot}" class="img-thumbnail" alt="screen shot">
                                    </td>
                                    <td>
                                        <a href="posts/${post.id}" target="_blank">
                                            ${post.title}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate" style="max-width: 350px;">
                                            ${post.description || 'No Description'}
                                        </span>
                                    </td>
                                    <td>${moment(post.created_at).format('YYYY-MM-DD HH:mm:ss')}</td>
                                </tr>
                            `);
                        });
                    },
                    complete: function () {
                        $('#submit').text(originalText);
                    }
                });

                return false;
            });
        });
    </script>
</body>
</html>
