<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="showModal()" data-target="#myModal">
              <i class=" fa-solid fa-plus"></i> Tambah Pengguna
            </button>
          </div>

          <div class="card-body">
            <div class="form-group">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Edit | Hapus</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalmuncul1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
      form: new Form({
        id: "",
      }),
    };
  },
  methods: {
    showModal() {
      jQuery.noConflict();
      $('#myModal').modal('show');
    },
  },
  created() { },
};
</script>
