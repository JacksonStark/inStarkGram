<template>
  <div>
    <button @click="followUser" class="btn btn-primary ml-4 p-1">{{ buttonText }}</button>
  </div>
</template>

<script>
    export default {

        props: ['userId', 'followStatus'],

        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                status: this.followStatus
            }
        },

        computed: {
            // recomputes whenever this.status changes
            buttonText() {
                return this.status ? 'Unfollow' : 'Follow';
            }
        },

        methods: {
            followUser() {
                axios.post(`/follow/${this.userId}`)
                .then(res => {
                    console.log(res.data);
                    // toggles status to opposite
                    this.status = !this.status
                })
            }
        }
    }
</script>
