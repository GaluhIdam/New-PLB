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

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- START: Report Inbound -->
          <div class="col-lg-6">
            <div class="medium-box bg-white">
              <div id="chartSatu"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="medium-box bg-white">
              <div id="chartDua"></div>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
          <!-- START: Report Inbound -->
          <div class="col-lg-6">
            <div class="medium-box bg-white">
              <div id="pieSatu"></div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <!-- START: Report Inbound -->
          <div class="col-lg-6">
            <div class="medium-box bg-white">
              <div id="bar"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="medium-box bg-white">
              <div id="pieDua"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ApexCharts from "apexcharts";
function cartSatu() {
  var options = {
    series: [
      {
        name: "Data Satu",
        type: "column",
        data: [587, 778, 6687],
      },
      {
        name: "Data Dua",
        type: "line",
        data: [null, 1268, 5214],
      },
    ],
    chart: {
      height: 350,
      type: "line",
    },
    stroke: {
      width: [0, 4],
    },
    title: {
      text: "Status Part Consume Install Periode",
    },
    dataLabels: {
      enabled: true,
      enabledOnSeries: [1],
    },
    labels: ["Outbound Satu", "Outbound Dua", "Outbound Tiga"],
    xaxis: {
      type: "text",
    },
    yaxis: [
      {
        title: {
          text: "Hasil Satu",
        },
      },
      {
        opposite: true,
        title: {
          text: "Hasil Dua",
        },
      },
    ],
  };
  var chart = new ApexCharts(document.querySelector("#chartSatu"), options);
  chart.render();
}
function cartDua() {
  var options = {
    colors: ["#FF5733", "#DBFF33"],
    series: [
      {
        name: "Data Satu",
        type: "column",
        data: [587, 778, 6687],
      },
      {
        name: "Data Dua",
        type: "line",
        data: [300, 1268, 5214],
      },
    ],
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
    labels: ["Januari", "Februari", "Maret"],
    xaxis: {
      type: "text",
    },
    yaxis: [
      {
        title: {
          text: "Hasil Satu",
        },
      },
      {
        opposite: true,
        title: {
          text: "Hasil Dua",
        },
      },
    ],
  };

  var chart = new ApexCharts(document.querySelector("#chartDua"), options);
  chart.render();
}

function pieSatu() {
  var options = {
    series: [96, 4],

    chart: {
      width: 380,
      type: "pie",
    },
    title: {
      text: "Status Masa Timbun BC 16",
    },
    labels: ["BC 16 < 3 Tahun", "BC 16 > 3 Tahun"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
          legend: {
            position: "bottom",
          },
        },
      },
    ],
  };

  var chart = new ApexCharts(document.querySelector("#pieSatu"), options);
  chart.render();
}
function pieDua() {
  var options = {
    series: [2, 10, 4, 2, 2],

    chart: {
      width: 380,
      type: "pie",
    },
    title: {
      text: "Pesawat yang ada di Hangar PT GMF AeroAsia",
    },
    labels: ["Customer", "Garuda", "Citilink", "Indigo", "KLM"],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
          legend: {
            position: "bottom",
          },
        },
      },
    ],
  };

  var chart = new ApexCharts(document.querySelector("#pieDua"), options);
  chart.render();
}

function bar() {
  var options = {
    title: {
      text: "Total QTY OSA Allotment",
    },
    chart: {
      type: "bar",
    },
    series: [
      {
        name: "sales",
        data: [305, 1054, 768, 844, 945, 658],
      },
    ],
    xaxis: {
      categories: ["BPN", "CGK", "DPS", "KNO", "SUB", "UPG"],
    },
  };

  var chart = new ApexCharts(document.querySelector("#bar"), options);

  chart.render();
}
export default {
  mounted() {
    cartSatu();
    cartDua();
    pieSatu();
    pieDua();
    bar();
  },
};
</script>
