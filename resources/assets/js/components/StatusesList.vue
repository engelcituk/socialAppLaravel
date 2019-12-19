<template>
    <div>
        <div class="card border-0 mb-3 shadow-sm" v-for=" status in statuses" >
            <div class="card-body d-flex flex-column">
                <div class=" d-flex align-items-center mb-3">
                    <img class="rounded mr-3 shadow-sm" width="40px" src="https://aprendible.com/images/default-avatar.jpg" alt="">
                    <div class="">
                        <h5 class="mb-1"> Cituk Caamal</h5>
                        <div class="small text-muted"> Hace una hora</div>
                    </div>
                </div>
                <p class="card-text text-secondary" v-text="status.body"></p>
            </div>
        </div>
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
