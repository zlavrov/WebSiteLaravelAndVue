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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in rows">
                        <td scope="row">{{ row.title }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.status }}</td>
                        <td>{{ row.created_at | date('YYYY-MM-DD HH:mm:ss') }}</td>
                        <td>{{ row.updated_at | date('YYYY-MM-DD HH:mm:ss') }}</td>
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
            totalRows: 0


        }), mounted() {

            this.loadData();

        }, methods: {

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
            }

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
