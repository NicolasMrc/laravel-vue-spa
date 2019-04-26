<template>
	<div class="h-100">
		<v-navigation-drawer permanent app v-if="isLoggedIn">
			<v-toolbar flat>
				<v-list>
					<v-list-tile>
						<v-list-tile-title class="title">
							Vos Channels
						</v-list-tile-title>
					</v-list-tile>
				</v-list>
			</v-toolbar>

			<v-divider class="mt-0"></v-divider>

			<v-list dense class="pt-0">
				<v-list-tile v-for="room in rooms" :key="room.name" @click="enter(room)" class="pointer">
					<v-list-tile-content>
						<v-list-tile-title># {{ room.name }}</v-list-tile-title>
					</v-list-tile-content>
				</v-list-tile>
				<v-list-tile v-if="rooms.length === 0">
					<v-list-tile-content>
						<span class="grey--text font-italic">no channel yet</span>
					</v-list-tile-content>
				</v-list-tile>
				<v-list-tile>
					<v-list-tile-content>
						<room-dialog/>
					</v-list-tile-content>
				</v-list-tile>
			</v-list>
			<div class="text-xs-center">
				<span class="grey--text font-italic">ou</span>
			</div>
			<v-list dense class="pt-0">
				<v-list-tile>
					<v-list-tile-content>
						<v-btn :to="{name: 'index'}" flat color="info" block>Voir les channels</v-btn>
					</v-list-tile-content>
				</v-list-tile>
			</v-list>
		</v-navigation-drawer>
		<toolbar/>
		<v-content class="h-100">
			<v-container grid-list-md class="h-100">
				<slot></slot>
			</v-container>
		</v-content>
	</div>
</template>

<script>
    import Toolbar from "./TopMenu";
    import RoomDialog from "./RoomDialog";
    export default {
        name:'RoomsDrawer',
        components: {RoomDialog, Toolbar},
        data() {
            return {
                dialog:false
            }
        },
        methods:{
            enter(room){
				this.$router.push({name: 'room', params: { id: room.id }})
            }
        },
        computed: {
            rooms(){
                return this.$store.getters.getUserRooms || []
            },
            isLoggedIn(){
                return this.$store.getters.isLoggedIn
            }
        }
    }
</script>

<style scoped>
	#center-text{
		text-align: center;
		display: initial;
		height: 20px;
	}

	.pointer{
		cursor:pointer;
	}
</style>