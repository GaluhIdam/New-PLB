<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Users Role</div>
          <div class="card-body">
            <div class="form-group">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Users Role</th>
                    <th>Dibuat</th>
                    <th>Diupdate</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in levels" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.namalevel }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.updated_at }}</td>
                    <td>Edit | Hapus</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      levels: {},
    };
  },
  methods: {
    loadData() {
      // this.$Progress.start();
      axios.get("api/users-role").then(({ data }) => (this.levels = data));
      // this.$Progress.finish();
    },
  },
  created() {
    this.loadData();
  },
};
</script>


