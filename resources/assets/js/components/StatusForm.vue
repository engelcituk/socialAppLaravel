<template>
    <div>
        <form @submit.prevent="enviar">
            <div class="card-body">
                <textarea v-model="body" class="form-control border-0 bg-light" name="body" placeholder="¿Qué estas pensando Nazky?"></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="createStatus">Publicar</button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                body: ''
            }
        },
        methods:{
            enviar(){
                axios.post('/statuses', { body: this.body})
                    .then (res => {
                        EventBus.$emit('status-created', res.data);
                        this.body= ''
                     })
                    .catch( err => {
                    console.log(err.response.data);
                })
            }
        }
    }
</script>

<style scoped>

</style>
