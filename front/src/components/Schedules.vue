<template>
    <v-layout row wrap>
        <v-flex xs12>
            <h2 class="display-1 mb-2">Agenda</h2>
        </v-flex>

        <v-flex xs6>
            <v-date-picker
            v-model="date"
            locale="pt-br"
            landscape
            full-width
            :events="events"
            event-color="green lighten-1"
            color="green lighten-1"></v-date-picker>

            <v-btn dark @click="goToToday()">ir para hoje</v-btn>

            <v-card class="mt-4" v-if="date">
                <v-card-title>
                    <div class="headline">Novo evento</div>
                </v-card-title>
                <v-card-text>
                    <create :date="date"/>
                </v-card-text>
            </v-card>
        </v-flex>
        <v-flex xs6>
            <v-card color="green lighten-5" v-if="date">
                <v-card-title primary-title class="green white--text">
                    <div class="headline">{{ date }}</div>
                </v-card-title>
                <v-card-text>
                    <p>Total de eventos: {{ today.length }}</p>

                    <v-list>
                        <v-list-tile v-for="event, index in today" :key="index">
                            <v-list-tile-content>
                                <v-list-tile-title>{{ event.description }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ event.due_date.substr(11, event.due_date.length) }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card-text>
            </v-card>
        </v-flex>

    </v-layout>
</template>

<script>
import _ from 'underscore';
import create from './schedules/Create';
import { eventHub } from '../eventHub';

export default {
    components: {
        create
    },
    data() {
        return {
            date: null,
            today: []
        }
    },
    computed: {
        events() {
            return this.schedules.map((item) => {
                const date = item.due_date;
                return date.substr(0, 10);
            })
        },
        schedules() {
            return this.$store.state.schedules.all;
        }
    },
    watch: {
        date: function (to, from) {
            this.filterToDate(to);
        }
    },
    methods: {
        goToToday() {
            this.date = null

            setTimeout(() => {
                const date = new Date();
                this.date = date.toISOString().substr(0, 10);
            }, 100);
        },
        filterToDate(to) {
            const events = _.filter(this.schedules, (item) => {
                let date = item.due_date;
                date = date.substr(0, 10);
                return date == to;
            });
            this.today = events;
        }
    },
    mounted() {
        this.$store.dispatch('schedules/getAll');
        eventHub.$on('schedules_created', () => {
            this.filterToDate(this.date);
        });
    }
}
</script>

