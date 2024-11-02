<template>
  <div class="container-fluid pt-3">
    <div class="vld-parent">
      <loading :active.sync="isLoading" 
      :can-cancel="true"
      :is-full-page="fullPage"></loading>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{name: 'admin.principal'}">Menú Principal</router-link>
        </li>
      </ol>
    </nav>
  	<img src="/archivos/imagenes/404.jpg" class="d-block m-auto">
  </div>
</template>