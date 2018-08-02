<template>
    <v-layout id="sections-container" row>
        <v-flex xs3 v-for="section in sections" :key="section.id">
            <v-card color="blue-grey lighten-5">
                <v-card-title primary-title class="blue-grey white--text">
                    <div class="headline">{{ section.title }}</div>
                </v-card-title>
                <v-card-text>
                    {{ section.description }}
                </v-card-text>
                <v-card-text>
                    <tasks :section="section.id"/>
                </v-card-text>
                <v-card-text>
                    <create-task :section="section.id"/>
                </v-card-text>
            </v-card>
        </v-flex>
        <v-flex xs3>
            <create/>
        </v-flex>
    </v-layout>
</template>

<script>
import create from './Create';
import tasks from '../tasks/List';
import tasksCreate from '../tasks/Create';

export default {
    computed: {
        sections() {
            return this.$store.state.sections.all;
        }
    },
    components: {
        create,
        tasks,
        'create-task': tasksCreate
    },
    mounted() {
        this.$store.dispatch('sections/getAll', this.$route.params.id);
    }
}
</script>

