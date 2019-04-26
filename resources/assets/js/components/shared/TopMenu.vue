<template>
	<v-toolbar fixed app>
		<v-toolbar-title>{{ siteName }}</v-toolbar-title>
		<v-spacer></v-spacer>
		<v-toolbar-items class="hidden-sm-and-down">
			<v-btn flat v-show="!isLoggedIn" :to="{name: 'login'}">
				Login
			</v-btn>
			<v-btn flat v-show="isLoggedIn" :to="{name: 'profile'}">
				Profile
			</v-btn>
			<v-btn flat @click.prevent="logout">
				Logout
			</v-btn>
		</v-toolbar-items>
	</v-toolbar>
</template>

<script>
    import {siteName} from './../../config';
    import {mapGetters} from 'vuex';
    import jwtToken from '../../helpers/jwt-token';

    export default {
        name : 'toolbar',
        data() {
            return {
                siteName: siteName
            }
        },
        computed: mapGetters([
            'isLoggedIn'
        ]),
        methods: {
            logout() {
                jwtToken.removeToken();
                this.$store.dispatch('unsetAuthUser')
                    .then(() => {
                        this.$noty.success('You are logged out');
                        this.$router.push({name: 'login'});
                    });
            }
        }
    }
</script>

<style>
	a:hover{
		text-decoration:none;
	}
</style>
