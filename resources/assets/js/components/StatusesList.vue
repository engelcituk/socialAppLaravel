<template>
    <div>
        <div v-for=" status in statuses" v-text="status.body"></div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                statuses: []
            }
        },
        mounted() {
            axios.get('/statuses')
                .then( respuesta => {
                    this.statuses = respuesta.data.data;
                })
                .catch( error => {
                    console.log( error.response.data);
                });
            EventBus.$on('status-created', status => {
                this.statuses.unshift(status);
            })
        }
    }
</script>

<style scoped>

</style>
