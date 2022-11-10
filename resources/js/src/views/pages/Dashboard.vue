<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
    <div class="content" id="chart">
      <div class="container-fluid">
        <div class="row">
          <!-- BEGIN: Status Outbound -->
          <div class="col-md-6">
            <div class="card card-plb">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status Outbound</h5>
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <!-- <div> -->
                  <pie-one
                    type="pie"
                    width="450"
                    ref="pie_one"
                    :options="pie_one.chartOptions"
                    :series="pie_one.series"
                  ></pie-one>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Status Part Consume Install Periode</h5>
              </div>
            </div>
          </div>
          <!-- BEGIN: Status Pesawat di GMF -->
          <div class="col-md-6">
            <div class="card card-plb">
              <div class="card-header border-0 ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  Status Pesawat di GMF
                </h5>
                <div class="card-tools">
                  <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <pie-two
                    type="pie"
                    width="450"
                    ref="pie_two"
                    :options="pie_two.chartOptions"
                    :series="pie_two.series"
                  ></pie-two>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Jumlah Pesawat yang ada di Hangar</h5>
              </div>
            </div>
          </div>
          <!-- END: Status Pesawat di GMF -->
          <!-- BEGIN: Status BC28 -->
          <div class="col-md-12">
            <div class="card card-plb">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status BC28</h5>
                <div class="card-tools">
                  <button
                    type="button"
                    data-card-widget="collapse"
                    class="btn btn-tool"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label"
                          >Range Tanggal</label
                        >
                        <div class="col-sm-4">
                          <datepicker
                          input-class="form-control text-center"
                          placeholder="Dari Tanggal"
                          format="dd/MM/yyyy"
                          @input="chartThree()"
                          v-model="from"
                        />
                        </div>
                        <div class="col-sm-4">
                          <datepicker
                                input-class="form-control text-center"
                                placeholder="Sampai Tanggal"
                                format="dd/MM/yyyy"
                                @input="chartThree()"
                                v-model="to"
                              />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <column-one
                  type="line"
                  ref="column_one"
                  height="400"
                  :options="column_one.chartOptions"
                  :series="column_one.series"
                ></column-one>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Status BC 28</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      from: "2022-06-01",
      to: "2022-12-31",
      // Status Outbound
      pie_one: {
        series: [],
        chartOptions: {
          chart: {
            width: 450,
            type: "pie",
          },
          theme: {
            palette: "palette6",
          },
          legend: {
            show: true,
            position: "bottom",
            floating: false,
            fontSize: "14px",
            fontFamily: "Helvetica, Arial",
          },

          labels: [],
          plotOptions: {
            pie: {
              dataLabels: {
                offset: -5,
              },
            },
          },
          dataLabels: {
            enabled: true,
            style: {
              colors: ["#111"],
            },
            background: {
              enabled: true,
              foreColor: "#fff",
              borderWidth: 0,
            },
          },
        },
      },

      //  Status Pesawat di GMF
      pie_two: {
        series: [],
        chartOptions: {
          chart: {
            type: "pie",
            width: 450,
          },
          theme: {
            palette: "palette1",
          },
          legend: {
            show: true,
            position: "bottom",
            floating: false,
            fontSize: "14px",
            fontFamily: "Helvetica, Arial",
          },
          labels: [],
          plotOptions: {
            pie: {
              dataLabels: {
                offset: -5,
              },
            },
          },
          dataLabels: {
            enabled: true,
            style: {
              colors: ["#111"],
            },
            background: {
              enabled: true,
              foreColor: "#fff",
              borderWidth: 0,
            },
          },
        },
      },

      // Status BC
      column_one: {
        series: [
          {
            name: "Nilai Pembayaran",
            type: "column",
            data: [],
          },
          {
            name: "Jumlah BC",
            type: "line",
            data: [],
          },
        ],
        chartOptions: {
          chart: {
            height: 400,
            type: "line",
          },
          stroke: {
            width: [0, 4],
          },
          dataLabels: {
            enabled: true,
            enabledOnSeries: [1],
            style: {
              colors: ["#4472C4", "#4472C4"],
            },
          },
          labels: [],
          xaxis: {
            type: "category",
          },
          yaxis: [
            {
              title: {
                text: "Nilai Pembayaran",
              },
            },
            {
              opposite: true,
              title: {
                text: "Jumlah BC",
              },
            },
          ],
          fill: {
            colors: ["#ED7D31"],
          },
          colors: ["#ED7D31", "#4472C4"],
        },
      },
    };
  },
  created() {
    this.chartOne();
    this.chartTwo();
    this.chartThree();
  },
  methods: {
    // Status Part Consume Install Periode
    chartOne() {
      const series_one = [];
      const label_one = [];
      axios
        .get("api/dashboard-one")
        .then((response) => {
          response.data.map((item) => {
            series_one.push(item.series);
            label_one.push(item.labels);
          });
          this.pie_one.series = series_one;
          this.$refs.pie_one.updateOptions({ labels: label_one });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // Status Pesawat di GMF
    chartTwo() {
      const series_two = [];
      const label_two = [];
      axios
        .get("api/dashboard-two")
        .then((response) => {
          response.data.map((item) => {
            series_two.push(item.series);
            label_two.push(item.labels);
          });
          this.pie_two.series = series_two;
          this.$refs.pie_two.updateOptions({ labels: label_two });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Status BC 28
    chartThree() {
      const series_three_one = [];
      const series_three_two = [];
      const label_three = [];
      axios
        .get("api/dashboard-three", {
          params: {
            from: this.from,
            to: this.to,
          },
        })
        .then((response) => {
          response.data.map((item) => {
            series_three_one.push(item.series);
            series_three_two.push(item.value);
            label_three.push(item.labels);
          });
          this.column_one.series[0].data = series_three_two;
          this.column_one.series[1].data = series_three_one;
          this.$refs.column_one.updateOptions({ labels: label_three });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
