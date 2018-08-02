<template>
    <v-form v-model="valid" ref="form">
        <v-text-field
            label="Descrição da tarefa"
            v-model="data.description"
            :rules="validation.description"
            required
        ></v-text-field>
        <v-menu
            ref="menuTime"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="due_date_time"
        >
            <v-text-field
                slot="activator"
                v-model="due_date_time"
                label="Hora da entrega"
                readonly
            ></v-text-field>
            <v-time-picker
                v-model="due_date_time"
            >
                <v-btn flat color="secondary" @click="menu = false">Cancelar</v-btn>
                <v-btn flat color="primary" @click="$refs.menuTime.save(due_date_time)">Ok</v-btn>
            </v-time-picker>
        </v-menu>
        <v-btn
            :disabled="!valid"
            @click="submit()"
            >Salvar</v-btn>
    </v-form>
</template>

<script>
import { eventHub } from '../../eventHub';

export default {
    props: [
        'date'
    ],
    data() {
        return {
            menu: false,
            valid: false,
            data: {},
            due_date_time: null,
            validation: {
                description: [
                    v => !!v || 'Título é obrigatório'
                ]
            }
        }
    },
    methods: {
        submit() {
            this.data.due_date = this.date + ' ' + this.due_date_time + ':00';
            this.$store.dispatch('schedules/create', this.data).then(() => {
                this.$refs.form.reset();
                this.due_date_time = null;
                eventHub.$emit('schedules_created');
            })
        }
    }
}
</script>

