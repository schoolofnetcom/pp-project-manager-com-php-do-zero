<template>
    <v-dialog
        v-model="dialog"
        fullscreen
        scrollable
    >
        <v-card>
            <v-toolbar card dark color="primary">
                <v-btn icon dark @click.native="dialog = false">
                    <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Tarefa {{ n }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <h3>Hello world</h3>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import { eventHub } from '../../eventHub';

export default {
    data() {
        return {
            dialog: false,
            n: 0
        }
    },
    created() {
        eventHub.$on('open-task', (n) => {
            this.dialog = true;
            this.n = n;
        });
    }
}
</script>
