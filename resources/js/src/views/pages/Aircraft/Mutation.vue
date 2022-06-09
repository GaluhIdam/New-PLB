<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Aircraft Mutation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'dashboard' }"
                                    >Dashboard</router-link
                                >
                            </li>
                            <li class="breadcrumb-item active">
                                <span>Aircraft Mutation</span>
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
                            <div class="card-body">
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
                                            :to="{ name: 'aircraft-delivery' }"
                                            class="btn btn-primary btn-md"
                                            role="button"
                                            ><i class="fa-solid fa-plus"></i>
                                            New Delivery</router-link
                                        >
                                    </div>
                                </div>
                                <br />
                                <div class="table-responsive">
                                    <table class="table
                                            table-bordered
                                            table-striped
                                            dataTable
                                            dtr-inline">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%;" class="text-center">No.</th>
                                                <th>A/C Reg</th>
                                                <th>Operator</th>
                                                <th>A/C Type</th>
                                                <th class="text-center">Date In</th>
                                                <th class="text-center">Date Out</th>
                                                <th class="text-center">RKSP</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr
                                                v-for="(
                                                    mutation, mutation_index
                                                ) in mutations.data"
                                                :key="mutation_index"
                                            >
                                                <td class="text-center">
                                                    {{
                                                        mutations.from +
                                                        mutation_index
                                                    }}
                                                </td>
                                                <td>{{ mutation.reg }}</td>
                                                <td>{{ mutation.operator }}</td>
                                                <td>{{ mutation.type }}</td>
                                                <td class="text-center">{{ mutation.date_in }}</td>
                                                <td class="text-center">{{ mutation.date_out }}</td>
                                                <td class="text-center">
                                                    <a
                                                        v-if="
                                                            mutation.rksp !=
                                                            null
                                                        "
                                                        :href="`/storage/${mutation.rksp}`"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        RKSP
                                                    </a>
                                                </td>
                                                <td>
                                                    <span
                                                        v-if="mutation.date_out"
                                                        >Keluar PLB GMF​</span
                                                    >
                                                    <span v-else
                                                        >DI dalam PLB GMF​</span
                                                    >
                                                </td>
                                                <td class="text-center">
                                                    <ul class="list-inline m-0">
                                                        <!-- <li class="list-inline-item"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class=" fa-solid fa-pencil"></i></button>
                                                        </li> -->
                                                        <li
                                                            class="
                                                                list-inline-item
                                                            "
                                                        >
                                                            <button
                                                                class="
                                                                    btn
                                                                    btn-warning
                                                                    btn-sm
                                                                    rounded-0
                                                                "
                                                                type="button"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Delete"
                                                                @click="
                                                                    deleteData(
                                                                        mutation.id
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="
                                                                        fa-solid
                                                                        fa-trash
                                                                    "
                                                                ></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr
                                                v-if="mutations.data.length < 1"
                                            >
                                                <td
                                                    colspan="9"
                                                    class="text-center"
                                                >
                                                    Data not found
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div
                                        class="mt-4 d-flex justify-content-end"
                                    >
                                        <nav>
                                            <ul class="pagination">
                                                <li
                                                    v-for="(
                                                        link, index
                                                    ) in mutations.links"
                                                    :key="index"
                                                    class="page-item"
                                                    :class="{
                                                        disabled: !link.url,
                                                        active: link.active,
                                                    }"
                                                >
                                                    <a
                                                        href="javascript:void(0)"
                                                        @click="list(link.url)"
                                                        class="page-link"
                                                    >
                                                        <span
                                                            v-if="
                                                                link.label ==
                                                                '&laquo; Previous'
                                                            "
                                                        >
                                                            Previous
                                                        </span>
                                                        <span
                                                            v-else-if="
                                                                link.label ==
                                                                'Next &raquo;'
                                                            "
                                                        >
                                                            Next
                                                        </span>
                                                        <span v-else>
                                                            {{ link.label }}
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
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
import axios from "axios";
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
    // created() {
    //     this.list();
    // },
    // watch: {
    //     search: debounce(function () {
    //         this.list();
    //     }, 300),
    // },
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