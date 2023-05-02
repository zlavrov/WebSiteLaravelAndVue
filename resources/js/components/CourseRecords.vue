<template>

    <div>
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">

            <h1 class="display-4 fw-normal">Recent course enrollments</h1>

            <div class="row g-3 mt-4">

                <div class="col-md-3">
                    <label class="form-label" for="search-course">Search by course name:</label>
                    <input type="text" class="form-control" id="search-course" v-model="searchCourse" @input="filterData">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="search-user">Search by username or email:</label>
                    <input type="text" class="form-control" id="search-user" v-model="searchUser" @input="filterData">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="status">Entry Status:</label>
                    <select class="form-select" id="status" v-model="status" @change="filterData">
                        <option value="">All entries</option>
                        <option value="in progress">In progress</option>
                        <option value="complete">Completed</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="sort-by">Sort by:</label>
                    <select class="form-select" id="sort-by" v-model="sortBy" @change="filterData">
                        <option value="">Any Sort</option>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in rows">
                        <td scope="row">{{ row.title }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.status }}</td>
                        <td>{{ row.created_at | date('YYYY-MM-DD HH:mm:ss') }}</td>
                        <td>{{ row.updated_at | date('YYYY-MM-DD HH:mm:ss') }}</td>
                        <td class="btn-group">
                            <a class="btn btn-outline-secondary" data-bs-toggle="modal" href="#editRowModal" @click="editrow(row.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <a class="btn btn-outline-secondary" data-bs-toggle="modal" href="#deleteRowModal" @click="deleterow(row.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage == 1 }">
                            <a class="page-link" href="#" aria-label="Previous" @click.prevent="loadData(currentPage - 1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-for="n in lastPage" :key="n" class="page-item" :class="{ active: currentPage == n }">
                            <a class="page-link" href="#" @click.prevent="loadData(n)">{{ n }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage == lastPage }">
                            <a class="page-link" href="#" aria-label="Next" @click.prevent="loadData(currentPage + 1)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="modal fade" id="createRowModal" aria-hidden="true" aria-labelledby="createRowModaleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-4">
                        <h1 class="modal-title fs-5">Create enrollment:</h1>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="user_id" class="col-form-label">User id:</label>
                                <input v-model="form.user_id" type="text" class="form-control" id="user_id">
                            </div>
                            <div class="mb-3">
                                <label for="courses_id" class="col-form-label">Courses id:</label>
                                <input v-model="form.course_id" type="text" class="form-control" id="courses_id">
                            </div>
                            <div class="mb-3">
                                <label for="change_status" class="col-form-label">Change status:</label>
                                <select v-model="form.status_now" class="form-select" id="change_status" aria-label="Default select example">
                                    <option selected></option>
                                    <option value="in progress">in progress</option>
                                    <option value="complete">complete</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button @click="createUser" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editRowModal" aria-hidden="true" aria-labelledby="editRowModaleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editRowModaleLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select" id="changeStatus" v-model="changeStatus" @change="changeStatusMethod" aria-label="Default select example">
                            <option value="" selected>Change status</option>
                            <option value="in progress">in progress</option>
                            <option value="complete">complete</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal" @click="saveEditMethod">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteRowModal" aria-hidden="true" aria-labelledby="deleteRowModaleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteRowModaleLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this row ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal" @click="deleteMethod">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

  </template>

<script>

    import axios from "axios";
    import moment from "moment";

    export default {

        data: () => ({

            rows: [],
            searchCourse: "",
            searchUser: "",
            status: "",
            sortBy: "",

            currentPage: 1,
            lastPage: 1,
            totalRows: 0,

            editNumper: "",
            changeStatus: "",

            deleteNumper: "",

            form: {
                user_id: "",
                course_id: "",
                status_now: ""
            }


        }), mounted() {

            this.loadData();

        }, methods: {

            deleteMethod() {

                axios.delete("/api/enrollments/" + this.deleteNumper, {
                    deleteNumper: this.deleteNumper
                }).then(result => {
                    console.log(result.data);
                    this.deleteNumper = "";
                    this.loadData();
                });
            },

            saveEditMethod() {

                axios.patch("/api/enrollments/" + this.editNumper, {
                    changeStatus: this.changeStatus
                }).then(result => {
                    console.log(result.data);
                    this.changeStatus = "";
                    this.loadData();
                });

            },

            changeStatusMethod() {

            }, 

            editrow(paramEdit) {
                document.getElementById('editRowModaleLabel').innerHTML = 'Edit row ' + paramEdit;
                this.editNumper = paramEdit;
            },

            deleterow(paramDelete) {
                document.getElementById('deleteRowModaleLabel').innerHTML = 'Delete row ' + paramDelete;
                this.deleteNumper = paramDelete
            },

            SearchCourse() {
                this.loadData();
            },

            SearchUser() {
                this.loadData();
            },

            Status() {
                this.loadData();
            },

            Sort() {
                this.loadData();
            },

            filterData() {
                this.loadData();
            },

            loadData(page = 1, perPage = 20) {

                axios.get("/api/enrollments", {
                    params: {
                        searchCourse: this.searchCourse,
                        searchUser: this.searchUser,
                        status: this.status,
                        sortBy: this.sortBy,

                        page: page,
                        perPage: perPage
                    }
                }).then(result => {

                    this.rows = result.data.data;
                    console.log(this.rows);

                    this.currentPage = result.data.current_page;
                    this.lastPage = result.data.last_page;
                    this.totalRows = result.data.total;

                });
            },

            createUser() {

                axios.post("/api/enrollments", {
                        user_id: this.form.user_id,
                        course_id: this.form.course_id,
                        status_now: this.form.status_now
                }).then(result => {
                    console.log(result.data);
                    this.form.user_id = "",
                    this.form.course_id = "",
                    this.form.status_now = ""
                });

            },

        }, filters: {

            date(value) {

                if (!value) {

                    return '';

                } else {

                    return moment(String(value)).format('YYYY-MM-DD HH:mm:ss');

                }
            }
        }
    }

</script>
