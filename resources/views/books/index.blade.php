<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <!-- Heading -->
        <h1 class="text-center mb-4">List Books</h1>
        
        <!-- Form -->
        <form method="GET" action="{{ route('books.index') }}" class="row row-cols-lg-auto mb-4 align-items-end justify-content-center">
            <div class="col-12 col-lg-2">
                <label for="limit" class="form-label fw-medium">List shown:</label>
                <select name="limit" id="limit" class="form-select">
                    @for ($i = 10; $i <= 100; $i += 10)
                        <option value="{{ $i }}" {{ request('limit') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-12 col-lg-8">
                <label for="search" class="form-label fw-medium">Search:</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary fw-medium">Submit</button>
            </div>
        </form>

        <!-- Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Book Title</th>
                    <th>Category</th>
                    <th>Author Name</th>
                    <th>Average Rating</th>
                    <th>Voters</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->category_name }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ number_format($book->average_rating, 2) }}</td>
                        <td>{{ $book->voters }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
