<template>
    <v-layout row wrap>
        <v-flex xs3 v-for="n in 2" :key="n">
            <v-card color="blue-grey darken-2" class="white--text">
                <v-card-title primary-title>
                    <div class="headline">App Mobile SON</div>
                </v-card-title>
                <v-card-text>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et erat ac lectus auctor mollis quis vitae ligula. Suspendisse interdum tincidunt leo, id ultricies libero rutrum at.
                </v-card-text>
                <v-card-actions>
                    <v-btn flat dark>Ver +</v-btn>
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
    components: {
        'projects-create': ProjectCreate
    }
}
</script>

