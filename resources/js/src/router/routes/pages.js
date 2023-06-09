export default [
  // Error 404
  {
    path: "*",
    name: "error-404",
    component: require("@/views/error/Error404.vue").default,
  },
  //Dokumen Kepabeanan
  {
    path: "/inbound-document",
    name: "inbound-document",
    component: require("@/views/pages/Costums/InboundDocument.vue").default,
  },
  {
    path: "/outbound-document",
    name: "outbound-document",
    component: require("@/views/pages/Costums/OutboundDocument.vue").default,
  },
  // Outbound
  {
    path: "/outbound-transcation",
    name: "outbound-transcation",
    component: require("@/views/pages/Outbound/Transaction.vue").default,
  },
  {
    path: "/outbound-transcation-1",
    name: "outbound-transcation-1",
    component: require("@/views/pages/Outbound/Transaction1.vue").default,
  },
  {
    path: "/outbound-transcation-2",
    name: "outbound-transcation-2",
    component: require("@/views/pages/Outbound/Transaction2.vue").default,
  },
  {
    path: "/outbound-transcation-3",
    name: "outbound-transcation-3",
    component: require("@/views/pages/Outbound/Transaction3.vue").default,
  },
  {
    path: "/summary-outbound",
    name: "summary",
    component: require("@/views/pages/Outbound/Summary.vue").default,
  },
  // Mutasi Pesawat
  {
    path: "/aircraft-mutation",
    name: "aircraft-mutation",
    component: require("@/views/pages/Aircraft/Mutation.vue").default,
  },
  {
    path: "/aircraft-delivery",
    name: "aircraft-delivery",
    component: require("@/views/pages/Aircraft/Delivery.vue").default,
  },
  {
    path: "/aircraft-redelivery",
    name: "aircraft-redelivery",
    component: require("@/views/pages/Aircraft/Redelivery.vue").default,
  },
  // Allotment
  {
    path: "/inventory-allotment",
    name: "inventory-allotment",
    component: require("@/views/pages/Allotment/Inventory.vue").default,
  },
  {
    path: "/movement-allotment",
    name: "movement-allotment",
    component: require("@/views/pages/Allotment/Movement.vue").default,
  },
  // Mutasi
  {
    path: "/report-mutation",
    name: "report-mutation",
    component: require("@/views/pages/Mutation/ReportMutation.vue").default,
    props: true,
  },
  // Scrap
  {
    path: "/scrap",
    name: "scrap",
    component: require("@/views/pages/Scrap/Scrap.vue").default,
  },
  // Masa Timbun
  {
    path: "/hoarding-time",
    name: "hoarding-time",
    component: require("@/views/pages/HoardingTime/HoardingTime.vue").default,
  },
  // User Management
  {
    path: "/users-list",
    name: "users-list",
    component: require("@/views/pages/UserManagement/UsersList.vue").default,
    props: true,
  },
  {
    path: "/developer",
    name: "developer",
    component: require("@/views/pages/Developer.vue").default,
  },
  // Log
  {
    path: "/login-history",
    name: "login-history",
    component: require("@/views/pages/Log/LoginHistory.vue").default,
    props: true,
  },
  {
    path: "/activity-history",
    name: "activity-history",
    component: require("@/views/pages/Log/ActivityHistory.vue").default,
  },
  // Upload
  {
    path: "/upload-mutation",
    name: "upload-mutation",
    component: require("@/views/pages/Uploads/Mutation.vue").default,
  }
];