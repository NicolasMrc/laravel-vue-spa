<template>
    <div>
        <v-layout row wrap>
            <v-flex xs12>
                <v-alert :value="true" color="info" icon="info" outline v-if="userRooms.length === 0">
                    <span>Vous n'avez pas encore souscrit a un channel. Vous pouvez rejoindre un channel ou en créer un a tout moment.</span>
                </v-alert>
            </v-flex>
            <v-flex xs12>
                <v-card>
                    <v-card-title primary-title>
                        <v-layout row wrap>
                            <v-flex xs6>
                                <h3 class="headline mb-0">{{featured ? 'Featured Channels' : 'Tout les Channels'}}</h3>
                            </v-flex>
                            <v-flex xs6 text-xs-right>
                                <span class="grey--text font-italic"> todo search</span>
                            </v-flex>
                            <v-flex xs12>
                                <hr class="mb-1 mt-3">
                            </v-flex>
                            <v-flex xs12 v-for="(room, index) in rooms" :key="room.name" v-if="featured ? index <= 3 : index > -1">
                                <v-layout row wrap>
                                    <v-flex xs6>
                                        <p class="pt-3"><span class="font-weight-light grey--text"><i class="fa fa-users"></i>{{room.users.length}} </span>  {{room.name}} </p>
                                    </v-flex>
                                    <v-flex xs6 class="text-xs-right">
                                        <v-btn v-if="!hasSubscription(room)" color="success" @click="join(room)">Rejoindre</v-btn>
                                        <v-btn v-else flat color="warning" @click="leave(room)">Quitter</v-btn>
                                    </v-flex>
                                    <v-flex xs12>
                                        <hr class="my-1">
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex xs12 class="text-xs-center">
                                <v-btn v-if="featured" color="info" @click="featured = false">Voir tout</v-btn>
                                <v-btn v-else color="info" @click="featured = true">Voir moins</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-card-title>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import RoomsDrawer from "../shared/RoomsDrawer";
    export default {
        components: {RoomsDrawer},
        data() {
            return {
                featured : true
            }
        },
        methods: {
            join(room){
                this.$store.dispatch('subscribe', room.id).then(() => {
                    this.$noty.success('Vous avez rejoinds le channel ' + room.name);
                }).catch(() => {
                    this.$noty.error('Oups');
                })
            },
            hasSubscription(room){
                return this.userRooms.filter(r => r.id === room.id).length > 0
            },
            leave(room){
                this.$store.dispatch('unsubscribe', room.id).then(() => {
                    this.$noty.success('Vous avez quitté le channel ' + room.name);
                }).catch(() => {
                    this.$noty.error('Oups');
                })
            }
        },
        computed: {
            rooms(){
                return this.$store.getters.getRooms || []
            },
            userRooms(){
                return this.$store.getters.getUserRooms || []
            }
        },
        created(){
            this.$store.dispatch('fetchRooms').then()
            this.$store.dispatch('fetchSubscriptions').then()
        }
    }
</script>
