<template>
    <v-layout row wrap>
        <v-flex xs12>
            <h2 class="display-1 mb-4">Projetos</h2>
        </v-flex>

        <v-container grid-list-md>
            <router-view></router-view>
        </v-container>

    </v-layout>
</template>

<script>
export default {
    data() {
        return {
            mensagem: 'Olá Erik'
        }
    },
    mounted() {
        this.$store.dispatch('projects/getAll');
    }
}
</script>

<style>
    .red {
        background-color: red;
        color: white;
    }
</style>

