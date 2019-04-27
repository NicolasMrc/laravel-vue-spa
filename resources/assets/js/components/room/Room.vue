<template>
    <div class="h-100">
        <v-layout align-space-between justify-space-between column fill-height>
            <v-flex xs12 v-if="!loading && room !== null">
                <v-layout row wrap>
                    <v-flex xs4>
                        <users-dialog :users="room.users"/>
                    </v-flex>
                    <v-flex xs4 text-xs-center>
                        <span class="grey--text room-name">{{room.name}}</span>
                    </v-flex>
                    <v-flex xs4 text-xs-right>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <i @click="leave()" class="leave-btn fa fa-lg fa-sign-out-alt" v-on="on"></i>
                            </template>
                            <span>Quitter le channel</span>
                        </v-tooltip>
                    </v-flex>
                    <v-flex xs12>
                        <hr>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex xs12 grow class="scroll-y" id="container">
                <div v-if="!loading && room !== null">
                    <div v-if="room.messages.length > 0" class="scroll-y overflow-x-hidden" >
                        <v-layout row wrap class="overflow-hidden" >
                            <v-flex xs12 v-for="(message, index) in room.messages" :key="message.id" :class="message.user.email === userEmail ? 'text-xs-right' : 'text-xs-left'" class="msg">
                                <message :id="index === room.messages.length - 1 ? 'last-message' : ''" :message="message" :isAuthor="message.user.email === userEmail"/>
                            </v-flex>
                        </v-layout>
                    </div>
                    <div v-else>
                        <span class="grey--text font-italic">Aucun message pour le moment</span>
                    </div>
                </div>
                <div class="text-xs-center" v-else >
                    <v-progress-circular indeterminate color="primary"></v-progress-circular>
                </div>
            </v-flex>
            <v-flex xs12 class="justify-self-end">
                <v-layout justify-center row>
                    <v-flex xs11>
                        <v-text-field
                                v-model="newMessage"
                                box
                                clear-icon="mdi-close-circle"
                                clearable
                                label="Message"
                                type="text"
                                @keydown.enter="sendMessage"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs1 text-xs-center>
                        <i class="fa fa-paper-plane fa-2x" @click="sendMessage"></i>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import Message from "../message/Message";
    import UsersDialog from "../shared/UsersDialog";

    export default {
        name:'room',
        components: {UsersDialog, Message},
        data() {
            return {
                newMessage : '',
                loading : true,
                sync : true,
            }
        },
        methods: {
            leave(){
                let name = this.room.name
                this.$store.dispatch('unsubscribe', this.room.id).then(() => {
                    this.$router.push({name: 'index'});
                    this.$noty.success('Vous avez quitté le channel ' + name);
                }).catch(e => {
                    this.$noty.error('Oups');
                    console.log(e)
                })
            },
            scroll(){
                if($('#last-message') !== null && $('#last-message').length > 0){
                    this.$scrollTo('#last-message', 1000, { container: '#container',easing: 'ease', cancelable: false })
                }
            },
            sendMessage(){
                if(this.newMessage.trim() !== ''){
                    this.$store.dispatch('sendMessage', {roomId : this.roomId, message : this.newMessage}).then(() => {
                        this.newMessage = ''
                        this.scroll()
                    }).catch(e => {
                        this.$noty.error('Oups');
                        console.log(e)
                    })
                }
            },
            fetchMessages(val){
                if(val !== null){
                    if(this.roomId === null && this.room !== null){
                        this.$router.push({name : 'index'})
                    } else {
                        this.$store.dispatch('enterRoom', this.roomId).then(()=>{
                            this.loading = false
                            this.scroll()
                        }).catch(e => {
                            console.log(e)
                            this.$noty.error('Oups');
                        })
                    }
                }
            },
            syncMessages(){
                if (this.sync){
                    this.fetchMessages()
                }
                setTimeout(this.syncMessages, 5000)
            }
        },
        computed: {
            room(){
                return this.$store.getters.getSelectedRoom || null
            },
            subscriptions(){
                return this.$store.getters.getUserRooms || null
            },
            roomId(){
                return parseInt(this.$route.params.id)
            },
            userEmail(){
                return this.$store.getters.getCurrentUserEmail
            }
        },
        created(){
            if(this.subscriptions !== null && this.subscriptions.length > 0){
                this.fetchMessages(this.subscriptions)
            }
            setTimeout(this.syncMessages, 5000);
        },
        watch : {
            subscriptions : function(val){
                if(val.filter(r => r.id === this.roomId).length > 0){
                    this.fetchMessages(val)
                }
            },
            roomId : function(val){
                this.fetchMessages(this.subscriptions)
            },
        }
    }
</script>

<style scoped>
    .messages-wrapper{
        max-height : 85vh;
        overflow: scroll;
    }

    #title{
        position: relative;
        top: -5px;
    }

    .fa.fa-paper-plane{
        position: relative;
        top: 15px;
        color: rgba(0,0,0,.2);
    }
    .fa.fa-paper-plane:hover{
        color: #4CAF50;
    }

    .fill-height{
        height: 75vh;
    }

    .leave-btn{
        color: rgba(0,0,0,.2);
    }
    
    .leave-btn:hover{
        cursor:pointer;
        color: #F44336;
    }

    .room-name{
        background-color: #fafafa;
        padding: 10px;
        border-radius: 18px;
        position: relative;
        top: 33px;
    }
</style>