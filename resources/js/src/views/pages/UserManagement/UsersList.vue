<template>
  <div>
    <div class="content-header" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
              <li class="breadcrumb-item active"><a href="/users-list">Daftar Pengguna</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-success btn-sm" @click="newModal"><i class="fa-solid fa-user-plus"></i> Tambah Pengguna</button>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <vue-good-table
                    theme="polar-bear"
                    :columns="columns"
                    :rows="users"
                    :fixed-header="true"
                    :search-options="{
                      enabled: true,
                      placeholder: 'Cari Pengguna'
                    }"
                    :pagination-options="{
                      enabled: true,
                      mode: 'pages',
                      perPage: 10,
                      position: 'bottom',
                      perPageDropdown: [20, 30, 40, 50],
                      dropdownAllowAll: true,
                      setCurrentPage: 1,
                      jumpFirstOrLast: true,
                      rowsPerPageLabel: 'Rows per page',
                      ofLabel: 'of',
                      pageLabel: 'pages', // for 'pages' mode
                      allLabel: 'All'
                    }"
                  >
                    <div slot="table-actions">
                      <button class="btn btn-secondary ms-auto rounded-1"><i class="fa-solid fa-copy"></i> Copy</button>
                      <button class="btn btn-secondary ms-auto rounded-1"><i class="fa-solid fa-print"></i> Print</button>
                      <button class="btn btn-secondary ms-auto rounded-1"><i class="fa-solid fa-file-csv"></i> CSV</button>
                      <button class="btn btn-secondary ms-auto rounded-1"><i class="fa-solid fa-file-excel"></i> Excel</button>
                      <button class="btn btn-secondary ms-auto rounded-1" style="margin-right: 10px"><i class="fa-solid fa-file-pdf"></i>PDF</button>
                    </div>
                    <template slot="table-row" slot-scope="props">
                      <span v-if="props.column.field === 'action'">
                        <button type="button" @click="editModal(props)" class="btn btn-warning btn-sm mx-1 rounded-1" title="Ubah"><i class="fa-solid fa-edit"></i></button>
                        <button type="button" @click="deleteUser(props.row.id)" class="btn btn-danger btn-sm mx-1 rounded-1" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                      </span>
                      <span v-else> {{ props.formattedRow[props.column.field] }} </span>
                    </template>
                  </vue-good-table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- BEGIN: Modal Tambah Pengguna -->
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
              <AlertErrors :form="form" message="Periksa kembali data yang anda masukan!" />
              <!-- BEGIN: Nama dan Email -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input id="name" v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" autofocus />
                    <HasError :form="form" field="name" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" v-model="form.email" type="email" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" />
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
                    <input id="username" v-model="form.username" type="text" name="username" class="form-control" :class="{ 'is-invalid': form.errors.has('username') }" />
                    <HasError :form="form" field="username" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" autocomplete="false" />
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
                    <select name="role" v-model="form.role" id="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
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
                    <textarea name="description" id="description" v-model="form.description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" rows="3" placeholder="Masukan Keterangan Pengguna (Optional)"></textarea>
                    <HasError :form="form" field="description" />
                  </div>
                </div>
              </div>
              <!-- END: Keterangan Pengguna -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END: Modal Tambah Pengguna -->

    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
  </div>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
import Swal from 'sweetalert2'
import moment from 'moment'
moment.locale('id')

export default {
  name: 'users',
  data() {
    return {
      editmode: false,
      users: [],
      form: new Form({
        id: '',
        name: '',
        email: '',
        username: '',
        password: '',
        role: '',
        description: '',
        photo: '',
        email_verified_at: ''
      }),
      // Columns Vue-GoodTable
      columns: [
        {
          label: 'Nama Pengguna',
          field: 'name',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
          filterOptions: {
            enabled: true,
            customFilter: true,
            placeholder: 'Cari Nama Pengguna'
          }
        },
        {
          label: 'Username',
          field: 'username',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
          filterOptions: {
            enabled: true,
            customFilter: true,
            placeholder: 'Cari Username'
          }
        },
        {
          label: 'Email',
          field: 'email',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
          filterOptions: {
            enabled: true,
            customFilter: true,
            placeholder: 'Cari Email'
          }
        },
        {
          label: 'Role',
          field: 'role',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
          filterOptions: {
            enabled: true,
            customFilter: true,
            placeholder: 'Cari Role',
            formatValue: this.upperCase
          },
          formatFn: function (value) {
            return value.charAt(0).toUpperCase() + value.slice(1)
          }
        },
        {
          label: 'Tanggal dibuat',
          field: 'created_at',
          type: 'date',
          tdClass: 'text-center',
          thClass: 'text-center',
          formatFn: function (value) {
            return value != null ? moment(value).format('dddd, D-MMMM-YYYY') : null
          }
        },
        {
          label: 'Aksi',
          field: 'action',
          tdClass: 'text-center',
          thClass: 'text-center'
        }
      ]
    }
  },

  methods: {
    newModal() {
      this.editmode = false
      this.form.reset() //Reset Form Modal AddUsers
      $('#addUsers').modal('show')
    },
    editModal(users) {
      this.editmode = true
      this.form.reset() //Reset Form Modal AddUsers
      $('#addUsers').modal('show')
      this.form.fill(users.row)
      console.log(users)
    },
    updateUser() {
      this.$Progress.start()
      this.form
        .put('api/user/' + this.form.id)
        .then(() => {
          $('#addUsers').modal('hide')
          toast.fire({
            icon: 'success',
            title: 'Pengguna berhasil diperbarui'
          })
          this.$Progress.finish()
          Fire.$emit('RefreshTable')
        })
        .catch(() => {
          this.$Progress.fail()
        })
    },

    deleteUser(id) {
      Swal.fire({
        title: 'Apakah Kamu yakin ingin menghapusnya?',
        text: 'Pengguna tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Pengguna!'
      }).then((result) => {
        // Kirim request ke Server
        if (result.value) {
          axios
            .delete(`/api/user/${id}`)
            .then(() => {
              Swal.fire('Berhasil!', 'Pengguna Berhasil dihapus', 'success')
              Fire.$emit('RefreshTable')
            })
            .catch((error) => console.log(error))
        }
      })
    },
    loadUsers() {
      if (this.$gate.isAdmin) {
        axios.get('api/user').then((response) => {
          this.users = response.data.data
        })
        // axios.get('api/user').then(({ data }) => (this.user = data.data));
      }
    },
    createUser() {
      this.$Progress.start()
      this.form
        .post('api/user')
        .then(() => {
          Fire.$emit('RefreshTable')
          $('#addUsers').modal('hide')
          toast.fire({
            icon: 'success',
            title: 'Pendaftaran berhasil dilakukan'
          })
          this.$Progress.finish()
        })
        .catch(() => {})
    }
  },

  created() {
    this.loadUsers()
    Fire.$on('RefreshTable', () => {
      this.loadUsers()
    })
    // setInterval(() => this.LoadUsers(), 5000);
  }
}
</script>