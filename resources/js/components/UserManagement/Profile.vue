<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
              <li class="breadcrumb-item active"><a href="/profile">Profile</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card card-widget widget-user">
              <div class="widget-user-header text-white" style="background: url('./img/photo1.png') center center;">
                <h3 class="widget-user-username text-left">{{ this.form.name }}</h3>
                <h5 class="widget-user-desc text-left">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>

                  </div>

                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>

                  </div>

                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>

                  </div>

                </div>

              </div>
            </div>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <h1 class="text-center">Display User Activity</h1>
                  </div>

                  <div class="tab-pane active" id="settings">
                    <form>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input id="name" v-model="form.name" type="text" name="name" placeholder="Nama Lengkap" class="form-control" :class="{'is-invalid' : form.errors.has('name')}" autofocus>
                            <HasError :form="form" field="name" />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Username</label>
                            <input id="username" v-model="form.username" type="text" name="username" class="form-control" :class="{'is-invalid' : form.errors.has('username')}" placeholder="Username">
                            <HasError :form="form" field="username" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Email</label>
                            <input id="email" v-model="form.email" type="email" name="email" placeholder="Email" class="form-control" :class="{'is-invalid' : form.errors.has('email')}">
                            <HasError :form="form" field="email" />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Password</label>
                            <input id="password" v-model="form.password" type="password" name="password" placeholder="Password" class="form-control" :class="{'is-invalid' : form.errors.has('password')}" autocomplete="false">
                            <HasError :form="form" field="password" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">

                          <div class="form-group">
                            <label>Role</label>
                            <select name="role" v-model="form.role" id="role" class="form-control" :class="{'is-invalid' : form.errors.has('role')}">
                              <option value="">Pilih Role Pengguna</option>
                              <option value="admin">Admin</option>
                              <option value="user">Standar User</option>
                              <option value="planner">Planner</option>
                            </select>
                            <HasError :form="form" field="role" />
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="photo">Profile Photo</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input v-on:change="updatePhoto" type="file" id="photo" class="form-control" :class="{'is-invalid' : form.errors.has('photo')}">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Keterangan (Optional)</label>
                            <textarea v-model="form.description" id="description" class="form-control" :class="{'is-invalid' : form.errors.has('description')}" rows="3" placeholder="Masukan keterangan pengguna" name="description"></textarea>
                            <HasError :form="form" field="description" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <button @click.prevent="updateInfo" type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.widget-user-header {
  background-position: center center;
}
</style>
<script>
import Form from 'vform'
import axios from 'axios'
import Swal from "sweetalert2";

export default {
  data() {
    return {
      form: new Form({
        id: '',
        name: '',
        email: '',
        username: '',
        password: '',
        role: '',
        description: '',
        photo: '',
        email_verified_at: '',
      })
    }
  },
  methods: {
    getProfilePhoto() {
      let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/" + this.form.photo;
      return photo;
    },
    updateInfo() {
      this.$Progress.start()

      this.form.put('api/profile/')
        .then(() => {
          Fire.$emit('RefreshTable');
          this.$Progress.finish()

        })
        .catch(() => {
          this.$Progress.fail()

        });

    },
    updatePhoto(e) {
      let file = e.target.files[0];
      console.log(file);
      let reader = new FileReader();
      if (file['size'] < 2097152) {
        reader.onloadend = (file) => {
          // console.log('RESULT ', reader.result)
          this.form.photo = reader.result;
        }
        reader.readAsDataURL(file);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Ukuran File tidak boleh lebih dari 2mb!',
        })
      }

    }
  },
  created() {
    axios.get('api/profile')
      .then(({ data }) => (this.form.fill(data)));
    Fire.$on('RefreshTable', () => {
      axios.get('api/profile')
        .then(({ data }) => (this.form.fill(data)));
    });
  }

}
</script>
