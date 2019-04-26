<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn color="success" block @click="dialog = true" v-on="on">Créer un channel</v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Création d'un channel</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 >
                            <v-text-field label="Nom du channel" v-model="name" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="clear(); dialog = false">Fermer</v-btn>
                <v-btn color="blue darken-1" flat @click="add()">Ajouter</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "RoomDialog",
        data(){
            return{
                dialog : false,
                name : '',
            }
        },
        methods:{
            add(){
                if(this.name.trim() !== ''){
                    this.$store.dispatch('addRoom', this.name).then(room=>{
                        this.$noty.success('Le channel à été créé');
                        this.clear();
                        this.dialog = false;
                        this.$router.push({name: 'room', params: { id: room.id }})
                    }).catch(e => {
                        this.$noty.error('Oups');
                    })
                } else {
                    this.$noty.error('Le nom ne peut pas être vide');
                }
            },
            clear(){
                this.name = ''
            }
        }
    }
</script>

<style scoped>

</style>