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
        <div class="row mb-5 mt-5 d-flex justify-content-center">
          <!-- Pie three -->
          <div class="col-md-6 mt-4">
            <pie-three
              type="pie"
              ref="pie_three"
              :options="pie_three.chartOptions"
              :series="pie_three.series"
            ></pie-three>
          </div>
          <!-- Pie three -->
          <!-- Pie two -->
          <div class="col-md-6 mt-4">
            <pie-two
              type="pie"
              ref="pie_two"
              :options="pie_two.chartOptions"
              :series="pie_two.series"
            ></pie-two>
          </div>
          <!-- Pie two -->
        </div>
        <div class="row mt-5 mb-5 d-flex justify-content-center">
          <!-- Column One -->
          <div class="col-md-6 mt-4">
            <column-two
              type="bar"
              ref="column_two"
              :options="column_two.chartOptions"
              :series="column_two.series"
            ></column-two>
          </div>
          <!-- Column One -->
          <!-- Column Two -->
          <div class="col-md-6 mt-4">
            <column-one
              type="line"
              ref="column_one"
              :options="column_one.chartOptions"
              :series="column_one.series"
            ></column-one>
          </div>
          <!-- Column Two -->
          <!-- Pie one -->
          <div class="col-md-6 mt-4">
            <pie-one
              type="pie"
              ref="pie_one"
              :options="pie_one.chartOptions"
              :series="pie_one.series"
            ></pie-one>
          </div>
          <!-- Pie one -->
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
            type: "pie",
          },
          legend: {
            show: true,
          },
          legend: {
            position: "bottom",
          },
          title: {
            text: "Status Part Consume Install Tahun 2022",
          },
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
            type: "pie",
          },
          legend: {
            show: true,
          },
          legend: {
            position: "bottom",
          },
          title: {
            text: "Jumlah Pesawat yang ada di Hangar PT GMF Aeroasia",
          },
          labels: [],
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

      pie_three: {
        series: [],
        chartOptions: {
          chart: {
            type: "pie",
          },
          legend: {
            show: true,
          },
          legend: {
            position: "bottom",
          },
          title: {
            text: "Status Masa Timbun",
          },
          labels: [],
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
          },
          stroke: {
            width: [0, 4],
          },
          title: {
            text: "Status BC 28 Tahun 2022",
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
                text: "Nilai Pembayaran BC 28",
              },
            },
            {
              opposite: true,
              title: {
                text: "Jumlah BC",
              },
            },
          ],
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
          title: {
            text: "Total Quantity",
          },
          dataLabels: {
            enabled: true,

            offsetY: -20,
            style: {
              fontSize: "12px",
              colors: ["#304758"],
            },
          },
          labels: [],
          xaxis: {
            type: "date",
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
