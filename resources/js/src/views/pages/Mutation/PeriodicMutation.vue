<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Mutasi Berkala</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">
                <a href="/periodic-mutation">Report Mutasi Berkala</a>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="fa-solid fa-file-circle-exclamation mr-1"></i>
                  Report Mutasi Berkala
                </h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <div class="card-body">
                <form class="form-horizontal">
                  <div class="form-group row justify-content-center align-items-center">
                    <label for="part_number" class="col-form-label">Tanggal Mutasi</label>
                    <div class="col-sm-3">
                      <input
                        type="date"
                        class="form-control"
                        id="part_number"
                        name="part_number"
                        autofocus
                      />
                    </div>
                    <div class="col-sm-3">
                      <input
                        type="date"
                        class="form-control"
                        id="part_number"
                        name="part_number"
                        autofocus
                      />
                    </div>
                  </div>
                  <div class="form-group row justify-content-center align-items-center">
                    <div class="offset-sm-5 col-sm-10">
                      <button class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i> Search
                      </button>
                      <button class="btn btn-secondary">
                        <i class="fa-solid fa-rotate"></i> Reset
                      </button>
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
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
