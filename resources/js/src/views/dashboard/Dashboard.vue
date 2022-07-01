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
          <!-- START: Report Inbound -->
          <!-- DASHBOARD one -->
          <div class="col">
            <dashboard-one
              type="pie"
              :options="pie_one.chartOptions"
              :series="pie_one.series"
            ></dashboard-one>
          </div>
          <!-- DASHBOARD one -->
          <!-- DASHBOARD two -->
          <div class="col">
            <dashboard-two
              type="pie"
              :options="pie_two.chartOptions"
              :series="pie_two.series"
            ></dashboard-two>
          </div>
          <!-- DASHBOARD two -->
        </div>
        <div class="row">
          <!-- START: Report Inbound -->
          <!-- DASHBOARD three -->
          <div class="col">
            <dashboard-three
              type="line"
              height="350"
              :options="column_one.chartOptions"
              :series="column_one.series"
            ></dashboard-three>
          </div>
          <!-- DASHBOARD three -->
          <!-- DASHBOARD four -->
          <div class="col"></div>
          <!-- DASHBOARD four -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import axios from "axios";

Vue.component("dashboard-one", VueApexCharts);
Vue.component("dashboard-two", VueApexCharts);
Vue.component("dashboard-three", VueApexCharts);

Vue.use(VueApexCharts);

export default {
  data() {
    return {
      pie_one: {
        series: [],
        chartOptions: {
          chart: {
            width: "100%",
            type: "pie",
          },
          title: {
            text: "Status Part Consume Install Tahun 2022",
          },
          // labels: ["a", "b", "c", "d"],
          labels: [],
          theme: {
            palette: "palette4", // upto palette10
          },
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
            width: "100%",
            type: "pie",
          },
          title: {
            text: "Jumlah Pesawat yang ada di Hangar PT GMF Aeroasia",
          },
          labels: ["a", "b", "c", "d"],
          // labels: [],
          theme: {
            palette: "palette6", // upto palette10
          },
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
      column_one: {
        series: [
          {
            name: "Website Blog",
            type: "column",
            data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160],
          },
          {
            name: "Social Media",
            type: "line",
            data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16],
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
          title: {
            text: "Traffic Sources",
          },
          dataLabels: {
            enabled: true,
            enabledOnSeries: [1],
          },
          labels: [],
          xaxis: {
            type: "datetime",
          },
          yaxis: [
            {
              title: {
                text: "Website Blog",
              },
            },
            {
              opposite: true,
              title: {
                text: "Social Media",
              },
            },
          ],
        },
      },
    };
  },
  created() {
    this.dataOne();
    this.dataTwo();
  },
  methods: {
    //Pie One
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
          console.log(series_one);
          console.log(label_one);
          this.pie_one.series = series_one;
          this.pie_one.chartOptions.labels = label_one;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Pie Two
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
          console.log(series_two);
          console.log(label_two);
          this.pie_two.series = series_two;
          // this.pie_two.chartOptions.labels = label_two;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //Column trhee
    dataThree() {
      const series_three = [];
      const label_three = [];
      axios
        .get("api/dashboard/three")
        .then((response) => {
          response.data.map((item) => {
            series_three.push(item.total_bc28);
            label_three.push(item.payment_value_bc28);
          });
          console.log(series_three);
          console.log(label_three);
          // this.pie_two.series = series_three;
          // this.pie_two.chartOptions.labels = label_three;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
