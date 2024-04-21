<template>
  <div id="app">
    <nav class="flex flex-wrap items-center justify-between px-4 py-2 bg-gray-800" role="navigation"
      aria-label="main navigation">
      <div class="flex items-center">
        <div class="w-fit justify-items-start">
          <img src="../../assets/image.png" class="h-10" alt="TradeUp Logo" />
        </div>
        <router-link to="/" class="block px-4 py-2">
          <span class=" text-white hover:text-orange-300"> Home</span>
        </router-link>
        <router-link to="/postalCode" class="block px-4 py-2">
          <span class=" text-white hover:text-orange-300"> Buscador de CEP </span>
        </router-link>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<style scoped>
#app {
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 8.5px;
  background: #2c3e50;
}

nav a {
  font-weight: bold;
  color: #fff;
}

nav a.router-link-exact-active {
  color: #42b983;
}

.navbar-item {
  color: #ff5500;
  font-weight: 600;
}
</style>