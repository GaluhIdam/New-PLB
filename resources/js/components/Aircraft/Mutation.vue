<template>
  <div class="container-fluid" style="margin-top: 50px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="d-flex"></form>
            <div class="text-left">
              <h1>Aircraft Mutation</h1>
            </div>

            <input
              class="form-control me-1"
              type="search"
              placeholder="Search"
              aria-label="Search"
            /><br />
            <router-link
              :to="{ name: 'delivery' }"
              class="btn btn-primary btn-lg"
              role="button"
              ><i class="fa-solid fa-plus"></i> New Craft Delivery</router-link
            >
            <br />
            <br />
            <div class="container">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>A/C Reg</th>
                    <th>A/C Type</th>
                    <th>Operator</th>
                    <th>ATA</th>
                    <th>ATD</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1</td>
                    <td>VH-XNU</td>
                    <td>B737-300</td>
                    <td>Nauru Airlines</td>
                    <td>Field Kosong</td>
                    <td>Field Kosong</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <button
                            class="btn btn-success btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Edit"
                          >
                            <i class="fa-solid fa-pencil"></i>
                          </button>
                        </li>
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
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
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
