<template>
  <div class="container-fluid" style="margin-top: 20px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h1>Aircraft Mutation</h1>
            <hr />

            <div class="row">
              <div class="col-md-3">
                <input
                  class="form-control me-1"
                  type="search"
                  placeholder="Search"
                  v-model="search"
                />
              </div>
              <div class="col-md-9 text-right">
                <router-link
                  :to="{ name: 'delivery' }"
                  class="btn btn-primary btn-md"
                  role="button"
                  ><i class="fa-solid fa-plus"></i> New Craft Delivery</router-link
                >
              </div>
            </div>
            <br />
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>A/C Reg</th>
                    <th>Operator</th>
                    <th>A/C Type</th>
                    <th>Date In</th>
                    <th>Date Out</th>
                    <th>RKSP</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="(mutation, mutation_index) in mutations.data"
                    :key="mutation_index"
                  >
                    <td>
                      {{ mutations.from + mutation_index }}
                    </td>
                    <td>{{ mutation.reg }}</td>
                    <td>{{ mutation.operator }}</td>
                    <td>{{ mutation.type }}</td>
                    <td>{{ mutation.actual_time_del }}</td>
                    <td>{{ mutation.actual_time }}</td>
                    <td>{{ mutation.rksp }}</td>
                    <td>{{ mutation.activity_type }}</td>
                    <td>
                      <ul class="list-inline m-0">
                        <!-- <li class="list-inline-item">
                                                    <button
                                                        class="
                                                            btn
                                                            btn-success
                                                            btn-sm
                                                            rounded-0
                                                        "
                                                        type="button"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Edit"
                                                    >
                                                        <i
                                                            class="
                                                                fa-solid
                                                                fa-pencil
                                                            "
                                                        ></i>
                                                    </button>
                                                </li> -->
                        <li class="list-inline-item">
                          <button
                            class="btn btn-warning btn-sm rounded-0"
                            type="button"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Delete"
                            @click="deleteData(mutation.id)"
                          >
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr v-if="mutations.data.length < 1">
                    <td colspan="15" class="text-center">Data not found</td>
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
import debounce from "lodash/debounce";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      mutations: {
        data: [],
        links: [],
      },
      search: null,
      start_date: null,
      end_date: null,
      order: "id",
      by: "desc",
    };
  },
  created() {
    this.list();
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 300),
  },
  methods: {
    list(paginate) {
      if (paginate) {
        let url = new URL(paginate);
      }
      this.showLoading();
      paginate = paginate || `/api/aircraft`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
          },
        })
        .then((response) => {
          this.mutations = response.data;
          Swal.close();
        })
        .catch((error) => console.log(error));
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
    deleteData(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#17816d",
        cancelButtonColor: "#f04040",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.showLoading();
          axios
            .delete(`/api/aircraft/${id}`)
            .then((response) => {
              this.list();
              Swal.close();
            })
            .catch((error) => console.log(error));
        }
      });
    },
  },
};
</script>
