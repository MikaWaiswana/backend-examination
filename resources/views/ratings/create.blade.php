<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate a Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Rate a Book</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('rate.store') }}">
            @csrf

            <div class="mb-3">
                <label for="author" class="form-label fw-medium">Book Author:</label>
                <select id="author" name="author_id" class="form-select">
                    <option value="">Select an author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book" class="form-label fw-medium">Book Title:</label>
                <select id="book" name="book_id" class="form-select">
                    <option value="">Select a book</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label fw-medium">Rating:</label>
                <select name="rating" class="form-select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary fw-medium">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#author').on('change', function() {
                var authorID = $(this).val();

                if (authorID) {
                    $.ajax({
                        url: '/getBooks/' + authorID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#book').empty();
                            $('#book').append('<option value="">Select a book</option>');
                            $.each(data, function(key, value) {
                                $('#book').append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        }
                    });
                } else {
                    $('#book').empty();
                    $('#book').append('<option value="">Select a book</option>');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
