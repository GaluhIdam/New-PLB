<template>
    <div class="jumbotron">
        <h1 class="display-4">Dashboard - PLB</h1>
        <p class="lead">Halaman Dashboard PLB </p>
        <hr class="my-4">
        <router-link :to="{ name: 'delivery' }" class="btn btn-primary btn-lg" role="button">Delivery</router-link>
        <router-link :to="{ name: 'redelivery' }" class="btn btn-secondary btn-lg" role="button">Redelivery</router-link>
    </div>
</template>

<script>
    export default {


    }
</script>
