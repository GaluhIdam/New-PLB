import Vue from "vue";
import VueRouter from "vue-router";

// Routes

import dashboard from "./routes/dashboard";
import pages from "./routes/pages";

Vue.use(VueRouter);

const router = new VueRouter({
	mode: "history",
	linkActiveClass: "active",
	linkExactActiveClass: "exact-active",
	routes: [
		{
			path: "/",
			redirect: {
				name: "dashboard",
			},
		},
		...dashboard,
		...pages,
		{
			path: "*",
			redirect: "error-404",
		},
	],
});

export default router;
