<template>
    <v-layout row wrap>
        <v-flex xs12>
            <h2 class="mb-2">{{ project.title }}</h2>

            <p>{{ project.description }}</p>
        </v-flex>

        <sections/>

        <v-flex xs12>
            <v-btn to="/projects">voltar</v-btn>
        </v-flex>

        <show-task/>

    </v-layout>
</template>

<script>
import sections from '../sections/List';
import showTask from '../tasks/Show';

export default {
    computed: {
        project() {
            const id = this.$route.params.id;
            return this.$store.getters['projects/byId'](id);
        }
    },
    components: {
        sections,
        'show-task': showTask
    }
}
</script>
