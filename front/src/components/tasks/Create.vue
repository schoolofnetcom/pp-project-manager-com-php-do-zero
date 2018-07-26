<template>
    <v-form v-model="valid" ref="form">
        <v-text-field
            v-model="data.title"
            label="Nova tarefa"
            :rules="validation.title"
            required
            @keyup.native.enter="submit()"
        ></v-text-field>
    </v-form>
</template>

<script>
export default {
    data() {
        return {
            data: {},
            valid: false,
            validation: {
                title: [
                    v => !!v || 'Título é obrigatório'
                ]
            }
        }
    },
    methods: {
        submit() {
            console.log(this.data)
        }
    }
}
</script>

