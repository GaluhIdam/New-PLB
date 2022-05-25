
<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- START: Report Inbound -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Report</h4>
                <h5>Inbound</h5>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file-arrow-down"></i>
              </div>
              <a href="#" class="small-box-footer">View Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- START: Report Outbound -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h4>Report</h4>
                <h5>Outbound</h5>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file-arrow-up"></i>
              </div>
              <a href="#" class="small-box-footer">View Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- END: Report Outbound -->

          <!-- START: Report Mutasi -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>Report</h4>
                <h5>Mutasi</h5>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file-circle-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer">View Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- END: Report Mutasi -->
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header text-center bg-success">
                <div class="d-flex align-items-center">
                  <h5 class="mx-auto w-100">Coming Soon</h5>
                </div>
              </div>
              <div class="card-body">
                <h2 class="text-center">Under Devleopment</h2>
                <h1 class="text-center"><i class="fa-solid fa-laptop-code"></i></h1>
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
    console.log('Component mounted.')
  }
}
</script>