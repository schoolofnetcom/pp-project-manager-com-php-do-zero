<template>
    <v-list three-line subheader>
        <v-subheader>Tarefas</v-subheader>
        <v-divider></v-divider>

        <div v-for="n in 3">
            <v-list-tile @click="open(n)">
                <v-list-tile-content>
                    <v-list-tile-title>Título</v-list-tile-title>
                    <v-list-tile-sub-title>sub-titulo</v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-divider></v-divider>
        </div>

    </v-list>
</template>

<script>
import { eventHub } from '../../eventHub';

export default {
    methods: {
        open(n) {
            eventHub.$emit('open-task', n);
        }
    }
}
</script>

