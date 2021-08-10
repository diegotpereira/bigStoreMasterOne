<template>
    <div class="row">
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <a href='/admin/pedidos'>Pedidos ({{pedidos.length}})</a>
        </div>
        <hr>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <a href='/admin/produtos'>Produtos ({{produtos.length}})</a>
        </div>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <a href="/admin/users">Usuários ({{users.length}})</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: null,
            pedidos: [],
            produtos: [],
            users: []
        }
    },

    mounted() {
        axios.get('/api/users/')
             .then(response => {
                 this.users = response.data
             })

             .catch(error => {
                 console.error(error);
             })

             axios.get('/api/produtos/')
                  .then(response => {
                      
                  })
    },
}
</script>
<style lang="">
    
</style>