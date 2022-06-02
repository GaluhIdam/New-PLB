<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daftar Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
              <li class="breadcrumb-item active">Daftar Pengguna</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUsers">
                  <i class=" fa-solid fa-plus"></i> Tambah Pengguna
                </button>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <!-- <table id="tableUsers" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.type | upText}}</td>
                        <td>{{ user.created_at |tanggalBuat}}</td>
                        <td>
                          <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa-solid fa-edit"></i>
                          </button>
                          <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table> -->
                  <vue-good-table theme="polar-bear" :columns="columns" :rows="user" :fixed-header="true" :search-options="{
                    enabled: true,
                    placeholder: 'Cari Pengguna', }" :pagination-options="{
                    enabled: true,
                    mode: 'records',
                    perPage: 10   ,
                    position: 'bottom',
                    perPageDropdown: [3, 7, 9],
                    dropdownAllowAll: false,
                    setCurrentPage: 1,
                    jumpFirstOrLast : true,
                    firstLabel : 'First',   
                    lastLabel : 'Last',
                    nextLabel: 'Next',
                    prevLabel: 'Before',
                    rowsPerPageLabel: 'Total',
                    ofLabel: 'dari',
                    pageLabel: 'page', // for 'pages' mode
                    allLabel: 'All',}">
                    <template slot="table-row" slot-scope="props">
                      <span v-if="props.column.field === 'aksi'">

                        <button type="button" class="btn btn-warning btn-sm mx-1 rounded-1" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa-solid fa-edit"></i></button>
                        <button type="button" @click="hapusPengguna(props.row.id)" class="btn btn-danger btn-sm mx-1 rounded-1" title="Hapus"><i class="fa-solid fa-trash"></i></button>
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
    <div class="modal fade" id="addUsers" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pengguna</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form @submit.prevent="tambahPengguna">
            <div class="modal-body">
              <AlertError :form="form" />
              <!-- <AlertErrors :form="form" /> -->
              <!-- <AlertSuccess :form="form" message="Your changes have beend saved!" /> -->
              <div class="form-group mb-2">
                <label for="name" class="form-label">Nama Pengguna</label>
                <input id="name" v-model="form.name" type="text" name="name" class="form-control" :class="{'is-invalid' : form.errors.has('name')}" autofocus>
                <HasError :form="form" field="name" />
              </div>
              <div class="form-group mb-2">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" v-model="form.email" type="email" name="email" class="form-control" :class="{'is-invalid' : form.errors.has('email')}">
                <HasError :form="form" field="email" />
              </div>
              <div class="form-group mb-2">
                <label for="username" class="form-label">Username</label>
                <input id="username" v-model="form.username" type="text" name="username" class="form-control" :class="{'is-invalid' : form.errors.has('username')}">
                <HasError :form="form" field="username" />
              </div>

              <div class="form-group mb-2">
                <label for="password" class="form-label">Password</label>
                <input id="password" v-model="form.password" type="password" name="password" class="form-control" :class="{'is-invalid' : form.errors.has('password')}" autocomplete="false">
                <HasError :form="form" field="password" />
              </div>
              <div class="form-group mb-2">
                <label for="password" class="form-label">Role Pengguna</label>
                <select name="type" v-model="form.type" id="type" class="form-control" :class="{'is-invalid' : form.errors.has('type')}">
                  <option value="">Pilih Role Pengguna</option>
                  <option value="admin">Admin</option>
                  <option value="user">Standar User</option>
                  <option value="planner">Planner</option>
                </select>
                <HasError :form="form" field="type" />
              </div>

              <div class="form-group mb-2">
                <label for="password" class="form-label">Bio</label>
                <textarea name="bio" id="bio" v-model="form.bio" class="form-control" :class="{'is-invalid' : form.errors.has('bio')}" rows="3" placeholder="Masukan Bio Pengguna (Optional)"></textarea>
                <HasError :form="form" field="bio" />
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>

        </div>

      </div>

    </div>
    <!-- END: Modal Tambah Pengguna -->

  </div>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
import Swal from "sweetalert2";
import moment from 'moment';
moment.locale('id');
export default {
  data() {
    return {
      user: {},
      form: new Form({
        id: '',
        name: '',
        email: '',
        username: '',
        password: '',
        type: '',
        bio: '',
        avatar: '',
        email_verified_at: '',
      }),
      columns: [
        {
          label: 'Nama Pengguna',
          field: 'name',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
        },
        {
          label: 'Username',
          field: 'username',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
        },
        {
          label: 'Email',
          field: 'email',
          type: 'text',
          tdClass: 'text-center',
          thClass: 'text-center',
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
            return value != null ? moment(value).format('dddd, D-MMMM-YYYY hh:mm:ss') : null
          },
        },
        {
          label: "Aksi",
          field: "aksi",
          tdClass: 'text-center',
          thClass: 'text-center',
        },
      ],
    }
  },

  methods: {
    hapusPengguna(id) {
      Swal.fire({
        title: 'Apakah Kamu yakin ingin menghapusnya?',
        text: "Pengguna tidak dapat dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Pengguna!'
      }).then((result) => {

        // Kirim request ke Server
        if (result.value) {
          axios.delete(`/api/user/${id}`).then(() => {
            Swal.fire(
              'Berhasil!',
              'Pengguna Berhasil dihapus',
              'success'
            )
            this.$emit('AfterDo')
          }).catchSwal.fire(
            'Berhasil!',
            'Pengguna berhasil dihapus.',
            'success'
          );
        }
      })
    },
    ambilPengguna() {
      axios.get('api/user').then(({ data }) => (this.user = data.data));
    },
    tambahPengguna() {
      this.$Progress.start()
      this.form.post('api/user')
        .then(() => {
          this.$emit('AfterDo')
          $('#addUsers').modal('hide')
          toast.fire({
            icon: 'success',
            title: 'Pendaftaran berhasil dilakukan'
          })
          this.$progress.finish();
        })
        .catch(() => {
        })
    },
  },

  created() {
    this.ambilPengguna();
    Fire.$on('AfterDo', () => {
      this.ambilPengguna();
    })
    // setInterval(() => this.ambilPengguna(), 5000);
  },
}


</script>
