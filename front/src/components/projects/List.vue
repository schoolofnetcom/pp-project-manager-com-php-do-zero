<template>
    <v-layout row wrap>
        <v-flex xs3 v-for="project in projects" :key="project.id">
            <v-card color="blue-grey darken-2" class="white--text">
                <v-card-title primary-title>
                    <div class="headline">{{ project.title }}</div>
                </v-card-title>
                <v-card-text>
                    {{ project.description }}
                </v-card-text>
                <v-card-actions>
                    <v-btn flat dark :to="'/projects/' + project.id">Ver +</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>

        <v-flex xs3>
            <projects-create></projects-create>
        </v-flex>
    </v-layout>
</template>

<script>
import ProjectCreate from './Create';

export default {
    computed: {
        projects() {
            return this.$store.state.projects.all;
        }
    },
    components: {
        'projects-create': ProjectCreate
    }
}
</script>

