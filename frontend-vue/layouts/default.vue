<template>
  <div>
    <header>
      <div v-bind:class="{ 'hidden': isMobile }" class="pinkBox"></div>
    </header>
    <slot />
  </div>
</template>

<script>
export default {
  data() {
    return {
      isMobile: false
    }
  },
  mounted() {
    this.checkIfMobile();
    window.addEventListener('resize', this.checkIfMobile);
  },
  beforeDestroy(){
    window.removeEventListener('resize', this.checkIfMobile);
  },
  methods: {
    checkIfMobile() {
      this.isMobile = window.innerWidth <= 700;
    }
  }
}
</script>

<style></style>
