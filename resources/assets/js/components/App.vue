<template>
	<v-app>
		<transition name="fade" mode="out-in">
			<rooms-drawer>
				<router-view></router-view>
			</rooms-drawer>
		</transition>
	</v-app>
</template>

<script>
    import RoomsDrawer from "./shared/RoomsDrawer";

	export default {
	    computed : {
            isLoggedIn(){
                return this.$store.getters.isLoggedIn
            }
		},
		components: {
            RoomsDrawer,
		},
		watch:{
	        isLoggedIn : function(val){
	            if(val){
                    this.$store.dispatch('fetchRooms').then()
                    this.$store.dispatch('fetchSubscriptions').then()
				}
			}
		}
	}
</script>
