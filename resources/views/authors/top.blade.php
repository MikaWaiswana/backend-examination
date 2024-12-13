<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top 10 Most Famous Authors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <h1 class="text-center mb-4">Top 10 Most Famous Authors</h1>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Author Name</th>
                        <th>Voters</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $index => $author)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->voters }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
