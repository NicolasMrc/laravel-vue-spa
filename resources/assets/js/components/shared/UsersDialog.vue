<template>
    <v-dialog v-model="dialog" max-width="600px">
        <template v-slot:activator="{ on }">
            <span class="grey--text button-users" @click="dialog = true" v-on="on"><i class="fa fa-users"></i> {{users.length}}</span>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Membres du channel</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 >
                            <v-chip v-for="user in users" :key="user.email">
                                <v-avatar class="green white--text">{{user.name.charAt(0)}}</v-avatar>
                                {{user.name}}
                            </v-chip>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="dialog = false">Fermer</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "usersDialog",
        props  : ['users'],
        data(){
            return{
                dialog : false,
            }
        },
    }
</script>

<style scoped>
    .button-users{
        cursor: pointer;
    }
</style>
