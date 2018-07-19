<template>
    <v-card color="blue-grey lighten-4">
        <v-card-title>
            <div class="headline">Adicionar projeto</div>
        </v-card-title>
        <v-container>
            <v-form ref="form" v-model="valid" xs12>
                <v-text-field
                    id="project-title"
                    v-model="data.title"
                    :rules="validation.title"
                    label="Título"
                    required
                ></v-text-field>

                <div v-show="data.title">
                    <v-btn flat>Salvar</v-btn>
                </div>

            </v-form>
        </v-container>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            data: {},
            validation: {
                title: [
                    v => !!v || 'Título é obrigatório'
                ]
            }
        }
    }
}
</script>
