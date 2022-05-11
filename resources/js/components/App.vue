<template>
  <div>
    <div class="menu">
      <ul>
        <li>
          <router-link :to="{ name: 'delivery' }">Delivery</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'redelivery' }">Redelivery</router-link>
        </li>
      </ul>
    </div>
    <div class="content">
      <router-view></router-view>
    </div>
  </div>
</template>