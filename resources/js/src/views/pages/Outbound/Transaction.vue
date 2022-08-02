<template>
<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Outbound Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>                        <li class="breadcrumb-item active">
                            <span>Outbound Transaction​</span>
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
                    <div class="card card-plb">
                        <div class="card-header ui-sortable-handle">
                            <h5 class="card-title card_title_margin">
                                <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                                Outbound Transaction
                            </h5>
                            <div class="card-tools">
                                <button type="button" data-card-widget="collapse" class="btn btn-tool">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- BEGIN: Card Body -->
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center mt-4">
                                <div class="col-md-12 text-center">
                                    <h1> Pilih Kondisi dibawah ini </h1>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 100px;margin-bottom: 100px;">
                                <div class="col-md-4 text-center">
                                    <router-link to=/outbound-transcation-1 class="btn btn-1">1</router-link>
                                    <br>
                                    <br>
                                    <!-- <label>Outbound 1</label><br /> -->
                                    <label>Inventory berkurang dari Sistem</label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <router-link to=/outbound-transcation-2 class="btn btn-2">2</router-link>
                                    <br>
                                    <br>
                                    <!-- <label>Outbound 2</label><br /> -->
                                    <label>Inventory berkurang BC 28 AJU​</label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <router-link to=/outbound-transcation-3 class="btn btn-3">3
                                    </router-link>
                                    <br />
                                    <br />
                                    <!-- <label>Outbound 3</label><br /> -->
                                    <label>Inventory berkurang BC 28 Daftar</label>
                                </div>
                            </div>
                        </div>
                        <!-- END: Card Body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style>
.btn-1 {
    background-color: #f77b00;
    border: none;
    color: white;
    text-align: right;
    text-decoration: none;
    display: inline-block;
    font-size: 80px;
    cursor: pointer;
    padding-right: 45px;
    padding-left: 45px;
    border-radius: 50%;
}

.btn-2 {
    background-color: #f77b00;
    border: none;
    color: white;
    text-align: right;
    text-decoration: none;
    display: inline-block;
    font-size: 80px;
    cursor: pointer;
    padding-right: 45px;
    padding-left: 45px;
    border-radius: 50%;
}

.btn-3 {
    background-color: #f77b00;
    border: none;
    color: white;
    text-align: right;
    text-decoration: none;
    display: inline-block;
    font-size: 80px;
    cursor: pointer;
    padding-right: 45px;
    padding-left: 45px;
    border-radius: 50%;
}
</style>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
  margin-top: -1px;
}
</style>
