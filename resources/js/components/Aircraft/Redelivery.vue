<template>
  <div class="container-fluid" style="margin-top: 50px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h1>Aircraft Redelivery</h1>
            <hr />

            <br />

            <br /><br /><br /><br />
            <div class="mb-4">
              <label for="formFile" class="form-label">A/C Registration</label>
              <input class="form-control" type="file" id="formFile" />
            </div>
            <br />
            <div class="row mb-4">
              <div class="col">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="reg">Operator</label>
                    <input type="text" id="form3Example5" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <br /><br />
            <div class="row mb-4">
              <div class="col">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="reg">A/C Type</label>
                    <input type="text" id="form3Example5" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <br /><br />
            <div class="row mb-4">
              <div class="col">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="eta">Actual Time Depart</label>
                    <input type="text" id="form3Example6" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br />
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
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
