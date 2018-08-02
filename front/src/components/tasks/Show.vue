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
                <v-toolbar-title>{{ task.title }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <p v-if="task.description">{{ task.description }}</p>
                <p v-if="task.due_date">{{ task.due_date }}</p>
                <p>{{ task.done == 1 ? 'tarefa finalizada' : 'tarefa pendente' }}</p>

                <v-list three-line>
                    <v-subheader>Checklist</v-subheader>
                    <v-divider></v-divider>
                    <div v-for="subtask in subtasks" :key="subtask.id">
                        <v-list-tile @click="checked(subtask)">
                            <v-list-tile-action>
                                <v-icon v-if="subtask.done == 1" color="green">done</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ subtask.title }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-divider></v-divider>
                    </div>

                    <v-list-tile>
                        <v-form v-model="valid" @submit.prevent ref="form">
                            <v-text-field
                                label="Novo item"
                                v-model="data.title"
                                :rules="validation.title"
                                required
                                @keyup.native.enter="submit()"
                            ></v-text-field>
                        </v-form>
                    </v-list-tile>
                </v-list>

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
            task: {},
            data: {},
            valid: false,
            validation: {
                title: [
                    v => !!v || "Título é obrigatório"
                ]
            }
        }
    },
    computed: {
        subtasks() {
            return this.$store.state.subtasks.all;
        }
    },
    methods: {
        submit() {
            this.data.task_id = this.task.id;
            this.$store.dispatch('subtasks/create', this.data).then(() => {
                this.$refs.form.reset();
            });
        },
        checked(subtask) {
            this.$store.dispatch('subtasks/checked', subtask);
        }
    },
    created() {
        eventHub.$on('open-task', (task) => {
            this.dialog = true;
            this.task = task;
            this.$store.dispatch('subtasks/getAll', this.task.id);
        });
    }
}
</script>
