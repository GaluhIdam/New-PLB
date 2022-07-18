<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Activity History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="/activity-history">Activity Histroy</a>
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
                  <i class="nav-icon fa-solid fa-server"></i>
                  Activity History
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item"></li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="card">
                          <!--begin::Card header-->
                          <div class="card-header">
                            <!--begin::Card header-->
                            <div class="card-title fs-3 fw-bold">Project Budget</div>
                            <!--end::Card header-->
                          </div>
                          <!--end::Card header-->
                          <!--begin::Card body-->
                          <div class="card-body">
                            <!--begin::Row-->
                            <div class="row mb-8">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Current Status</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <!--begin::Progress-->
                                <div class="d-flex flex-column">
                                  <div class="d-flex justify-content-between w-100 fs-4 fw-bold mb-3">
                                    <span>Budget</span>
                                    <span>$22,300 of 36,000 Used</span>
                                  </div>
                                  <div class="h-8px bg-light rounded mb-3">
                                    <div class="bg-success rounded h-8px" role="progressbar" style="width: 68%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <div class="fw-semibold text-gray-600">14 Targets are remaining</div>
                                </div>
                                <!--end::Progress-->
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Usage Character</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <!--begin::Row-->
                                <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" data-kt-initialized="1">
                                  <!--begin::Col-->
                                  <div class="col-md-4 col-lg-12 col-xxl-4">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                      <!--begin::Radio button-->
                                      <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input class="form-check-input" type="radio" name="usage" value="1" checked="checked" />
                                      </span>
                                      <!--end::Radio button-->
                                      <span class="ms-5">
                                        <span class="fs-4 fw-bold mb-1 d-block">Precise Usage</span>
                                        <span class="fw-semibold fs-7 text-gray-600">Withdraw money to your bank account per transaction under $50,000 budget</span>
                                      </span>
                                    </label>
                                  </div>
                                  <!--end::Col-->
                                  <!--begin::Col-->
                                  <div class="col-md-4 col-lg-12 col-xxl-4">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                      <!--begin::Radio button-->
                                      <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input class="form-check-input" type="radio" name="usage" value="2" />
                                      </span>
                                      <!--end::Radio button-->
                                      <span class="ms-5">
                                        <span class="fs-4 fw-bold mb-1 d-block">Normal Usage</span>
                                        <span class="fw-semibold fs-7 text-gray-600">Withdraw money to your bank account per transaction under $50,000 budget</span>
                                      </span>
                                    </label>
                                  </div>
                                  <!--end::Col-->
                                  <!--begin::Col-->
                                  <div class="col-md-4 col-lg-12 col-xxl-4">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                      <!--begin::Radio button-->
                                      <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input class="form-check-input" type="radio" name="usage" value="3" />
                                      </span>
                                      <!--end::Radio button-->
                                      <span class="ms-5">
                                        <span class="fs-4 fw-bold mb-1 d-block">Extreme Usage</span>
                                        <span class="fw-semibold fs-7 text-gray-600">Withdraw money to your bank account per transaction under $50,000 budget</span>
                                      </span>
                                    </label>
                                  </div>
                                  <!--end::Col-->
                                </div>
                                <!--end::Row-->
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Budget Notes</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <textarea name="notes" class="form-control form-control-solid" rows="5">
Organize your thoughts with an outline. Here’s the outlining strategy I use. I promise it works like a charm. Not only will it make writing your blog post easier, it’ll help you make your message</textarea
                                >
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Manage Budget</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <!--begin::Dialer-->
                                <div class="position-relative w-md-300px" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                  <!--begin::Decrease control-->
                                  <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                    <span class="svg-icon svg-icon-1">
                                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                      </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                  </button>
                                  <!--end::Decrease control-->
                                  <!--begin::Input control-->
                                  <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$36,000.00" />
                                  <!--end::Input control-->
                                  <!--begin::Increase control-->
                                  <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon svg-icon-1">
                                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                      </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                  </button>
                                  <!--end::Increase control-->
                                </div>
                                <!--end::Dialer-->
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Overuse Notifications</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <!--begin::Wrapper-->
                                <div class="d-flex fw-semibold h-100">
                                  <!--begin::Checkbox-->
                                  <div class="form-check form-check-custom form-check-solid me-9">
                                    <input class="form-check-input" type="checkbox" value="" id="email" />
                                    <label class="form-check-label ms-3" for="email">Email</label>
                                  </div>
                                  <!--end::Checkbox-->
                                  <!--begin::Checkbox-->
                                  <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="phone" checked="checked" />
                                    <label class="form-check-label ms-3" for="phone">Phone</label>
                                  </div>
                                  <!--end::Checkbox-->
                                </div>
                                <!--end::Wrapper-->
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row">
                              <!--begin::Col-->
                              <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Allow Changes</div>
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-xl-9">
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                  <input class="form-check-input" type="checkbox" value="" id="allowchanges" checked="checked" />
                                  <label class="form-check-label fw-semibold text-gray-400 ms-3" for="allowchanges">Allowed</label>
                                </div>
                                <!--end::Switch-->
                              </div>
                              <!--end::Col-->
                            </div>
                            <!--end::Row-->
                          </div>
                          <!--end::Card body-->
                          <!--begin::Card footer-->
                          <div class="card-footer d-flex justify-content-end py-6">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                          <!--end::Card footer-->
                        </div>
                      </div>
                    </div>
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

<script>
import axios from 'axios'
import debounce from 'lodash/debounce'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      activities: {
        data: [],
        links: []
      },
      search: null,
      search_username: null,
      search_time: null,
      search_activity: null,
      order: 'id',
      by: 'desc',
      paginate: '10',
      current_page: null
    }
  },
  created() {
    this.list()
  },
  watch: {
    search: debounce(function () {
      this.list()
    }, 500),
    search_id: debounce(function () {
      this.list()
    }, 500),
    search_username: debounce(function () {
      this.list()
    }, 500),
    search_activity: debounce(function () {
      this.list()
    }, 500),
    search_time: debounce(function () {
      this.list()
    }, 0)
  },
  methods: {
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/activity-history`
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_username: this.search_username,
            search_time: this.search_time,
            search_activity: this.search_activity,
            order: this.order,
            by: this.by,
            paginate: this.paginate
          }
        })
        .then((response) => {
          this.activities = response.data
          this.current_page = this.activities.current_page
          Swal.close()
        })
        .catch((error) => console.log(error))
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1
      } else if (this.current_page > this.activities.last_page) {
        this.current_page = this.activities.last_page
      }

      let url = new URL(this.activities.first_page_url)
      let search_params = url.searchParams
      search_params.set('page', this.current_page)
      url.search = search_params.toString()
      let new_url = url.toString()
      this.list(new_url)
    }, 500),
    sort(order, by) {
      this.order = order
      this.by = by
      this.list()
    },
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading()
        },
        background: 'transparent',
        allowOutsideClick: false
      })
    }
  }
}
</script>
