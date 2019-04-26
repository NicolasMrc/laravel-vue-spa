export default {
    state: {
        rooms: null,
        userRooms: null,
        selectedRoom: null,
    },
    actions : {
        fetchRooms({dispatch, commit}){
            return axios.get('/api/rooms').then(response =>{
                commit('setRooms', response.data);
            })
        },
        fetchSubscriptions({dispatch, commit}){
            return axios.get('/api/subscriptions').then(response =>{
                commit('setUserRooms', response.data);
            })
        },
        subscribe({dispatch, commit}, roomId){
            return axios.get('/api/subscriptions/' + roomId).then(response =>{
                commit('addUserRoom', response.data);
            })
        },
        unsubscribe({dispatch, commit}, roomId){
            return axios.delete('/api/subscriptions/' + roomId).then(response =>{
                commit('deleteRoom', roomId);
            })
        },
        enterRoom({dispatch, commit, state}, roomId){
            commit('setSelectedRoom', roomId)
            return axios.get('/api/rooms/' + roomId + '/messages').then(response =>{
                commit('setMessages', response.data);
            })
        },
        addRoom({dispatch, commit, state}, name){
            return axios.post('/api/rooms/', {name : name}).then(response =>{
                commit('addRoom', response.data);
                dispatch('subscribe', response.data.id).then(()=>{
                    return response.data
                })
            })
        },
        sendMessage({dispatch, commit, state}, params){
            let roomId = params.roomId
            let message = params.message
            return axios.post('/api/rooms/' + roomId + '/messages', {message : message}).then(response =>{
                commit('addMessage', response.data);
            })
        }
    },
    getters: {
        getRooms(state){
            return state.rooms
        },
        getUserRooms(state){
            return state.userRooms
        },
        getSelectedRoom(state){
            if(state.selectedRoom !== null) {
                return state.userRooms.find(room => room.id === state.selectedRoom)
            } else {
                return null
            }
        },
    },
    mutations: {
        setMessages(state, messages){
            state.userRooms.find(r => r.id === state.selectedRoom).messages = messages
        },
        addMessage(state, message){
            state.userRooms.find(r => r.id === state.selectedRoom).messages.push(message)
        },
        setSelectedRoom(state, roomId){
            state.selectedRoom = roomId
        },
        setRooms(state, rooms){
            state.rooms = rooms
        },
        addUserRoom(state, room){
            state.userRooms.push(room)
        },
        addRoom(state, room){
            state.rooms.push(room)
        },
        deleteRoom(state, roomId){
            let index = state.userRooms.map(room => {
                return room.id;
            }).indexOf(roomId);

            state.userRooms.splice(index, 1);
        },
        setUserRooms(state, rooms){
            state.userRooms = rooms
        },
    }
};
