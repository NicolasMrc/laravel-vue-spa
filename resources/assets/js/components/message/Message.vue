<template>
   <div class="message-wrapper">
       <div :class="isAuthor ? 'is-author' : 'is-reader'" class="d-inline-block message px-2 py-2">
           <span class="d-block"><span class="font-weight-bold">{{message.user.name}}</span> - {{message.created_at | formatDate}}</span>
           <span>{{message.text}}</span>
       </div>
   </div>
</template>

<script>
    export default {
        name:'message',
        props : ['message', 'isAuthor']
    }
</script>

<style scoped>

    .message-wrapper:hover{
        background-color: rgba(0,0,0,.05);
    }

    .message{
        border-radius: 5px;
    }

    .is-author{
    }

    .is-reader{
    }
</style>