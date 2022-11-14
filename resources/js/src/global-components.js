import Vue from "vue";

Vue.component(
  "passport-clients",
  require("@/views/pages/Passport/Clients.vue").default
);
Vue.component(
  "passport-authorized-clients",
  require("@/views/pages/Passport/AuthorizedClients.vue").default
);
Vue.component(
  "passport-personal-access-tokens",
  require("@/views/pages/Passport/PersonalAccessTokens.vue").default
);
Vue.component("not-found", require("@/views/error/Error404.vue").default);

// Gate
import Gate from "./gate";
Vue.prototype.$gate = new Gate(window.user);

let Fire = new Vue();
window.Fire = Fire;

// vfrom
import {
  Button,
  HasError,
  AlertError,
  AlertErrors,
  AlertSuccess,
} from "vform/src/components/bootstrap4";
Vue.component(Button.name, Button);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
// Vue-GoodTable
import VueGoodTablePlugin from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
Vue.use(VueGoodTablePlugin);

// Vue-Multiselect
import Multiselect from "vue-multiselect";
Vue.component("multiselect", Multiselect);
import "vue-multiselect/dist/vue-multiselect.min.css";

// Vue-Moment
import moment from "moment";
// Filter Moment
Vue.filter("myDate", function (value) {
  if (value == null) {
    return "-";
  } else {
    return moment(String(value)).format("DD MMMM YYYY");
  }
});
Vue.filter("invalidDate", function (value) {
  if (value == null) {
    return "-";
  } else {
    return moment(String(value)).format("DD MMMM YYYY");
  }
});

Vue.filter("myDateTime", function (value) {
  if (value == null) {
    return "-";
  } else if (value == "0000-00-00 00:00:00") {
    return "-";
  } else {
    return moment(String(value)).format("DD MMMM YYYY HH:mm:ss");
  }
});

Vue.filter("upperCase", function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("uangIDR", function (value) {
  return Number(value) > 0 ?
    "Rp " + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1.") :
    "-";
});

Vue.filter("uangUSD", function (value) {
  return Number(value) > 0 ?
    "$" + value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") :
    "-";
});

Vue.filter("formatNumber", function (value) {
  return Number(value) > 0 ?
    value.toLocaleString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") :
    "-";
});


// Condition when value is null
Vue.filter("defaultFilter", function (value) {
  return value == null ? "-" : value;
});

// Vue-Progressbar
import VueProgressBar from "vue-progressbar";
const options = {
  color: "#2A3F54",
  failedColor: "#red",
  thickness: "2px",
  transition: {
    opacity: "0.6s",
    termination: 300,
  },
  autoRevert: true,
  position: "fixed",
  inverse: false,
};
Vue.use(VueProgressBar, options);

// SweetAlert2
import swal from "sweetalert2";
window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
});
window.toast = toast;

// Datepicker
import Datepicker from "vuejs-datepicker";
Vue.component("datepicker", Datepicker);

// ApexChart
import VueApexCharts from "vue-apexcharts";
Vue.component("pie-one", VueApexCharts);
Vue.component("pie-two", VueApexCharts);
Vue.component("pie-three", VueApexCharts);
Vue.component("column-one", VueApexCharts);
Vue.component("column-two", VueApexCharts);