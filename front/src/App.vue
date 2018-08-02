<template>
  <div>
    <dtemplate v-if="isLogged"/>
    <login v-if="!isLogged"/>
  </div>
</template>

<script>
import dtemplate from './templates/default';
import login from './templates/login';

export default {
  components: {
    login,
    dtemplate
  },
  computed: {
    isLogged() {
      return this.$store.state.auth.isLogged;
    }
  }
}
</script>
