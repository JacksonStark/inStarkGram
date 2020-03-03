<template>
    <div>
        <button @click="followUser" class="btn btn-primary ml-4 p-1">{{ status }}</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                status: 'Follow'
            }
        },

        methods: {
            followUser() {
                // this.status = (this.status === 'Follow' ? 'Unfollow' : 'Follow')
                axios.post('/follow/6')
                .then(res => alert(res.data))
            }
        } 
    }
</script>
