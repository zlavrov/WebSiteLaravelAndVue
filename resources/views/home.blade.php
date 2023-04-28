<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div id="app">
            <navbar></navbar>
            <course-records></course-records>
        </div>
    </div>
    <div class="modal fade" id="createRowModal" aria-hidden="true" aria-labelledby="createRowModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-4">
                        <select class="form-select" id="status">
                            <option value="" selected disabled>Create: </option>
                            <option value="user">User</option>
                            <option value="course">Course</option>
                            <option value="enrollments">Enrollments</option>
                        </select>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                                <label for="createRow" class="col-form-label">Name Row:</label>
                                <input type="text" maxlength="50" class="form-control" name="createRow" id="createRow" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/app.js" defer></script>
    <script>
        window.csrf_token = '{{ csrf_token() }}';
    </script>
</body>
</html>
