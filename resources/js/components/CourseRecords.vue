<template>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">

        <h1 class="display-4 fw-normal">Recent course enrollments</h1>

        <div class="row g-3 mt-4">

            <div class="col-md-3">
                <label class="form-label" for="search-course">Search by course name:</label>
                <input type="text" class="form-control" id="search-course">
            </div>

            <div class="col-md-3">
                <label class="form-label" for="search-user">Search by username or email:</label>
                <input type="text" class="form-control" id="search-user">
            </div>

            <div class="col-md-3">
                <label class="form-label" for="status">Entry Status:</label>
                <select class="form-select" id="status">
                    <option value="">All entries</option>
                    <option value="in-progress">In progress</option>
                    <option value="complete">Completed</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label" for="sort-by">Sort by:</label>
                <select class="form-select" id="sort-by">
                    <option value="date-created">Recording date</option>
                    <option value="date-completed">Date of completion</option>
                    <option value="course-name">Course name</option>
                </select>
            </div>

        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Course name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Result</th>
                    <th scope="col">Enrollment date for the course</th>
                    <th scope="col">Course completion date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">record course name</td>
                    <td>record user name</td>
                    <td>record result</td>
                    <td>record date created</td>
                    <td>record date completed</td>
                </tr>
            </tbody>
        </table>

    </div>

</template>