<template>
  <div>
    <!-- BEGIN: Judul User Management -->
    <div class="content-header" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Home</router-link>
              </li>
              <li class="breadcrumb-item active">
                <router-link to="/users-list">User Management</router-link>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Judul User Management -->
    <!-- BEGIN: Content User Management -->
    <div class="content" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card card-plb">
              <!-- BEGIN: Card Header -->
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="fas fa-user-cog mr-1"></i>
                  User Management
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <button type="button" class="btn btn-primary btn-sm" @click="newModal">
                        <i class="fa-solid fa-user-plus"></i> Add User
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- END: Card Header -->

              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <div class="form-group">
                  <div class="vgt-inner-wrap">
                    <!-- BEGIN: Global Search Button -->
                    <div class="vgt-global-search vgt-clearfix">
                      <!-- BEGIN: Button Left (Search) -->
                      <div class="vgt-global-search__input vgt-pull-left">
                        <label>
                          <span aria-hidden="true" class="input__icon">
                            <div class="magnifying-glass"></div>
                          </span>
                          <span class="sr-only"> Search </span>
                        </label>
                        <input type="text" placeholder="Search User" class="vgt-input vgt-pull-left" v-model="search" />
                      </div>
                      <div class="vgt-global-search__actions vgt-pull-right">
                        <div>
                          <!-- <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button> -->
                        </div>
                      </div>
                      <!-- END: Button Left (Search)-->
                    </div>
                    <!-- END Global Search Button -->
                    <div class="vgt-responsive">
                      <table id="vgt-table" class="vgt-table bordered polar-bear">
                        <thead>
                          <tr>
                            <!-- BEGIN: Number by ID (Table Header) -->
                            <th class="text-center">
                              <span class="table_header">No.</span>
                            </th>
                            <!-- END: Number by ID (Table Header) -->
                            <!-- BEGIN: Username (Table Header) -->
                            <th v-if="order == 'username' && by == 'asc'" @click="sort('username', 'desc')"
                              class="text-center sortable sorting sorting-asc">
                              <span class="table_header">Username</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else-if="order == 'username' && by == 'desc'" @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc">
                              <span class="table_header">Username</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else @click="sort('username', 'asc')" class="text-center sortable">
                              <span class="table_header">Username</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Username (Table Header) -->
                            <!-- BEGIN: Role (Table Header) -->
                            <th v-if="order == 'role' && by == 'asc'" @click="sort('role', 'desc')"
                              class="text-center sortable sorting sorting-asc">
                              <span class="table_header">Role</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else-if="order == 'role' && by == 'desc'" @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc">
                              <span class="table_header">Role</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else @click="sort('role', 'asc')" class="text-center sortable">
                              <span class="table_header">Role</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Role (Table Header) -->
                            <!-- BEGIN: Email (Table Header) -->
                            <th v-if="order == 'email' && by == 'asc'" @click="sort('email', 'desc')"
                              class="text-center sortable sorting sorting-asc">
                              <span class="table_header">Email</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else-if="order == 'email' && by == 'desc'" @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc">
                              <span class="table_header">Email</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else @click="sort('email', 'asc')" class="text-center sortable">
                              <span class="table_header">Email</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Email (Table Header) -->
                            <!-- BEGIN: Date Created (Table Header) -->
                            <th v-if="order == 'created_at' && by == 'asc'" @click="sort('created_at', 'desc')"
                              class="text-center sortable sorting sorting-asc">
                              <span class="table_header">Date Created</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else-if="order == 'created_at' && by == 'desc'" @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc">
                              <span class="table_header">Date Created</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th v-else @click="sort('created_at', 'asc')" class="text-center sortable">
                              <span class="table_header">Date Created</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Date Created (Table Header) -->
                            <!-- BEGIN: Action (Table Header) -->
                            <th class="text-center">
                              <span class="table_header">Action</span>
                            </th>
                            <!-- END: Action (Table Header) -->
                          </tr>
                          <tr>
                            <th class="filter-th"></th>
                            <th class="filter-th">
                              <div>
                                <input type="text" class="vgt-input text-center" placeholder="Search Username"
                                  v-model="search_username" />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input type="text" class="vgt-input text-center" placeholder="Search Role"
                                  v-model="search_role" />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input type="text" class="vgt-input text-center" placeholder="Search Email"
                                  v-model="search_email" />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input type="date" class="vgt-input text-center" v-model="search_created_at" />
                              </div>
                            </th>
                            <th class="filter-th"></th>
                          </tr>
                        </thead>
                        <!-- END: Table Head -->

                        <!-- BEGIN: Table Body -->

                        <tbody>
                          <tr v-for="(user, user_index) in users.data" :key="user_index">
                            <td class="text-center table-content">
                              {{ user_index + 1 }}
                            </td>
                            <td class="text-center table-content">
                              {{ user.username }}
                            </td>
                            <td class="text-center table-content">
                              {{ user.role | upperCase }}
                            </td>
                            <td class="text-center table-content">
                              {{ user.email }}
                            </td>
                            <td class="text-center table-content">
                              {{ user.created_at | myDate }}
                            </td>
                            <td class="text-center table-content">
                              <button class="btn btn-warning btn-sm rounded-1 mx-1" title="Edit"
                                @click="editModal(user)">
                                <i class="fa-solid fa-edit"></i> Edit
                              </button>
                              <button class="btn btn-danger btn-sm rounded-1" @click="deleteUser(user.id)">
                                <i class="fa-solid fa-trash"></i> Delete
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="vgt-wrap__footer vgt-clearfix">
                      <div class="footer__row-count vgt-pull-left">
                        <label class="footer__row-count__label row_per_page_label">
                          Rows per page:
                        </label>
                        <select class="footer__row-count__select row_per_page_option" v-model="paginate"
                          @change="list()">
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select>
                      </div>
                      <div class="footer__navigation vgt-pull-right">
                        <button type="button" class="footer__navigation__page-btn" :class="{
                          disabled: !users.prev_page_url,
                        }" @click="
  users.prev_page_url && list(users.prev_page_url)
" style="margin-right: 0px">
                          <span aria-hidden="true" class="chevron left"></span>
                          <span class="paginate_text">Prev</span>
                        </button>
                        <div class="footer__navigation__page-info" style="color: #99a0b2">
                          <label class="page-info__label" style="margin-bottom: -5px">
                            <span class="paginate_text">page</span>
                            <input type="text" class="
                                footer__navigation__page-info__current-entry
                                vgt-input
                              " v-model="current_page" @keypress="directPage" style="width: 60px" />
                            <span class="paginate_text">
                              of
                              {{ users.last_page }}
                            </span>
                          </label>
                        </div>
                        <button type="button" class="footer__navigation__page-btn" :class="{
                          disabled: !users.next_page_url,
                        }" @click="
  users.next_page_url && list(users.next_page_url)
">
                          <span style="font-weight: 500">Next</span>
                          <span aria-hidden="true" class="chevron right"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Card Body -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Content User Management -->

    <!-- BEGIN : Modal Add / Edit User  -->
    <div class="modal fade" id="addUsers" style="display: none" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-show="!editmode">Add User</h4>
            <h4 class="modal-title" v-show="editmode">Update User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
              <!-- <AlertErrors
                :form="form"
                message="Periksa kembali data yang anda masukan!"
              /> -->
              <!-- BEGIN: Nama dan Email -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input id="name" v-model="form.name" type="text" name="name" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }" autofocus />
                    <HasError :form="form" field="name" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" v-model="form.email" type="email" name="email" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }" />
                    <HasError :form="form" field="email" />
                  </div>
                </div>
              </div>
              <!-- END: Nama dan Email -->

              <!-- BEGIN: Username dan Password -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" v-model="form.username" type="text" name="username" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('username') }" />
                    <HasError :form="form" field="username" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" v-model="form.password" type="password" name="password" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('password') }" autocomplete="false" />
                    <HasError :form="form" field="password" />
                  </div>
                </div>
              </div>
              <!-- END: Username dan Password -->

              <!-- BEGIN: Role Pengguna -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group mb-2">
                    <label for="password" class="form-label">Role Pengguna</label>
                    <select name="role" v-model="form.role" id="role" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('role') }">
                      <option value="">Pilih Role Pengguna</option>
                      <option value="admin">Admin</option>
                      <option value="user">Standar User</option>
                      <option value="planner">Planner</option>
                    </select>
                    <HasError :form="form" field="role" />
                  </div>
                </div>
              </div>
              <!-- END: Role Pengguna -->

              <!-- BEGIN: Keterangan Pengguna -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group mb-2">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea name="description" id="description" v-model="form.description" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('description') }" rows="3"
                      placeholder="Masukan Keterangan Pengguna (Optional)"></textarea>
                    <HasError :form="form" field="description" />
                  </div>
                </div>
              </div>
              <!-- END: Keterangan Pengguna -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
              <button v-show="editmode" type="submit" class="btn btn-success">
                Update
              </button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END: Modal Add / Edit User -->

    <!-- Handle Error if !Admin -->
    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import axios from "axios";
import debounce from "lodash/debounce";
import Swal from "sweetalert2";
import moment from "moment";
moment.locale("id");

export default {
  data() {
    return {
      editmode: false,
      users: {
        data: [],
      },
      search: "",
      search_id: "",
      search_username: "",
      search_email: "",
      search_role: "",
      search_created_at: "",
      search_updated_at: "",
      search_description: "",
      order: "id",
      by: "asc",
      current_page: null,
      paginate: "10",
      form: new Form({
        id: "",
        name: "",
        email: "",
        username: "",
        password: "",
        role: "",
        description: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created() {
    this.list();
    Fire.$on("RefreshTable", () => {
      this.list();
    });
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_id: debounce(function () {
      this.list();
    }, 500),
    search_username: debounce(function () {
      this.list();
    }, 500),
    search_email: debounce(function () {
      this.list();
    }, 500),
    search_role: debounce(function () {
      this.list();
    }, 500),
    search_created_at: debounce(function () {
      this.list();
    }, 500),
    search_updated_at: debounce(function () {
      this.list();
    }, 500),
    search_description: debounce(function () {
      this.list();
    }, 500),
  },

  methods: {
    list(paginate) {
      this.showLoading();
      paginate = paginate || `/api/user`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_id: this.search_id,
            search_username: this.search_username,
            search_email: this.search_email,
            search_role: this.search_role,
            search_created_at: this.search_created_at,
            search_updated_at: this.search_updated_at,
            search_description: this.search_description,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.users = response.data;
          this.current_page = this.users.current_page;
          Swal.close();
        })
        .catch((error) => {
          Swal.close();
          this.showErrorRequest();
          console.log(error);
        });
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.paginate.last_page) {
        this.current_page = this.paginate.last_page;
      }
      let url = new URL(this.users.first_page_url);
      let search_params = new URLSearchParams(url.search);
      search_params.set("page", this.current_page);
      url.search = search_params.toString();
      let new_url = url.toString();
      this.list(new_url);
    }, 500),
    sort(order, by) {
      this.order = order;
      this.by = by;
      this.list();
    },
    deleteUser(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // Kirim request ke Server
        if (result.value) {
          axios
            .delete(`/api/user/${id}`)
            .then(() => {
              Swal.fire("Berhasil!", "Pengguna Berhasil dihapus", "success");
              Fire.$emit("RefreshTable");
            })
            .catch((error) => {
              Swal.close();
              this.showErrorDelete();
              console.log(error);
            });
        }
      });
    },
    createUser() {
      this.showLoading();
      this.form
        .post("api/user")
        .then(() => {
          $("#addUsers").modal("hide");
          Swal.close();
          this.showSuccessCreate();
          this.clearForm();
          this.list();
        })
        .catch((error) => {
          Swal.close();
          this.showErrorCreate();
          console.log(error);
        });
    },
    clearForm() {
      this.form.errors.clear();
      this.form.id = "";
      this.form.name = "";
      this.form.email = "";
      this.form.username = "";
      this.form.password = "";
      this.form.role = "";
      this.form.description = "";
    },
    newModal() {
      this.editmode = false;
      this.clearForm();
      $("#addUsers").modal("show");
    },
    editModal(users) {
      this.editmode = true;
      this.clearForm();
      $("#addUsers").modal("show");
      this.form.id = users.id;
      this.form.name = users.name;
      this.form.email = users.email;
      this.form.username = users.username;
      this.form.password = users.password;
      this.form.role = users.role;
      this.form.description = users.description;
      console.log(users);
    },
    updateUser(form) {
      this.showLoading();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          Fire.$emit("RefreshTable");
          $("#addUsers").modal("hide");
          Swal.close();
          this.clearForm();
          this.showSuccessUpdate();
        })
        .catch((error) => {
          Swal.close();
          this.showErrorUpdate();
          console.log(error);
        });
    },
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading();
        },
        background: "transparent",
        allowOutsideClick: false,
      });
    },
    showSuccessRequest() {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Retrieve Data',
        showConfirmButton: false,
        timer: 1500
      })
    },
    showErrorRequest() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Retrieve Data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    showSuccessCreate() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: "Successfully Create User data",
        showConfirmButton: false,
        timer: 1500,
      })
    },
    showErrorCreate() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Create User data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    showSuccessUpdate() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: "Successfully Update User data",
        showConfirmButton: false,
        timer: 1500,
      })
    },
    showErrorUpdate() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Update User data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    showSuccessEDelete() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
    },
    showErrorDelete() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Delete User",
        showConfirmButton: false,
        timer: 1500,
      });
    },
  },
};
</script>
<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
  margin-top: -3px;
}
</style>
