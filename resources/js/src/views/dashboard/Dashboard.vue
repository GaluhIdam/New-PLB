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
          <div class="col-md-7">
            <div class="card card-dashboard">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status Outbound</h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <pie-one
                    type="pie"
                    ref="pie_one"
                    width="615"
                    :options="pie_one.chartOptions"
                    :series="pie_one.series"
                  ></pie-one>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Status Part Consume Install Tahun 2022</h5>
              </div>
            </div>
          </div>
          <!-- END: Status Outbound -->

          <!-- BEGIN: Status Pesawat di GMF -->
          <div class="col-md-5">
            <div class="card card-dashboard">
              <div class="card-header border-0 ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status Pesawat di GMF</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <pie-two
                    type="pie"
                    ref="pie_two"
                    width="350"
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
        </div>
        <!-- END: Status Pesawat di GMF -->

        <!-- BEGIN: Status BC28 -->
        <div class="row">
          <div class="col-md-4">
            <div class="card card-dashboard">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status BC28</h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <column-one
                    type="line"
                    ref="column_one"
                    :options="column_one.chartOptions"
                    :series="column_one.series"
                  ></column-one>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Status BC 28 Tahun 2022</h5>
              </div>
            </div>
          </div>
          <!-- END: Status BC28 -->

          <!-- BEGIN: Saldo Akhir Allotment -->
          <div class="col-md-4">
            <div class="card card-dashboard">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Saldo Akhir Allotment</h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <column-two
                    type="bar"
                    ref="column_two"
                    :options="column_two.chartOptions"
                    :series="column_two.series"
                  ></column-two>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Total Quantity</h5>
              </div>
            </div>
          </div>
          <!-- END: Saldo Akhir Allotment -->

          <!-- BEGIN: Status Masa Timbun -->
          <div class="col-md-4">
            <div class="card card-dashboard">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">Status Masa Timbun</h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="align-items-center d-flex justify-content-center">
                  <pie-three
                    type="pie"
                    ref="pie_three"
                    width="325"
                    :options="pie_three.chartOptions"
                    :series="pie_three.series"
                  ></pie-three>
                </div>
              </div>
              <div class="card-footer text-center p-1">
                <h5>Status Masa Timbun BC 16</h5>
              </div>
            </div>
          </div>
          <!-- END: Status Masa Timbun -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import axios from "axios";

Vue.component("pie-one", VueApexCharts);
Vue.component("pie-two", VueApexCharts);
Vue.component("pie-three", VueApexCharts);
Vue.component("column-one", VueApexCharts);
Vue.component("column-two", VueApexCharts);

Vue.use(VueApexCharts);

export default {
  data() {
    return {
      pie_one: {
        series: [],
        chartOptions: {
          chart: {
            width: 615,
            type: "pie",
          },
          colors: ["#70AD47", "#5B9BD5", "#FFC000", "#43682B"],
          legend: {
            show: true,
            position: "right",
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

      pie_two: {
        series: [],
        chartOptions: {
          chart: {
            width: 350,
            type: "pie",
          },
          colors: ["#ED7D31", "#A5A5A5", "#FFC000", "#5B9BD5"],
          legend: {
            show: true,
            position: "bottom",
            horizontalAlign: "center",
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

      pie_three: {
        series: [],
        chartOptions: {
          chart: {
            width: 325,

            type: "pie",
          },
          colors: ["#4472C4", "#ED7D31"],
          legend: {
            show: true,
          },
          legend: {
            position: "bottom",
          },
          labels: [],
          plotOptions: {
            pie: {
              size: 50,
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

      column_one: {
        series: [
          {
            name: "Nilai Pembayaran BC 28",
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
            height: 350,
            type: "line",
            zoom: {
              enabled: false,
            },
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
            type: "datetime",
          },
          fill: {
            colors: ["#ED7D31"],
          },
          colors: ["#ED7D31", "#4472C4"],
        },
      },
      column_two: {
        series: [
          {
            name: "Nilai Pembayaran BC 28",
            type: "column",
            data: [],
          },
        ],
        chartOptions: {
          chart: {
            height: 350,
            type: "line",
          },
          stroke: {
            width: [0, 4],
          },
          dataLabels: {
            enabled: true,
            style: {
              fontSize: "12px",
              colors: ["#fff"],
            },
          },
          labels: [],
          xaxis: {
            type: "date",
          },
          fill: {
            colors: ["#4472C4"],
          },
        },
      },
    };
  },
  created() {
    this.dataOne();
    this.dataTwo();
    this.dataThree();
    this.dataFour();
    this.dataFive();
  },
  methods: {
    //Status Part Consume Install Tahun 2022
    dataOne() {
      const series_one = [];
      const label_one = [];
      axios
        .get("api/dashboard/one")
        .then((response) => {
          response.data.map((item) => {
            series_one.push(item.item);
            label_one.push(item.status_bc_28);
          });
          this.pie_one.series = series_one;
          this.$refs.pie_one.updateOptions({ labels: label_one });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Jumlah Pesawat Yang Ada di Hangar
    dataTwo() {
      const series_two = [];
      const label_two = [];
      axios
        .get("api/dashboard/two")
        .then((response) => {
          response.data.map((item) => {
            series_two.push(item.total);
            label_two.push(item.customer);
          });
          this.pie_two.series = series_two;
          this.$refs.pie_two.updateOptions({ labels: label_two });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Masa Timbun
    dataFour() {
      const series_four = [];
      const label_four = [];
      axios
        .get("api/dashboard/four")
        .then((response) => {
          response.data.map((item) => {
            series_four.push(item.jumlah_bc_16);
            label_four.push(item.status_bc_16);
          });
          this.pie_three.series = series_four;
          this.$refs.pie_three.updateOptions({ labels: label_four });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Status BC 28 Tahun 2022
    dataThree() {
      const series_three_one = [];
      const series_three_two = [];
      const label_three = [];
      axios
        .get("api/dashboard/three")
        .then((response) => {
          response.data.map((item) => {
            series_three_one.push(item.total_bc28);
            series_three_two.push(item.payment_value_bc28);
            label_three.push(item.bulan);
          });
          this.column_one.series[0].data = series_three_two;
          this.column_one.series[1].data = series_three_one;
          this.$refs.column_one.updateOptions({ labels: label_three });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Total QTY
    dataFive() {
      const series_five = [];
      const label_five = [];
      axios
        .get("api/dashboard/five")
        .then((response) => {
          response.data.map((item) => {
            series_five.push(item.quantity);
            label_five.push(item.plant);
          });
          this.column_two.series[0].data = series_five;
          this.$refs.column_two.updateOptions({ labels: label_five });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
