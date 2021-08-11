<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Adicionado em </td>
                    <td>Total de pedidos</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" :key="index">
                    <td>{{index + 1}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.pedidos.length}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users: []
        }
    },
    beforeMount() {
        axios.get('/api/users/')
             .then(response => {
                 this.users = response.data
             })

             .catch(error => {
                 console.error(error);
             })
    }
}
</script>
<style lang="">
    
</style>